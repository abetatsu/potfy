<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\PortfolioRequest;
use App\Http\Controllers\Controller;
use JD\Cloudder\Facades\Cloudder;
use App\Enums\StoryType;
use App\Portfolio;
use App\Technology;
use App\User;
use Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $portfolios = Portfolio::orderBy('created_at', 'desc')->paginate(9);
        return view('user.portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::get(['name'])->toArray();
        $technologies = array_column($technologies, 'name');
        return view('user.portfolios.create', compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioRequest $request)
    {
        \DB::beginTransaction();
        try {
            $portfolio = new Portfolio;
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            $portfolio->link = $request->link;
            $portfolio->user_id = Auth::user()->id;
            $portfolio->visited_count = 0;
            
            if ($image = $request->file('image')) {
                $image_path = $image->getRealPath();
                Cloudder::upload($image_path, null);
                $publicId = Cloudder::getPublicId();
                $logoUrl = Cloudder::secureShow($publicId, [
                    'width'     => 200,
                    'height'    => 200
                ]);
                $portfolio->image_path = $logoUrl;
                $portfolio->public_id  = $publicId;
            }
            $portfolio->save();

            if ($request->technologies) {
                $technologies = explode(",", $request->technologies);
                foreach ($technologies as $technology) {
                    $tech = Technology::firstOrCreate(['name' => $technology]);
                    $portfolio->technologies()->attach($tech->id);
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();
            return redirect()->route('user.portfolios.index')->with('error', 'ポートフォリオの新規作成ができませんでした。');
        }
        
        return redirect() ->route('user.portfolios.index')->with('success', 'ポートフォリオを追加しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio = Portfolio::find($id);
        if ($portfolio->user_id !== Auth::user()->id) {
            $portfolio->visited_count++;
            $portfolio->save();
        }
        $portfolio->load('user', 'technologies');
        $description = $portfolio->replaceUrl($portfolio->description);
        $link = $portfolio->replaceUrl($portfolio->link);
        return view('user.portfolios.show', compact('portfolio', 'description', 'link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        $technologies = Technology::get(['name'])->toArray();
        $technologies = array_column($technologies, 'name');
        $selectedTechs = array_column($portfolio->technologies()->get(['name'])->toArray(), 'name');
        if (Auth::user()->id !== $portfolio->user_id) {
            return abort(404);
        }
        return view('user.portfolios.edit', compact('portfolio', 'technologies', 'selectedTechs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $portfolio = Portfolio::find($id);
            if (Auth::user()->id !== $portfolio->user_id) {
                return abort(404);
            }
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            $portfolio->link = $request->link;

            if ($image = $request->file('image')) {
                $image_path = $image->getRealPath();
                Cloudder::upload($image_path, null);
                $publicId = Cloudder::getPublicId();
                $logoUrl = Cloudder::secureShow($publicId, [
                    'width'     => 200,
                    'height'    => 200
                ]);
                $portfolio->image_path = $logoUrl;
                $portfolio->public_id  = $publicId;
            }
            
            $portfolio->save();

            $portfolioTechs = $portfolio->technologies()->get();
            foreach ($portfolioTechs as $tech) {
                $portfolio->technologies()->detach($tech->id);
            }

            if ($request->technologies) {
                $technologies = explode(",", $request->technologies);
                foreach ($technologies as $technology) {
                    $tech = Technology::firstOrCreate(['name' => $technology]);
                    $portfolio->technologies()->attach($tech->id);
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();
            return redirect()->route('portfolios.show', $portfolio->id)->with('error', 'ポートフォリオの更新に失敗しました。');
        }
        return redirect()->route('portfolios.show', $portfolio->id)->with('success', 'ポートフォリオを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            $portfolio = Portfolio::find($id);
            $technologies = Technology::find($id);

            if (Auth::user()->id !== $portfolio->user_id) {
                return abort(404);
            }

            if (isset($portfolio->public_id)) {
                Cloudder::destroyImage($portfolio->public_id);
            }
            $portfolio->delete();
            $portfolio->technologies()->detach($technologies);
            \DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();

            return redirect()->route('user.portfolios.index')->with('error', 'ポートフォリオの削除に失敗しました。');
        }
        return redirect()->route('user.portfolios.index')->with('success', 'ポートフォリオの削除に成功しました。');
    }

    public function top()
    {
        $topPortfolios = Portfolio::orderBy('visited_count', 'desc')->take(3)->get();
        $portfolios = Portfolio::orderBy('created_at', 'desc')->take(3)->get();
        $portfolios->load('user', 'technologies');
        return view('top', compact('portfolios', 'topPortfolios'));
    }

    public function ogp(Portfolio $portfolio)
    {
        // OGPのサイズ
        $w = 600;
        $h = 315;
        // １行の文字数
        $partLength = 10;

        $fontSize = 30;
        $fontPath = public_path('/assets/fonts/Roboto-Regular.ttf');

        // 画像を作成
        $image = \imagecreatetruecolor($w, $h);
        // 背景画像を描画
        if ($portfolio->image_path) {
            $bg = \imagecreatefrompng($portfolio->image_path);
        } else {
            $bg = \imagecreatefromjpeg(public_path('assets/image/potfybg.jpeg'));
            // 色を作成
            $white = imagecolorallocate($image, 255, 255, 255);
            $grey = imagecolorallocate($image, 128, 128, 128);
    
            // 各行に分割
            $parts = [];
            $length = mb_strlen($portfolio->title);
            for ($start = 0; $start < $length; $start += $partLength) {
                $parts[] = mb_substr($portfolio->title, $start, $partLength);
            }
    
            // テキストの影を描画
            $this->drawParts($image, $parts, $w, $h, $fontSize, $fontPath, $grey, 3);
            // テキストを描画
            $this->drawParts($image, $parts, $w, $h, $fontSize, $fontPath, $white);
        }
        imagecopyresampled($image, $bg, 0, 0, 0, 0, $w, $h, 600, 315);

        ob_start();
        imagepng($image);
        $content = ob_get_clean();

        // 画像としてレスポンスを返す
        return response($content)
            ->header('Content-Type', 'image/png');
    }

    /**
     * 各行の描画メソッド
     */
    private function drawParts($image, $parts, $w, $h, $fontSize, $fontPath, $color, $offset = 0)
    {
        foreach ($parts as $i => $part) {
            // サイズを計算
            $box = \imagettfbbox($fontSize, 0, $fontPath, $part);
            $boxWidth = $box[4] - $box[6];
            $boxHeight = $box[1] - $box[7];
            // 位置を計算
            $x = ($w - $boxWidth) / 2;
            $y = $h / 2 + $boxHeight / 2 - $boxHeight * count($parts) * 0.5 + $boxHeight * $i;
            \imagettftext($image, $fontSize, 0, $x + $offset, $y + $offset, $color, $fontPath, $part);
        }
    }
}

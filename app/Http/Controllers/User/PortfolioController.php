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
        $portfolios = Portfolio::orderBy('created_at', 'desc')->paginate(16);
        return view('user.portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
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
            $portfolio->user_id = Auth::id();
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
                foreach ($request->technologies as $technologyId) {
                    $portfolio->technologies()->attach($technologyId);
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
        if ($portfolio->user_id !== Auth::id()) {
            $portfolio->visited_count++;
            $portfolio->save();
        }
        $portfolio->load('user', 'technologies');
        $description = $portfolio->replaceUrl($portfolio->description);
        return view('user.portfolios.show', compact('portfolio', 'description'));
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
        $technologies = Technology::all();
        if (Auth::id() !== $portfolio->user_id) {
            return abort(404);
        }
        return view('user.portfolios.edit', compact('portfolio', 'technologies'));
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
            if (Auth::id() !== $portfolio->user_id) {
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

            if ($request->technologies) {
                foreach ($request->technologies as $technologyId) {
                    $portfolio->technologies()->attach($technologyId);
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();
            return redirect()->route('user.portfolios.show', $portfolio->id)->with('error', 'ポートフォリオの更新に失敗しました。');
        }
        return redirect()->route('user.portfolios.show', $portfolio->id)->with('success', 'ポートフォリオを更新しました。');
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

            if (Auth::id() !== $portfolio->user_id) {
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
        $topPortfolios = Portfolio::orderBy('visited_count', 'desc')->take(4)->get();
        $portfolios = Portfolio::orderBy('created_at', 'desc')->take(4)->get();
        $portfolios->load('user', 'technologies');
        return view('top', compact('portfolios', 'topPortfolios'));
    }
}

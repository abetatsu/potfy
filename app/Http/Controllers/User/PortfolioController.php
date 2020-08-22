<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\PortfolioRequest;
use App\Http\Controllers\Controller;
use JD\Cloudder\Facades\Cloudder;
use App\Portfolio;
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
        $portfolios = Portfolio::all();
        $portfolios->load('user');
        return view('user.portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.portfolios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioRequest $request)
    {
        $portfolio = new Portfolio;
        $portfolio->title = $request->title;
        $portfolio->description = $request->description;
        $portfolio->link = $request->link;
        $portfolio->user_id = Auth::id();
        
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

        return redirect() ->route('portfolios.index')->with('message', '記事を追加しました。');
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
        return view('user.portfolios.show', compact('portfolio'));
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
        if (Auth::id() !== $portfolio->user_id) {
            return abort(404);
        }
        return view('user.portfolios.edit', compact('portfolio'));
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
        \Session::flash('message', '記事を更新しました。');
        return view('user.portfolios.show', compact('portfolio'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);

        if (Auth::id() !== $portfolio->user_id) {
            return abort(404);
        }

        if (isset($portfolio->public_id)) {
            Cloudder::destroyImage($portfolio->public_id);
        }

        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('success', 'ポートフォリオの削除に成功しました。');
    }
}

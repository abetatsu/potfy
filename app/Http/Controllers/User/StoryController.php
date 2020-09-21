<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\StoryRequest;
use App\Http\Controllers\Controller;
use App\Story;
use App\Portfolio;
use Auth;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        try {
            Story::updateOrCreate([
                'story_type' => $request->story_type,
                'portfolio_id' => $request->portfolio_id,
                'user_id' => Auth::id()
            ],[
                'story' => Story::replaceUrl($request->story)
            ]);
        } catch (\Exception $e) {
            return redirect()->route('portfolios.show', $request->portfolio_id)->with('error', 'ストーリーの新規作成ができませんでした。');
        }
        return redirect()->route('portfolios.show', $request->portfolio_id)->with('success', 'ストーリーを投稿しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio, Story $story)
    {
        if (Auth::id() !== $story->user_id) {
            return abort(403);
        }

        $story->delete();

        return redirect()->route('portfolios.show', $portfolio->id)->with('success', 'ストーリーの削除に成功しました。');
    }
}

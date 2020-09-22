<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\HistoryRequest;
use App\Http\Controllers\Controller;
use App\History;
use App\Portfolio;
use Auth;

class HistoryController extends Controller
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
    public function store(HistoryRequest $request)
    {
        $portfolio = Portfolio::find($request->portfolio_id);
        $history = new History;
        $history->history = $history->replaceUrl($request->history);
        $history->user_id = Auth::user()->id;
        $history->portfolio_id = $request->portfolio_id;

        $history -> save();
        
        $portfolio->load('user', 'technologies');
        $description = $portfolio->replaceUrl($portfolio->description);

        return redirect()->route('portfolios.show', $portfolio->id)->with('success', '開発履歴を投稿しました。')->with('history', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
    public function update(HistoryRequest $request, Portfolio $portfolio, History $history)
    {
        if (Auth::id() !== $history->user_id) {
            return abort(403);
        }

        $history->history = $request->history;
        $history->save();

        return redirect()->route('portfolios.show', $portfolio->id)->with('success', '開発履歴を編集しました。')->with('history', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio, History $history)
    {
        if (Auth::user()->id !== $history->user_id) {
            return abort(403);
        }

        $history->delete();

        return redirect()->route('portfolios.show', $portfolio->id)->with('success', '開発履歴の削除に成功しました。')->with('history', true);
    }
}

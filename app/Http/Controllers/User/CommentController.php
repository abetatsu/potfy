<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Portfolio;
use Auth;

class CommentController extends Controller
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

    public function store(CommentRequest $request)
    {
        $portfolio = Portfolio::find($request->portfolio_id);
        $comment = new Comment;
        $comment->body = $comment->replaceUrl($request->body);
        $comment->user_id = Auth::id();
        $comment->portfolio_id = $request->portfolio_id;

        $comment->save();
        
        return redirect()->route('portfolios.show', $portfolio->id)->with('success', 'コメント完了しました。')->with('comment', $comment->id);
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
    public function destroy(Portfolio $portfolio, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            return abort(404);
        }

        $comment->delete();

        return redirect()->route('portfolios.show', $portfolio->id)->with('success', 'コメントの削除に成功しました。')->with('comment', 'コメントの削除に成功しました。');
    }
}

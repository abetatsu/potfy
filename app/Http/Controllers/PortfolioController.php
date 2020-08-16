<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PortfolioRequest;
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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $portfolios = Portfolio::all();
        $portfolios->load('user');
        return view('portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portfolios.create');
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
        $portfolio->save();

        return redirect() ->route('portfolios.index');
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
        return view('portfolios.show', compact('portfolio'));
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
        return view('portfolios.edit', compact('portfolio'));
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
        
        $portfolio->save();

        return view('portfolios.show', compact('portfolio'));
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
        $portfolio->delete();
        return redirect() ->route('portfolios.index');
    }
}

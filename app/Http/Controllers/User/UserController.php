<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Portfolio;
use JD\Cloudder\Facades\Cloudder;
use Auth;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $portfolios = Portfolio::orderBy('created_at', 'desc')->where('user_id', Auth::id())->paginate(16);
        $user_self_introduction = $user->replaceUrl($user->user_self_introduction);
        return view('user.profiles.show', compact('user', 'portfolios', 'user_self_introduction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name                   = $request->name;
        $user->gender                 = $request->gender;
        $user->career                 = $request->career;
        $user->birthday               = $request->birthday;
        $user->user_self_introduction = $request->user_self_introduction;

        if ($image = $request->file('image')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 200,
                'height'    => 200
            ]);
            $user->image = $logoUrl;
            $user->public_id  = $publicId;
        }

        $user->save();

        return redirect()->route('user.users.show', $user->id)->with('success', '情報を更新しました。');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

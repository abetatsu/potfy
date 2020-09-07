<?php

namespace App\Http\Controllers;

class TermsController extends Controller
{
    /**
     * Show the service terms.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        return view('terms.services');
    }

    /**
     * Show the privacy policy.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function privacy()
    {
        return view('terms.privacy');
    }

    /**
     * Show the organizer.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function organizer()
    {
        return view('terms.organizer');
    }
}

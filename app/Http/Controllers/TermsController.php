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
        $devMembers = [
            't-aburasoba',
            'yusan12',
            'UoyaRyota',
            'speeed131',
            'KoeInoue',
            'masagao'
        ];
        $sprtMembers = [
            'aokidaiki',
            'daiju81',
            'RikuHirose',
            'sou-uemura',
            'DaikiHosomi',
            'JunKudo0222',
            'midnight-trigger',
            'ryoichi-iba'
        ];
        $thxMembers = [
            'tejitak',
            'kengaogaoasia'
        ];
        return view('terms.organizer', compact('devMembers', 'sprtMembers', 'thxMembers'));
    }
}

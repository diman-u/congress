<?php

namespace App\Http\Controllers;

use App\Models\Speakers;
use Illuminate\Http\Request;

class SpeakersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speakers = Speakers::all();
        return view('speakers.list', ['speakers' => $speakers]);
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
     * @param  \App\Models\Speakers  $speakers
     * @return \Illuminate\Http\Response
     */
    public function show(Speakers $speakers)
    {
        return view('speakers.show', ['speaker' => $speakers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speakers  $speakers
     * @return \Illuminate\Http\Response
     */
    public function edit(Speakers $speakers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Speakers  $speakers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Speakers $speakers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Speakers  $speakers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speakers $speakers)
    {
        //
    }
}

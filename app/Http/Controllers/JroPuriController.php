<?php

namespace App\Http\Controllers;

use App\JroPuri;
use Illuminate\Http\Request;

class JroPuriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JroPuri::all([
            'id',
            'name',
        ]);
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
     * @param  \App\JroPuri  $jroPuri
     * @return \Illuminate\Http\Response
     */
    public function show(JroPuri $jroPuri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JroPuri  $jroPuri
     * @return \Illuminate\Http\Response
     */
    public function edit(JroPuri $jroPuri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JroPuri  $jroPuri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JroPuri $jroPuri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JroPuri  $jroPuri
     * @return \Illuminate\Http\Response
     */
    public function destroy(JroPuri $jroPuri)
    {
        //
    }
}

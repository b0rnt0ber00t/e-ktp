<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EktpRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EktpRegisterController extends Controller
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
        // return json_encode([
        //     'user_id' => auth()->id(),
        //     'detail'  => auth()->user()->hasDetail(),
        //     'ektp_registered' => EktpRegister::firstWhere('user_id', auth()->id()),
        //     'user_nik' => auth()->user()->nik_id,
        //     'face' => Http::get('http://127.0.0.1:5000/' . auth()->id())['result']
        // ]);
        return auth()->user()->hasDetail()
            && Http::get('http://127.0.0.1:5000/' . auth()->id())['result']
            && !EktpRegister::firstWhere('user_id', auth()->id())
            && EktpRegister::create([
                'user_id' => auth()->id(),
                'nik_id'  => auth()->user()->nik_id,
            ]);
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
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EktpRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $is_admin = auth()->user()->hasRole('Admin');

        $carbon = Carbon::now();
        $month  = $carbon->month;
        $year   = $carbon->year;

        $dataUser         = $is_admin ? User::all()         : null;
        $dataEktpRegister = $is_admin ? EktpRegister::orderBy('id', 'desc')->get() : null;

        $registeredUser      = $is_admin ? $dataUser->count()         : null;
        $requestEktp         = $is_admin ? $dataEktpRegister->count() : null;
        $requestNotValidated = $is_admin ? EktpRegister::where('status', 'not validated')->get()->count() : null;
        $requestValidated    = $is_admin ? EktpRegister::where('status', 'validated')->get()->count()     : null;

        $registeredUserLastMonth = $is_admin ? User::whereMonth('created_at', $month)->whereYear('created_at', $year)->get()->count() : null;
        $requestEktpLastMonth    = $is_admin ? EktpRegister::whereMonth('created_at', $month)->whereYear('created_at', $year)->get()->count() : null;

        $requestEktpStatus = EktpRegister::firstWhere('user_id', auth()->id());
        $requestEktpStatus = !$is_admin && EktpRegister::firstWhere('user_id', auth()->id()) ? $requestEktpStatus : null;

        return auth()->user()->hasRole('Admin') ? view('dashboard.admin.index',
            compact(
                'registeredUser'     , 'registeredUserLastMonth',
                'requestEktp'        , 'requestEktpLastMonth'   , 'dataEktpRegister',
                'requestNotValidated',
                'requestValidated'
            ))
            : (auth()->user()->hasRole('User') ? view('dashboard.user.index',
            compact(
                'requestEktpStatus'
            ))
            : back());
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

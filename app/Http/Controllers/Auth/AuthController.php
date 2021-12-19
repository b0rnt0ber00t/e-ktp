<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'email'    => ['required', 'email:dns'],
            'email'    => ['required'],
            'password' => ['required'],
        ]);

        if ($request->path() === 'login') {    
            return Auth::attempt($validated)
                ? redirect(RouteServiceProvider::HOME)
                : back()->with('info', 'email or password does not match any credentials.');

        } elseif ($request->path() === 'register') {
            $register = $request->validate([
                'name'           => ['required'],
                'conf_password'  => ['required', 'same:password'],
                'privacy_policy' => ['required']
            ]);

            $validated = array_merge($validated, $register, ['password' => Hash::make($request->password), 'role_id' => 2]);

            return User::firstWhere(['email' => $request->email])
                ? back()->with('info', 'Username or Email already exists')
                : (User::create($validated) && Auth::attempt([
                    'email'    => $request->email,
                    'password' => $request->password])
                    ? redirect(RouteServiceProvider::HOME)
                    : redirect()->route('login')->with('info', 'email or password does not match any credentials.'));

        } else { return back(); }
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
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        return Auth::logout() ? redirect(RouteServiceProvider::HOME) : back();
    }
}

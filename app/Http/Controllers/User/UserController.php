<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\EktpRegister;
use App\Models\Regency;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userDetail = (object) [
            'kk'          => null,
            'nik'         => null,
            'place'       => null,
            'birth_date'  => null,
            'gender'      => null,
            'blood_type'  => null,
            'rt'          => null,
            'rw'          => null,
            'city'        => null,
            'village'     => null,
            'district'    => null,
            'address'     => null,
            'citizenship' => null,
            'religion'    => null,
            'profession'  => null,
            'marriage'    => null,
        ];
        $findUserDetail = UserDetail::find(auth()->user()->nik_id);

        $is_user = auth()->user()->hasRole('User');

        $regencies  = $is_user ? Regency ::orderBy('name')->get() : null;
        $villages   = $is_user ? Village ::orderBy('name')->get() : null;
        $districts  = $is_user ? District::orderBy('name')->get() : null;
        $userDetail = $is_user && $findUserDetail ? $findUserDetail : $userDetail;

        // $regencies  = [];
        // $villages   = [];
        // $districts  = [];

        return view('dashboard.user.profile', compact('regencies', 'villages', 'districts', 'userDetail'));
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
    public function show(User $id)
    {
        if (!auth()->user()->hasRole('Admin'))
            return redirect()->route('dashboard');

        $requestEktpStatus = EktpRegister::firstWhere('user_id', $id->id);
        $userDetail        = UserDetail::firstWhere('nik', $id->nik_id);

        $placeAndCity = Regency::find($userDetail->place);
        $villages     = Village::find($userDetail->village);
        $districts    = District::find($userDetail->district);

        return view('dashboard.user.show',
            compact(
                'id'        , 'requestEktpStatus',
                'userDetail', 'placeAndCity',
                'villages'  , 'districts'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        return !is_null(EktpRegister::firstWhere('user_id', $id))
            && $request->validate(['assessment' => ['required']])
            && EktpRegister::where('user_id', $id)->update(['status' => $request->assessment])
        ? true : false;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $update
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $update)
    {
        if ($update === 'profile') {
            $request->validate([
                'name'  => ['required'],
                'email' => ['required'],
                'image' => ['nullable', 'dimensions:ratio=1/1'],
                'verify_password' => ['required']
            ]);

            if (!Hash::check($request->verify_password, auth()->user()->password)) {
                return back()->with('info', 'Can not update profile!');
            }

            $data = $request->only('name', 'email');
            
            if ($request->image != null) {
                $path = 'assets/img/user/profile';
                $imgName = uniqid(auth()->id() . '_') .'.'. $request->image->extension();
                $request->image->move(public_path($path), $imgName);

                auth()->user()->image !== 'user.png'
                ? unlink(public_path($path) .'/'. auth()->user()->image)
                : null;

                $data['image'] = $imgName;
            }
            
            if (auth()->user()->hasRole('User')) {
                $userDetails = $request->validate([
                    'kk'                         => ['required', 'numeric'],
                    'nik'                        => ['required', 'numeric'],
                    'place'                      => ['required'],
                    'birth_date'                 => ['required'],
                    'gender'                     => ['required'],
                    'blood_type'                 => ['required'],
                    'rt'                         => ['required'],
                    'rw'                         => ['required'],
                    'city'                       => ['required'],
                    'village'                    => ['required'],
                    'district'                   => ['required'],
                    'address'                    => ['required'],
                    'citizenship'                => ['required'],
                    'religion'                   => ['required'],
                    'profession'                 => ['required'],
                    'marriage'                   => ['required'],
                    'transfer_certificate'       => ['nullable', 'image:jpg,jpeg,png'],
                    'Certificate_moving_foreign' => ['nullable', 'image:jpg,jpeg,png'],
                ]);

                is_null(auth()->user()->nik_id)
                ? $request->validate(['image_KK' => ['required', 'image:jpg,jpeg,png']])
                : null;

                $path = 'assets/img/user/profile/' . auth()->id();

                if ($request->image_KK != null) {
                    $imgName = uniqid(auth()->id() . '_image_KK_') .'.'. $request->image_KK->extension();
                    $request->image_KK->move(public_path($path), $imgName);

                    auth()->user()->image_KK != null
                    ? unlink(public_path($path) .'/'. auth()->user()->image_KK)
                    : null;

                    $userDetails['image_KK'] = $imgName;
                }

                if ($request->transfer_certificate != null) {
                    $imgName = uniqid(auth()->id() . '_transfer_certificate_') .'.'. $request->transfer_certificate->extension();
                    $request->transfer_certificate->move(public_path($path), $imgName);

                    auth()->user()->transfer_certificate != null
                    ? unlink(public_path($path) .'/'. auth()->user()->transfer_certificate)
                    : null;

                    $userDetails['transfer_certificate'] = $imgName;
                }

                if ($request->Certificate_moving_foreign != null) {
                    $imgName = uniqid(auth()->id() . '_Certificate_moving_foreign_') .'.'. $request->Certificate_moving_foreign->extension();
                    $request->Certificate_moving_foreign->move(public_path($path), $imgName);

                    auth()->user()->Certificate_moving_foreign != null
                    ? unlink(public_path($path) .'/'. auth()->user()->Certificate_moving_foreign)
                    : null;

                    $userDetails['Certificate_moving_foreign'] = $imgName;
                }

                $nik = auth()->user()->nik_id == null ? $request->nik : auth()->user()->nik_id;

                auth()->user()->nik_id === null
                    && auth()->user()->update(['nik_id' => $request->nik])
                     ? UserDetail::create($userDetails)
                     : UserDetail::find($nik)->update($userDetails);

            }

            return auth()->user()->update($data)
                ? back()->with('info', 'Profile successfully updated!')
                : back();

        } elseif ($update === 'password') {
            $request->validate([
                'old_password'     => ['required'],
                'new_password'     => ['required', 'same:confirm_password'],
                'confirm_password' => ['required', 'same:new_password'],
            ]);
    
            return Hash::check($request->old_password, auth()->user()->password)
                && auth()->user()->update(['password' => Hash::make($request->new_password)])
                 ? back()->with('info', 'Password successfully updated!')
                 : back()->with('info', 'Can not update password!');
        } else { return back(); }
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

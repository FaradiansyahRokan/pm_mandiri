<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Address;
use App\Models\TokenWhatsapp;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::find($id);
        // $address = Address::find();

        $user = User::find(auth()->id());
        // $user = User::find($id);
        $user->fullName = $user->first_name . ' ' . $user->last_name;

        $address = Address::where('id_user', $user->id)->first();

        $token = TokenWhatsapp::first();
        // dd($token);
        
        // $address->alamat = $address->city . ',' . $address->province . ' ' . $address->district . ' ' . $address->sub_district;
        return view('pages.users-profile', [
            'user' => $user,
            'address' => $address,
            'token' => $token
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $profile_request,  $id)
    {
        // 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $address = Address::where('user_id', $id)->first();

        return view();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $user = User::find(auth()->id());
        // $user->fullName = $user->first_name . ' ' . $user->last_name;
        
        // $address = Address::where('id_user', $user->id)->first();

        // return view('', [
        //     'dataEdit' => [
        //         'user' => $user,
        //         'address' => $address
        //     ]
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $profile_request, $id)
    {
        // $id = auth()->id();
        $user = User::find($id);
        // $addresses = Address::all();
        $address = Address::where('id_user', $id)->first();
        // dd($id);   

        if ($user) {
            // $validated = $profile_request->validated();
        
            if (!empty($profile_request['password'])) {
                $user->update([
                    // 'id_user' => $user->id,
                    'first_name' => $profile_request['first_name'],
                    'last_name' => $profile_request['last_name'],
                    'phone_number' => $profile_request['phone_number'],
                    'gender' => $profile_request['gender'],
                    'email' => $profile_request['email'],

                    // 'password' => bcrypt($profile_request['password']),
                    // 'birth_date' => $profile_request['birth_date'],
                ]);
            } else {
                $user->update([
                    // 'id_user' => $user->id,

                    'first_name' => $profile_request['first_name'],
                    'last_name' => $profile_request['last_name'],
                    'phone_number' => $profile_request['phone_number'],
                    'gender' => $profile_request['gender'],
                    'email' => $profile_request['email'],
                    // 'birth_date' => $profile_request['birth_date'],
                ]);
            };
            $token = TokenWhatsapp::first();


            if ($token){
                $token->update([
                    'token_wa' => $profile_request['token_wa'],
                    'target_wa' => $profile_request['target_wa'],
                ]);
            } else {
                TokenWhatsapp::create([
                    'token_wa' => $profile_request['token_wa'],
                    'target_wa' => $profile_request['target_wa'],
                ]);
            }

            if(!$address) { 
                Address::create([
                    'id_user' => $id,
                    'city' => $profile_request['city'],
                    'province' => $profile_request['province'],
                    'district' => $profile_request['district'],
                    'sub_district' => $profile_request['sub_district'],
                    'detail' => $profile_request['detail'],
                    'address_type' => $profile_request['address_type'],
                ]);
            } else {
                $address->update([
                    'id_user' => $id,
                    'city' => $profile_request['city'],
                    'province' => $profile_request['province'],
                    'district' => $profile_request['district'],
                    'sub_district' => $profile_request['sub_district'],
                    'detail' => $profile_request['detail'],
                    'address_type' => $profile_request['address_type'],
                ]);
            }

            

            if ($profile_request->hasFile('image_profile')) {
                if ($user->image_profile) {
                    Storage::delete($user->image_profile);
                }
            
                $imageName = time() . '.' . $profile_request->file('image_profile')->getClientOriginalExtension();
                $profile_request->file('image_profile')->storeAs('public/gallery', $imageName);
                $user->update([
                    'image_profile' => "storage/gallery/" . $imageName,
                ]);
            }

            // dd($profile_request);

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::find($id);

        if ($address) {
            $address->delete();
        }

        return redirect();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Address;
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
        $user->fullName = $user->first_name . ' ' . $user->last_name;

        $address = Address::where('id_user', $user->id)->first();
        
        // $address->alamat = $address->city . ',' . $address->province . ' ' . $address->district . ' ' . $address->sub_district;
        return view('pages.users-profile', [
            'user' => $user,
            'address' => $address
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
        $user = User::find(auth()->id());
        $user->fullName = $user->first_name . ' ' . $user->last_name;
        
        $address = Address::where('id_user', $user->id)->first();

        return view('', [
            'dataEdit' => [
                'user' => $user,
                'address' => $address
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $profile_request,  $id)
    {

        dd($profile_request);

        $user = User::find($id);
        $address = Address::where('id_user', $id)->first();

        if ($user && $address) {
            $validated = $profile_request->validated();

            if (!empty($validated['password'])) {
                $user->update([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'phone_number' => $validated['phone_number'],
                    'gender' => $validated['gender'],
                    'email' => $validated['email'],
                    // 'password' => bcrypt($validated['password']),
                    'birth_date' => $validated['birth_date'],
                ]);
            } else {
                $user->update([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'phone_number' => $validated['phone_number'],
                    'gender' => $validated['gender'],
                    'email' => $validated['email'],
                    'birth_date' => $validated['birth_date'],
                ]);
            }

            $address->update([
                'city' => $validated['city'],
                'province' => $validated['province'],
                'district' => $validated['district'],
                'sub_district' => $validated['sub_district'],
                'detail' => $validated['detail'],
                'address_type' => $validated['address_type'],
            ]);

            if ($validated->hasFile('image_profile')) {
                Storage::delete($user->image_profile);
                $user->update([
                    'image_profile' => $validated->file('image_profile')->store('image_profile'),
                ]);
            }

            return redirect()->route('profile');
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

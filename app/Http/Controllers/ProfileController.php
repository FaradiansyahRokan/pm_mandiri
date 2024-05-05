<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Address;
use App\Models\User;
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
        // $address->alamat = $address->city . ',' . $address->province . ' ' . $address->district . ' ' . $address->sub_district;
        return view('pages.users-profile' , ['user' => $user]);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $profile_request, AddressRequest $address_request,  $id)
    {
        $user = User::find($id);
        $address = Address::where('user_id', $id)->first();

        if (!$address) {
            $address = new Address();
            $address->user_id = $id;
        }

        $validated1 = $profile_request->validated();
        $validated2 = $address_request->validated();

        $user->last_name = $validated1['last_name'];
        $user->phone_number = $validated1['phone_number'];
        $user->gender = $validated1['gender'];
        $user->birth_date = $validated1['birth_date'];
        $user->save();

        $address->city = $validated2['city'];
        $address->province = $validated2['province'];
        $address->district = $validated2['district'];
        $address->sub_district = $validated2['sub-district'];
        $address->detail = $validated2['detail'];
        $address->address_type = $validated2['address_type'];
        $address->save();

        return redirect();
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
    public function edit(string $id)
    {
        $user = User::find($id);
        $address = Address::where('user_id', $id)->first();

        return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $profile_request, AddressRequest $address_request,  $id)
    {
        $user = User::find($id);
        $address = Address::find($id);

        if ($user && $address) {
            $validated1 = $profile_request->validated();
            $validated2 = $address_request->validated();

            if (!empty($validated1['password'])) {
                $user->update([
                    'first_name' => $validated1['first_name'],
                    'last_name' => $validated1['last_name'],
                    'phone_number' => $validated1['phone_number'],
                    'gender' => $validated1['gender'],
                    'password' => bcrypt($validated1['password']),
                    'birth_date' => $validated1['birth_date'],
                ]);
            } else {
                $user->update([
                    'first_name' => $validated1['first_name'],
                    'last_name' => $validated1['last_name'],
                    'phone_number' => $validated1['phone_number'],
                    'gender' => $validated1['gender'],
                    'birth_date' => $validated1['birth_date'],
                ]);
            }

            $address->update([
                'city' => $validated2['city'],
                'province' => $validated2['province'],
                'district' => $validated2['district'],
                'sub-district' => $validated2['sub-district'],
                'detail' => $validated2['detail'],
                'address_type' => $validated2['address_type'],
            ]);

            if ($profile_request->hasFile('image_profile')) {
                Storage::delete($user->image_profile);
                $user->update([
                    'image_profile' => $profile_request->file('image_profile')->store('image_profile'),
                ]);
            }

            return redirect()->route('nama_rute');
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

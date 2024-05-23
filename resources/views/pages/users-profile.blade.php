@extends('layouts.dash')

@section('dashboard')
    

<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          @if($user->image_profile)
            <img src="{{  $user->image_profile }}" class="img-thumbnail bulat" alt="Profile Image">
          @else
            <img src="https://ui-avatars.com/api/?name={{ $user->first_name }}" class="img-thumbnail bulat" alt="Profile Image">
          @endif
          <h2></h2>
          <h3 id="fullName">{{ $user->first_name }} {{ $user->last_name }}</h3>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item"> 
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">About</h5>
              <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

              <h5 class="card-title">Profile Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                <div class="col-lg-9 col-md-8">{{ $user->fullName}}</div>
              </div>

  
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Country</div>
                <div class="col-lg-9 col-md-8">USA</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Address</div>
                <div class="col-lg-9 col-md-8">
                  @if($address)
            {{ $address->city }}, {{ $address->province }}, {{ $address->district }}, {{ $address->sub_district }}, {{ $address->detail }}, {{ $address->address_type }}
        @else
            No address available.
        @endif
                </div>
              </div>


              <div class="row">
                <div class="col-lg-3 col-md-4 label">Phone</div>
                <div class="col-lg-9 col-md-8">
                  @if($user->phone_number === null)
                  No phone number available
                  @else
                  {{ $user->phone_number}}
                @endif
              </div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8">@if($user->email === null)
                  No email available
                  @else
                  {{ $user->email}}
                @endif</div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form action="{{ route('profile.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    @if($user->image_profile)
                    <img src="{{  $user->image_profile }}" class="img-thumbnail bulat" alt="Profile Image">
                  @else
                    <img src="https://ui-avatars.com/api/?name={{ $user->first_name }}" class="img-thumbnail bulat" alt="Profile Image">
                  @endif
                    <div class="pt-2">
                      <input id="image_profile" class="form-control @error('image_profile') is-invalid @enderror" name="image_profile"
                                            value="{{ old('image_profile') }}" required autocomplete="image_profile" type="file">
                    </div>
                  </div>

                  {{-- <div class="col-md-8 col-lg-9">
                    <img src="{{ $user->image_profile ? asset($user->image_profile) : 'https://ui-avatars.com/api/?name=' . Auth::user()->first_name }}" class="img-thumbnail bulat" alt="Profile Image">
                    <div class="pt-2">
                      <input id="image_profile" class="form-control @error('image_profile') is-invalid @enderror" name="image_profile" type="file" style="display: none;" onchange="this.form.submit()">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" onclick="document.getElementById('image_profile').click();">
                        <i class="bi bi-upload"></i>
                      </a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div> --}}
                </div>

                <div class="row mb-3">
                  <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="first_name" type="text" class="form-control" id="first_name" value="{{ $user->first_name}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="last_name" type="text" class="form-control" id="last_name" value="{{ $user->last_name}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="country" type="text" class="form-control" id="Country" value="USA">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="phone_number" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                  <div class="col-md-8 col-lg-9">
                    @if($user->phone_number === null) 
                    <input name="phone_number" type="text" class="form-control" id="phone_number" value="">
                    @else
                    <input name="phone_number" type="text" class="form-control" id="phone_number" value="{{ $user->phone_number }}">
                    @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                  <div class="col-md-8 col-lg-9">
                    {{-- @if($address->city === null || $address === null) --}}
                    <input name="city" type="text" class="form-control" id="city" value="">
                    {{-- @else
                    <input name="city" type="text" class="form-control" id="city" value="{{ $address->city }}">
                    @endif --}}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="province" class="col-md-4 col-lg-3 col-form-label">Province</label>
                  <div class="col-md-8 col-lg-9">
                    {{-- @if($address->province === null || $address === null) --}}
                    <input name="province" type="text" class="form-control" id="province" value="">
                    {{-- @else
                    <input name="province" type="text" class="form-control" id="province" value="{{ $address->province }}">
                    @endif --}}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="district" class="col-md-4 col-lg-3 col-form-label">District</label>
                  <div class="col-md-8 col-lg-9">
                    {{-- @if($address->district === null || $address === null) --}}
                    <input name="district" type="text" class="form-control" id="district" value="">
                    {{-- @else
                    <input name="district" type="text" class="form-control" id="district" value="{{ $address->district }}">
                    @endif --}}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="sub_district" class="col-md-4 col-lg-3 col-form-label">Sub District</label>
                  <div class="col-md-8 col-lg-9">
                    {{-- @if($address->sub_district === null || $address === null) --}}
                    <input name="sub_district" type="text" class="form-control" id="sub_district" value="">
                    {{-- @else
                    <input name="sub_district" type="text" class="form-control" id="sub_district" value="{{ $address->sub_district }}">
                    @endif --}}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="detail" class="col-md-4 col-lg-3 col-form-label">Detail</label>
                  <div class="col-md-8 col-lg-9">
                    {{-- @if( $address->detail === null || $address === null) --}}
                    <input name="detail" type="text" class="form-control" id="detail" value="">
                    {{-- @else
                    <input name="detail" type="text" class="form-control" id="detail" value="{{  $address->detail }}">
                    @endif --}}
                  </div>
                </div>

                {{-- @dd($user) --}}

                <div class="row mb-3">
                  <label for="address_type" class="col-md-4 col-lg-3 col-form-label">Address Type</label>
                  <div class="col-md-8 col-lg-9">
                    {{-- @if( $address->address_type === null || $address === null) --}}
                    <input name="address_type" type="text" class="form-control" id="address_type" value="">
                    {{-- @else
                    <input name="address_type" type="text" class="form-control" id="address_type" value="{{  $address->address_type }}">
                    @endif --}}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="email" value="{{ $user->email}}">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
              </form><!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">

              <!-- Settings Form -->
              <form>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="changesMade" checked>
                      <label class="form-check-label" for="changesMade">
                        Changes made to your account
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="newProducts" checked>
                      <label class="form-check-label" for="newProducts">
                        Information on new products and services
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="proOffers">
                      <label class="form-check-label" for="proOffers">
                        Marketing and promo offers
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                      <label class="form-check-label" for="securityNotify">
                        Security alerts
                      </label>
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End settings Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form>

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>
@endsection
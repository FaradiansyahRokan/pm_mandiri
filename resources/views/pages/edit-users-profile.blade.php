<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit - Peti Ngemil</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">


    <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Peti Ngemil</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->first_name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->first_name }}</h6>
                            <span>{{ Auth::user()->first_name }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('product') }}">
                            <i class="bi bi-circle"></i><span>Create</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->


            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->


        </ul>

    </aside><!-- End Sidebar-->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
          <div class="row">
            <div class="col-xl-4">
        
              <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        
                  <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                  <h2></h2>
                  <h3 id="fullName">{{ $dataEdit['user']->fullName}}</h3>
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
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                    </li>
        
                    <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                    </li>
        
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                    </li>
        
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                    </li>
        
                  </ul>
                  <div class="tab-content pt-2">

                    {{-- <div class="tab-pane fade show active profile-overview" id="profile-overview">
                      <h5 class="card-title">About</h5>
                      <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>
        
                      <h5 class="card-title">Profile Details</h5>
        
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                        <div class="col-lg-9 col-md-8">{{ $dataEdit['user']->fullName}}</div>
                      </div>
        
          
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Country</div>
                        <div class="col-lg-9 col-md-8">USA</div>
                      </div>
        
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Address</div>
                        <div class="col-lg-9 col-md-8">{{ $dataEdit['address']->city }}, {{ $dataEdit['address']->province }}, {{ $dataEdit['address']->district }}, {{ $dataEdit['address']->sub_district }}, {{ $dataEdit['address']->detail }}, {{ $dataEdit['address']->address_type }}</div>
                      </div>
        
        
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Phone</div>
                        <div class="col-lg-9 col-md-8">{{ $dataEdit['user']->phone}}</div>
                      </div>
        
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email</div>
                        <div class="col-lg-9 col-md-8">{{ $dataEdit['user']->email}}</div>
                      </div>
        
                    </div> --}}
        
                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
        
                      <!-- Profile Edit Form -->
                      <form action="{{ route('profile.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                          <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                          <div class="col-md-8 col-lg-9">
                            <img src="assets/img/profile-img.jpg" alt="Profile">
                            <div class="pt-2">
                              <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                              <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                            </div>
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="first_name" type="text" class="form-control" id="first_name" value="{{ $dataEdit['user']->first_name}}">
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="last_name" type="text" class="form-control" id="last_name" value="{{ $dataEdit['user']->last_name}}">
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
                            <input name="phone_number" type="text" class="form-control" id="phone_number" value="{{ $dataEdit['user']->phone_number }}">
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="city" type="text" class="form-control" id="city" value="{{ $dataEdit['address']->city }}">
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="province" class="col-md-4 col-lg-3 col-form-label">Province</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="province" type="text" class="form-control" id="province" value="{{ $dataEdit['address']->province }}">
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="district" class="col-md-4 col-lg-3 col-form-label">District</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="district" type="text" class="form-control" id="district" value="{{ $dataEdit['address']->district }}">
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="sub-district" class="col-md-4 col-lg-3 col-form-label">Sub District</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="sub-district" type="text" class="form-control" id="sub-district" value="{{ $dataEdit['address']->sub_district }}">
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="detail" class="col-md-4 col-lg-3 col-form-label">Detail</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="detail" type="text" class="form-control" id="detail" value="{{ $dataEdit['address']->detail }}">
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="address_type" class="col-md-4 col-lg-3 col-form-label">Address Type</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="address_type" type="text" class="form-control" id="address_type" value="{{ $dataEdit['user']->address_type }}">
                          </div>
                        </div>
        
                        <div class="row mb-3">
                          <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="email" type="email" class="form-control" id="email" value="{{ $dataEdit['user']->email}}">
                          </div>
                        </div>
        
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      </form><!-- End Profile Edit Form -->
        
                    </div>
        
                   
        
                    {{-- <div class="tab-pane fade pt-3" id="profile-settings">
        
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
        
                    </div> --}}
        
                  </div><!-- End Bordered Tabs -->
        
                </div>
              </div>
        
            </div>
          </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <!-- Template Main JS File -->
    <script src="{{ url('assets/js/main.js') }}"></script>
    <script src="{{ url('assets/vendor/quill/quill.js')}}"></script>

</body>

</html>





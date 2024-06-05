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
            <a href="{{ route('home')}}" class="logo d-flex align-items-center">
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
            @if(Auth::user() && Auth::user()->role == 'admin')
            <a class="nav-link " href="{{ route('dashboard')}}">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
            </a>
          </li>
    
          <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.transactions')}}">
              <i class="bi bi-credit-card"></i>
              <span>Transactions</span>
            </a>
          </li>
    
         <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('product')}}">
                        <i class="bi bi-circle"></i><span>Create Product</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category')}}">
                        <i class="bi bi-circle"></i><span>Add Category</span>
                    </a>
                </li>
            </ul>
            <li class="nav-heading">Pages</li>
    
          <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profile') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
            @else
    
            <li class="nav-item">
              <a class="nav-link " href="{{ route('home')}}">
                <i class="ri-handbag-line"></i>
                <span>Home</span>
              </a>
            </li><!-- End Dashboard Nav -->
            
                  <li class="nav-heading">Pages</li>
            
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('profile') }}">
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                </li><!-- End Profile Page Nav -->
    
        @endif
    </li><!-- End Components Nav -->
    
    
          {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profile', auth()->user()->id) }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav --> --}}
        
    
          <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.html">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Login</span>
            </a>
          </li><!-- End Login Page Nav -->
    
        </ul>
    
      </aside><!-- End Sidebar-->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Edit</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card w-100">
                        <div class="card-body w-100">
                            <h5 class="card-title">Edit Product</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('update' , $dataEdit->id) }}"
                                enctype="multipart/form-data">
                                @method('patch')
                                @csrf

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Product</label>
                                    <div class="col-sm-10">
                                        <input id="name_product" type="text"
                                            class="form-control @error('name_product') is-invalid @enderror"
                                            name="name_product" value="{{$dataEdit->name_product}}"
                                            autocomplete="name_product">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        {{-- <div class="card">
                                            <div class="card-body">
                                              <h5 class="card-title">Quill Editor Default</h5>
                                
                                              <!-- Quill Editor Default -->
                                              <div class="quill-editor-default">
                                                <p>Hello World!</p>
                                                <p>This is Quill <strong>default</strong> editor</p>
                                              </div>
                                              <!-- End Quill Editor Default -->
                                
                                            </div>
                                          </div> --}}
                                          <textarea id="description_product" class="form-control @error('description_product') is-invalid @enderror"
                                              style="height: 100px" name="description_product"
                                              autocomplete="description_product">{{$dataEdit->description_product}}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input id="price" type="number"
                                            class="form-control @error('price') is-invalid @enderror" name="price"
                                            value="{{$dataEdit->price}}" autocomplete="price">
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Jumlah Stok</label>
                                    <div class="col-sm-10">
                                        <input id="qty" type="number"
                                            class="form-control @error('qty') is-invalid @enderror" name="qty"
                                            value="{{$dataEdit->qty}}" autocomplete="qty">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                    <div class="col-sm-10">
                                        <input id="image_product" class="form-control @error('image_product') is-invalid @enderror" name="image_product"
                                            value="{{$dataEdit->image_product}}" autocomplete="image_product" type="file">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category Rasa</label>
                                    <div class="col-sm-10">
                                        <select id="id_category_flavour" class="form-select"
                                            aria-label="Default select example" name="id_category_flavour"
                                            value="{{ old('id_category_flavour') }}"
                                            autocomplete="id_category_flavour">

                                            {{-- <option selected>Open this select menu</option> --}}
                                            @foreach ($data_flavours as $dataFlavour)
                                                <option value="{{ $dataFlavour->id }}">
                                                    {{ $dataFlavour->list_flavour }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category Ukuran</label>
                                    <div class="col-sm-10">
                                        <select id="id_category_size" class="form-select"
                                            aria-label="Default select example" name="id_category_size"
                                            value="{{ old('id_category_size') }}"
                                            autocomplete="id_category_size">

                                            {{-- <option selected>Open this select menu</option> --}}
                                            @foreach ($data_sizes as $datasize)
                                                <option value="{{ $datasize->id }}">
                                                    {{ $datasize->list_size }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category Menu</label>
                                    <div class="col-sm-10">
                                        <select id="id_category_menu" class="form-select"
                                            aria-label="Default select example" name="id_category_menu"
                                            value="{{ old('id_category_menu') }}" autocomplete="id_category_menu">

                                            {{-- <option selected>Open this select menu</option> --}}
                                            @foreach ($data_menus as $datamenu)
                                                <option value="{{ $datamenu->id }}">
                                                    {{ $datamenu->list_menu }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Submit Button</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit Form</button>
                                    </div>
                                </div>

                            </form>
                            <!-- End General Form Elements -->

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

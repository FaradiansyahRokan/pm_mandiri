<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Forms - Peti Ngemil</title>
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
    <link href="{{ url('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('home')}}" class="logo d-flex align-items-center" style="text-decoration: none">
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
            <h1>Transactions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="text-decoration: none">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item">Transactions</li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        
<div class="container">
    <h1>Checkout</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Detail</th>
                    <th>Total Harga</th>
                    <th>Ongkir</th>
                    <th>Berat</th>
                </tr>
            </thead>
            
            {{-- @foreach ($transactionItems as $transactionItem) --}}
            <form action="{{ route('admin.transactions.add', $dataTransaction->id) }}" method="POST">
                @csrf
            <tbody>
                <tr>
                    <td>Nama : {{$user->fullName}}, <br> Alamat : {{$formattedAddress }} <br>  No. Telepon : {{$user->phone_number}} <br>
                        
                        Barang : 
                        @foreach($dataTransaction->transactionItems as $item)
                            {{$item->product->name_product}},
                            @endforeach
                            
                            <br> Notes : {{ $dataTransaction->notes }}</td>
                            <td>
                                <p>RP {{ number_format($dataTransaction->total_price, 0, ',', '.') }}</p>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="number" name="ongkir" value="" min="1" class="form-control" style="width: 100px;" oninput="updateTotalPrice({{ $dataTransaction->total_price }})">
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>            
                </form>
        </table>
    </div>
    <a href="{{ route('admin.transactions.exportPdf', $dataTransaction->id) }}" class="btn btn-primary">Print PDF</a>
</div>
        
        
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <!-- Template Main JS File -->
    <script src="{{ url('assets/js/main.js') }}"></script>
    <script src="{{ url('assets/vendor/quill/quill.js')}}"></script>
    <script src="{{ url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script>
    function updateTotalPrice(totalPrice) {
        var ongkir = document.querySelector('input[name="ongkir"]').value;
        var totalPriceWithOngkir = totalPrice + parseFloat(ongkir);
        document.getElementById('totalPriceWithOngkir').textContent = new Intl.NumberFormat('id-ID').format(totalPriceWithOngkir);
    }
    </script>

</body>

</html>









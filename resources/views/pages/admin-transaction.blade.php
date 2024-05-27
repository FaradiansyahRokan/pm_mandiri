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
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.transactions')}}">
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
            <h1>Transactions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Transactions</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Transactions</h5>
          
        
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
              </thead>
        
                  <tbody>
                    @foreach($transactions as $trans)
                    <tr>
                        <td>{{ $trans->id }}</td>
                        <td>{{ $trans->user->first_name }}</td>
                        <td>
                            <ul>
                                @foreach($trans->transactionItems as $item)
                                    <li>{{ $item->product->name_product }} ({{ $item->qty }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>RP {{ number_format($trans->total_price, 0, ',', '.') }}</td>
                        <td>{{ $trans->status }}</td>
                        <td>
                            <form action="{{ route('admin.transactions.updateStatus', $trans->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()">
                                    <option value="PENDING" {{ $trans->status == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                    <option value="SUCCESSFULL" {{ $trans->status == 'SUCCESSFULL' ? 'selected' : '' }}>Successfull</option>
                                    <option value="IN PROCESS" {{ $trans->status == 'IN PROCESS' ? 'selected' : '' }}>In Process</option>
                                    <option value="SHIPPING" {{ $trans->status == 'SHIPPING' ? 'selected' : '' }}>Shipping</option>
                                    <option value="ARRIVED" {{ $trans->status == 'ARRIVED' ? 'selected' : '' }}>Arrived</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            
              </tbody>
              </table>
              <!-- End Table with stripped rows -->
        
            </div>
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

</body>

</html>






@extends('layouts.app')

@section('content')
<div class="container-fluid luar">
    <div class="main product d-flex align-items-center justify-content-evenly flex-wrap">
        <div class="product-image">
            <img src="{{ asset($products->image_product) }}" alt="" class="img-fluid" style="max-width: 100%; height: auto;">
        </div>
        <aside class="d-flex align-items-center">
            <div class="product-aside" style="max-width: 800px;">
                <div class="product-text">
                    <h1 class="product-title fw-bold">{{ $products->name_product }}</h1>
                    <div class="product-desc">
                        <h3 class="mt-4 fs-3">{{ $products->description_product }}</h3>
                        <h1 class="product-price fw-bold mt-5" style="font-size: 50px;">RP {{ number_format($products->price, 0, ',', '.') }}</h1>
                    </div>
                </div>
                <div class="product-select mt-5">
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="card">
                                <form action="{{ route('cart.add', $products->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-lg btn-block text-dark fw-bold shadow p-2 bg-body-tertiary rounded" style="background-color: #DBD3CD;">
                                        + Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<div class="container">
    <div class="row mt-4">
        @foreach(range(1, 8) as $index)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-3">
                <a href="{{ route('detail', $products->id)}}" class="list">
                    <div class="card text-center" style="background-color: #DBD3CD">
                        <div class="img__product">
                            <img src="{{ url('images/content 5.png')}}" class="card-img-top img-fluid" alt="...">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">XLMK Tour LS</h6>
                            <p class="card-text mt-2">Rp. 199.000</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="col-12 text-center mt-3">
        <a href="#" class="btn btn-outline-dark rounded-2 px-4 py-2 text-uppercase" style="width: 30%;">View More</a>
    </div>
</div>

<style>
    .main {
        background-image: url('{{ url('images/bg2.png') }}');
        background-size: cover;
        min-height: 100vh;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
    }
    .product-image img {
        width: 100%;
        max-width: 500px;
        height: auto;
    }
    .product-aside {
        max-width: 800px;
        margin: 20px;
    }
    .cart-total {
        background-color: #f9f1e7;
        padding: 20px;
        border-radius: 10px;
    }
    .cart-total .btn-checkout {
        background-color: #f9f1e7;
        border: 2px solid #000;
        color: #000;
        font-weight: bold;
    }
    .cart-total .btn-checkout:hover {
        background-color: #b88e2f;
        border-color: #b88e2f;
        color: #fff;
    }
    .card {
        margin: 10px 0;
    }
    .img__product img {
        max-width: 100%;
        height: auto;
    }
    .wrapper {
        margin-top: 30px;
        height: 50px;
        min-width: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }
    .wrapper span {
        width: 100%;
        text-align: center;
        font-size: 25px;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
    }
    .wrapper span.num {
        font-size: 20px;
        border-right: 2px solid rgba(0,0,0,0.2);
        border-left: 2px solid rgba(0,0,0,0.2);
        pointer-events: none;
    }
    .list {
        text-decoration: none;
    }
    @media (max-width: 768px) {
        .product-image, .product-aside {
            text-align: center;
            max-width: 100%;
        }
    }
</style>
@endsection

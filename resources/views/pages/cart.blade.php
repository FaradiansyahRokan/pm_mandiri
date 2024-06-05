@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Your Shopping Cart</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-hover cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price & Size</th>
                            {{-- <th>Size</th> --}}
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->product->image_product }}" alt="">
                                {{ $item->product->name_product }}
                            </td>
                            {{-- <td>
                                <form action="{{ route('cart.update', $item->id_product) }}" method="POST" class="update-cart-form">
                                    @csrf
                                    <select name="size_price" onchange="this.form.submit()">
                                        @foreach ($categorySize as $size)
                                            <option value="{{$size->id}}">{{ $size->list_size }} - RP {{ number_format($size->price, 0, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td> --}}
                            <td>
                                <form action="{{ route('cart.update', $item->id_product) }}" method="POST" class="update-cart-form">
                                    @csrf
                                    <select name="id_size" onchange="this.form.submit()">
                                        @foreach ($categorySize as $size)
                                            <option value="{{ $size->id }}" {{ $item->id_size == $size->id ? 'selected' : '' }}>
                                                {{ strtoupper(str_replace('-', ' ', $size->list_size)) }} - RP {{ number_format($size->price, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            {{-- <td>RP {{ number_format($item->product->price, 0, ',', '.') }}</td> --}}
                            <td>
                                <form action="{{ route('cart.update', $item->id_product) }}" method="POST" class="update-cart-form">
                                    @csrf
                                    <div class="input-group">
                                        <input type="number" name="quantity" value="{{ $item->qty }}" min="1" class="form-control quantity-input" style="width: 60px;">
                                    </div>
                                </form>
                            </td>
                            <td>RP {{ number_format($item->size->price * $item->qty, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.delete', $item->id_product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="cart-total">
                    <h5>Cart Totals</h5>
                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <strong>RP {{ number_format($totalPrice, 0, ',', '.') }}</strong>
                    </div>
                    @if($address->city != null)
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="notes">Catatan untuk Admin:</label>
                            <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-checkout btn-block mt-4">Checkout</button>
                    </form>
                    @else
                    <div class="alert alert-warning mt-4">
                        Anda belum memiliki alamat pengiriman. Silakan tambahkan alamat terlebih dahulu.
                    </div>
                    <a href="{{ route('profile') }}" class="btn btn-primary btn-block mt-4">Tambah Alamat</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInputs = document.querySelectorAll('.quantity-input');

        quantityInputs.forEach(input => {
            input.addEventListener('change', function () {
                const form = input.closest('form');
                form.submit();
            });
        });
    });
</script>

<style>
    .cart-table img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .cart-table th, .cart-table td {
        vertical-align: middle;
        text-align: center;
    }
    .cart-total {
        background-color: #f9f1e7;
        padding: 20px;
        border-radius: 10px;
    }
    .cart-total h5 {
        margin-bottom: 20px;
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
</style>

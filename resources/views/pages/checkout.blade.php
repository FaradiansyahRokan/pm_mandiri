@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name_product }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>RP {{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td>RP {{ number_format($item->total_price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary">Proceed to Payment</button>
    </div>
</div>
@endsection

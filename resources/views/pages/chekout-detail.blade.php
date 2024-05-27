@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4 text-center">Checkout Detail</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm mb-5">
                <div class="card-header text-black" style="background-color: #F9F1E7">
                    <h3 class="mb-0">Purchased Items</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction->transactionItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name_product }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $transaction->status }}</td>
                                        <td>RP {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>RP {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table">
                                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                    <td><strong style="color: #B88E2F">RP {{ number_format($transaction->transactionItems->sum(function($item) { return $item->price * $item->qty; }), 0, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <h3 class="mb-4 text-center">My Ongoing Transactions</h3>
            
            <div class="card shadow-sm mb-5">
                <div class="card-header text-black" style="background-color: #F9F1E7">
                    <h3 class="mb-0">Ongoing Transactions</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Produk</th>
                                    <th>Date</th>
                                    <th>Total Price</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ongoingTransactions as $trans)
                                    <tr>
                                        <td>{{ $trans->id }}</td>
                                        <td>
                                            <ul style="list-style: none;">
                                                @foreach($trans->transactionItems as $item)
                                                    <li>{{ $item->product->name_product }} ({{ $item->qty }})</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $trans->created_at->format('d M Y H:i') }}</td>
                                        <td>RP {{ number_format($trans->total_price, 0, ',', '.') }}</td>
                                        <td><a href="{{ route('checkout.detail', $trans->id) }}" class="btn btn-primary btn-sm">View Details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <h3 class="mb-4 text-center">My Transaction History</h3>
            
            <div class="card shadow-sm">
                <div class="card-header text-black" style="background-color: #F9F1E7">
                    <h3 class="mb-0">Transaction History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Produk</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedTransactions as $trans)
                                    <tr>
                                        <td>{{ $trans->id }}</td>
                                        <td>
                                            <ul style="list-style: none;">
                                                @foreach($trans->transactionItems as $item)
                                                    <li>{{ $item->product->name_product }} ({{ $item->qty }})</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $trans->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $transaction->status}}</td>
                                        <td>RP {{ number_format($trans->total_price, 0, ',', '.') }}</td>
                                        <td><a href="{{ route('checkout.detail', $trans->id) }}" class="btn btn-primary btn-sm">View Details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('home') }}" class="btn btn-secondary">Continue Shopping</a>
                {{-- <a href="{{ route('payment', ['transaction' => $transaction->id]) }}" class="btn btn-success">Proceed to Payment</a> --}}
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .card-header {
        background-color: #007bff;
        color: #ffffff;
        padding: 20px;
        font-size: 24px;
        text-align: center;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .btn-primary, .btn-secondary, .btn-success {
        width: 200px;
        margin: 10px;
    }
    .btn-primary:hover, .btn-secondary:hover, .btn-success:hover {
        opacity: 0.8;
    }
    .text-center {
        text-align: center;
    }
    .text-end {
        text-align: end;
    }
</style>

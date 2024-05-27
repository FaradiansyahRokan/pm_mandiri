@extends('layouts.app')

@section('content')
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css"rel="stylesheet">
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
                <div class="text-center">
                    <h6>Download Receipt Terlebih Dahulu Kemudian Kirimkan receipt ke nomor berikut</h6>
                    <a href="{{ route('checkout.download', $transaction->id) }}" class="btn btn-success">Download Receipt</a>
                    <form action="{{ route('checkout.contact')}}" method="POST">
                        @csrf
                    {{-- <a href="https://wa.me/6285109580607" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"></path>
                          </svg>
                        Contact Us
                    </a> --}}
                    <button class="btn" type="submit">Contact Us</button>
                </form>
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
                                    <th>Status</th>
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
                                                @if($item->product)
                                                    <li>{{ $item->product->name_product }} ({{ $item->qty }})</li>
                                                @else
                                                    <li>Product not found ({{ $item->qty }})</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $trans->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $trans->status }}</td>
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
                                                @if($item->product)
                                                    <li>{{ $item->product->name_product }} ({{ $item->qty }})</li>
                                                @else
                                                    <li>Product not found ({{ $item->qty }})</li>
                                                @endif
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

            <div class="mt-4 text-center">
                <a href="{{ route('home') }}" class="btn btn-secondary">Continue Shopping</a>
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

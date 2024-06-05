@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h1>Halaman untuk Produk: {{ $category->list_menu }}</h1> --}}
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($sortCategory->isEmpty())
        <p>Tidak ada produk dalam kategori ini.</p>
    @else
        <div class="row">
            @foreach($sortCategory as $product)
            <div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
                <a href="{{ route('detail', $product->id)}}" class="list">
                  <div class="card text-center" style="background-color: #DBD3CD">
                    <div class="img__product"> 
                      <img class="card-img-top"  style="max-height: 313px; max-width: auto; height:auto; width:auto;" src="{{ asset($product->image_product) }}" alt="Product Image">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title fw-bold fs-5">{{ $product->name_product }}</h5>
                      <p class="card-text mt-2 fs-5">Rp. {{  number_format($product->categorySize->price, 0, ',', '.')}}</p>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
<style>
    .list{
  text-decoration: none
}
</style>

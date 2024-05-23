@extends('layouts.app')

@section('content')
@foreach ($sortCategory as $product)
      
<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $product->id)}}" class="list">
    <div class="card text-center" style="background-color: #DBD3CD">
      <div class="img__product"> 
        <img class="card-img-top"  style="max-height: 313px; max-width: auto; height:auto; width:auto;" src="{{ asset($product->image_product) }}" alt="Product Image">
      </div>
      <div class="card-body">
        <h5 class="card-title fw-bold fs-5">{{ $product->name_product }}</h5>
        <p class="card-text mt-2 fs-5">Rp. {{  number_format($product->price, 0, ',', '.')}}</p>
        
      </div>
    </div>
  </a>
</div>
@endforeach
@endsection

<style>
    .list{
  text-decoration: none
}
</style>
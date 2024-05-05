@extends('layouts.dash')

@section('dashboard')
    
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Product</h5>
  

      <!-- Table with stripped rows -->
      <table class="table datatable">
        <thead>
          <tr>
              <th>Category</th>
              <th>Rasa</th>
              <th>Ukuran</th>
              <th>Harga</th>
              <th>Jumlah</th>
          </tr>
      </thead>
      <tbody>
          @foreach($data as $product)
          @foreach ($cat as $cats)
          <tr>
            <td>{{ $cats->productFlavour->list_flavour }}</td>
            <td>{{ $product->id_category_menu }}</td>
            <td>{{ $product->id_category_size }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->qty }}</td>
        </tr>
              
          @endforeach
          @endforeach
      </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>
</section>

@endsection
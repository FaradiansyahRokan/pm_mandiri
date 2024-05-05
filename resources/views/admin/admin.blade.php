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
              <th>Jumlah</th>
              <th>Detail</th>
          </tr>
      </thead>
      {{-- <tbody>
          @foreach($data as $product)
          <tr>
            <td>{{ $categoryFlavour->list_flavour }}</td>
            <td>{{ $product->id_category_menu }}</td>
            <td>{{ $product->id_category_size }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->qty }}</td>
        </tr>
              
          @endforeach --}}

          <tbody>
            @foreach($data['products'] as $product)
            <tr>
                {{-- Tampilkan nama kategori rasa dari produk saat ini --}}
                <td>
                  {{-- Mencari kategori menu yang sesuai berdasarkan ID kategori menu produk --}}
                  @php
                      $categoryMenu = $data['categoryMenus']->where('id', $product->id_category_menu)->first();
                  @endphp
                  {{ $categoryMenu->list_menu ?? '' }}
                </td>
                <td>
                    {{-- Mencari kategori rasa yang sesuai berdasarkan ID kategori rasa produk --}}
                    @php
                        $categoryFlavour = $data['categoryFlavours']->where('id', $product->id_category_flavour)->first();
                    @endphp
                    {{ $categoryFlavour->list_flavour ?? '' }}
                </td>
              
              <td>
                  {{-- Mencari kategori ukuran yang sesuai berdasarkan ID kategori ukuran produk --}}
                  @php
                      $categorySize = $data['categorySizes']->where('id', $product->id_category_size)->first();
                  @endphp
                  {{ $categorySize->list_size ?? '' }}
              </td>
                {{-- <td>{{ $product->price }}</td> --}}
                <td>{{ $product->qty }}</td>
                <td><a href="{{ route('show-product' , $product->id)}}" class="btn btn-primary">LIHAT PRODUK</a></td>
            </tr>
            @endforeach
        </tbody>
    
      </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>
</section>

@endsection
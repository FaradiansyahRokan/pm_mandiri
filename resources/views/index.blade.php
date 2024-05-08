@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner" style="height: 800px">
      <div class="carousel-item active">
        <div class="main container-fluid">
    <div class="container d-flex flex-row justify-content-evenly">
    <div class="tex-content  d-flex align-items-top">
        <div class="pp">
            <h5>MAKARONI</h5>
            <h3>CABAI MERAH</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, recusandae quaerat. Voluptatem repellat in minima, ab architecto corrupti qui eum nisi ipsam iusto quod ipsa delectus optio, quibusdam rerum unde.</p>
        </div>
    </div>

    <div class="image">
        <img src="{{ url('images/cabe1.png')}}" alt="" class="img_car">
    </div>
</div>
</div>
      </div>
      <div class="carousel-item">
        <div class="main container-fluid">
    <div class="container d-flex flex-row justify-content-evenly">
    <div class="tex-content  d-flex align-items-top">
        <div class="pp">
            <h5>USUS KRISPI</h5>
            <h3>CABAI MERAH</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, recusandae quaerat. Voluptatem repellat in minima, ab architecto corrupti qui eum nisi ipsam iusto quod ipsa delectus optio, quibusdam rerum unde.</p>
        </div>
    </div>

    <div class="image">
        <img src="{{ url('images/cabe2.png')}}" alt="" class="img_car">
    </div>
</div>
</div>
      </div>
      <div class="carousel-item">
        <div class="main container-fluid">
    <div class="container d-flex flex-row justify-content-evenly">
    <div class="tex-content  d-flex align-items-top">
        <div class="pp">
            <h5>BASRENG</h5>
            <h3>CABAI MERAH</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, recusandae quaerat. Voluptatem repellat in minima, ab architecto corrupti qui eum nisi ipsam iusto quod ipsa delectus optio, quibusdam rerum unde.</p>
        </div>
    </div>
    <div class="image">
        <img src="{{ url('images/cabe3.png')}}" alt="" class="img_car">
    </div>
</div>
</div>
      </div>
      <div class="carousel-item">
        <div class="main container-fluid">
    <div class="container d-flex flex-row justify-content-evenly">
    <div class="tex-content  d-flex align-items-top">
        <div class="pp">
            <h5>KRIPIK PISANG</h5>
            <h3>COKLAT</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, recusandae quaerat. Voluptatem repellat in minima, ab architecto corrupti qui eum nisi ipsam iusto quod ipsa delectus optio, quibusdam rerum unde.</p>
        </div>
    </div>
    <div class="image">
        <img src="{{ url('images/coklat.png')}}" alt="" class="img_car">
    </div>
</div>
</div>
      </div>
      <div class="carousel-item">
        <div class="main container-fluid">
    <div class="container d-flex flex-row justify-content-evenly">
    <div class="tex-content  d-flex align-items-top">
        <div class="pp">
            <h5>KRIPIK PISANG</h5>
            <h3>STRAWBERRY</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, recusandae quaerat. Voluptatem repellat in minima, ab architecto corrupti qui eum nisi ipsam iusto quod ipsa delectus optio, quibusdam rerum unde.</p>
        </div>
    </div>
    <div class="image">
        <img src="{{ url('images/strawberry.png')}}" alt="" class="img_car">
    </div>
</div>
</div>
      </div>
      <div class="carousel-item">
        <div class="main container-fluid">
    <div class="container d-flex flex-row justify-content-evenly">
    <div class="tex-content  d-flex align-items-top">
        <div class="pp">
            <h5>KRIPIK PISANG</h5>
            <h3>TIRAMISU</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, recusandae quaerat. Voluptatem repellat in minima, ab architecto corrupti qui eum nisi ipsam iusto quod ipsa delectus optio, quibusdam rerum unde.</p>
        </div>
    </div>
    <div class="image">
        <img src="{{ url('images/tiramisusu.png')}}" alt="" class="img_car">
    </div>
</div>
</div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  
  <div class="container px-5">
    <div class="row">
        <div class="col-md-6">
            <div class="product-landing">
                <div class="content-text p-5">
                    <h5>PRODUCT</h5>
                    <h1>Kripik</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium voluptates repellendus necessitatibus maxime quis ullam, porro omnis ad eveniet nulla illo nostrum nemo delectus facere a officia neque dolores eum.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-image d-flex justify-content-center align-items-center">
                <img src="{{ url('images/product-img.png')}}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="product_list text-center">
                    <div class="content_title">
                        <h2>Product</h2>
                        <p class="mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. At, quasi voluptas ipsum corporis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
<div class="row mt-4">
  @foreach ($products as $product)
      
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

</div>
<div class="col-12 text-center">        
<a href="" class="btn btn-outline-dark rounded-2 px-4 py-2 text-uppercase mt-3" style="width: 30%;">View More</a>
</div>
</div>


<div class="container">
    <div class="testimoni p-5">
        <div class="text">
            <div class="title d-flex justify-content-center"><h1>Testimonials</h1></div>
            <div class="para d-flex justify-content-center">
            <p class="text-center d-flex justify-content-center" style="max-width: 500px">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus nulla dolorem necessitatibus culpa sunt ipsam inventore? Odio voluptates a, commodi asperiores assumenda quisquam dolor totam sint, ullam architecto maxime eum.</p>
        </div>
        </div>
    </div>
</div>

</body>
<style>

.pp{
    max-width: 500px;
    margin-top: 100px;
    align-content: center
}
.main {
background-image: url('{{ url('images/bg2.png') }}');
background-size: cover; /* atau 'contain' */
min-height: 300px; /* misalnya, atur nilai minimum tinggi */
height: 700px; /* misalnya, atur nilai maksimum tinggi */
}
.list{
  text-decoration: none
}
.carousel-inner{
    height: 580px
}
.tiramisu{
    margin-left: 200px;
    margin-top: 80px
}
.product_card{
    margin-top: 100px;
}
.product-landing{
    background-color: #DBD3CD;
    border-radius: 5px;
    height: 500px;
}
.content-text{
    max-width: 500px;
    /* display: flex; */
    /* align-items: center; */
    
}


.image{
    align-items: center;   
}
.img_car{
    display: flex;
    max-height: 513px; max-width: auto; height:auto; width:auto;
    align-content: center;
}
.img__02{
cursor: pointer;
}

.img__product {
box-shadow: 0px 4px 25px rgba(14, 36, 49, 0.15);
overflow: hidden;
cursor: pointer;
}

.img__product img {
transition: 0.6s;
}

.img__product img:hover {
transform: scale(1.1);
}

.card-title{
font-size: 15px;
}
.card-text{
font-size: 13px;
}
</style>
@endsection

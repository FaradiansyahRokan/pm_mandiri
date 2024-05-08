@extends('layouts.app')

@section('content')
<div class="luar">
  <div class="main product d-flex align-items-center justify-content-evenly">
      <div class="product-image">
          <img src="{{ asset($products->image_product) }}" alt="" width="500">
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
                              <a href="#" class="btn btn-lg btn-block text-light fw-bold" style="background-color: #515151;">Buy Now</a>
                          </div>
                      </div>
                      <div class="col-md-6 my-2">
                          <div class="card">
                              <a class="btn btn-lg btn-block text-dark fw-bold shadow p-2 bg-body-tertiary rounded" style="background-color: #DBD3CD;" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">+ Add to cart</a>
                          </div>
                      </div>
                      <div class="col-md-6 my-2">
                          <div class="card">
                              <a href="#" class="btn btn-lg btn-block text-light fw-bold" style="background-color: #515151;">Buy Now</a>
                          </div>
                      </div>
                      <div class="col-md-6 my-2">
                          <div class="card">
                              <a href="#" class="btn btn-lg btn-block text-light fw-bold" style="background-color: #515151;">Buy Now</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </aside>
  </div>
</div>


        <div class="offcanvas offcanvas-end"  style="width: 30%"  tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasExampleLabel">Cart</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div class="container">
                <div class="content d-flex justify-content-evenly">
                    <div class="image-cart">
                        <img src="{{ url('images/Content-product 1.png')}}" alt="" width="200px">
                    </div>
                    <div class="desc-cart align-self-center" >
                        <div class="text">
                            <h3>Product</h3>
                            <h5>Name of product here</h5>
                            <h5>25gr</h5>
                            <h5>Price : $90</h5>
                            <div class="wrapper">
                                <span class="minus">-</span>
                                <span class="num">01</span>
                                <span class="plus">+</span>
                              </div>
                              <script>
                               const plus = document.querySelector(".plus"),
                                minus = document.querySelector(".minus"),
                                num = document.querySelector(".num");
                                let a = 1;
                                plus.addEventListener("click", ()=>{
                                  a++;
                                  a = (a < 10) ? "0" + a : a;
                                  num.innerText = a;
                                });
                                minus.addEventListener("click", ()=>{
                                  if(a > 1){
                                    a--;
                                    a = (a < 10) ? "0" + a : a;
                                    num.innerText = a;
                                  }
                                });
                              </script>
                        </div>
                    </div>
                </div>
                <hr>



                <div class="content d-flex justify-content-evenly">
                    <div class="image-cart">
                        <img src="{{ url('images/Content-product 1.png')}}" alt="" width="200px">
                    </div>
                    <div class="desc-cart align-self-center" >
                        <div class="text">
                            <h3>Product</h3>
                            <h5>Name of product here</h5>
                            <h5>25gr</h5>
                            <h5>Price : $90</h5>
                            <div class="wrapper">
                                <span class="minus">-</span>
                                <span class="num">01</span>
                                <span class="plus">+</span>
                              </div>
                              <script>
                               const plus = document.querySelector(".plus"),
                                minus = document.querySelector(".minus"),
                                num = document.querySelector(".num");
                                let a = 1;
                                plus.addEventListener("click", ()=>{
                                  a++;
                                  a = (a < 10) ? "0" + a : a;
                                  num.innerText = a;
                                });
                                minus.addEventListener("click", ()=>{
                                  if(a > 1){
                                    a--;
                                    a = (a < 10) ? "0" + a : a;
                                    num.innerText = a;
                                  }
                                });
                              </script>
                        </div>
                    </div>
                </div>
                <hr>




                <div class="content d-flex justify-content-evenly">
                    <div class="image-cart">
                        <img src="{{ url('images/Content-product 1.png')}}" alt="" width="200px">
                    </div>
                    <div class="desc-cart align-self-center" >
                        <div class="text">
                            <h3>Product</h3>
                            <h5>Name of product here</h5>
                            <h5>25gr</h5>
                            <h5>Price : $90</h5>
                            <div class="wrapper">
                                <span class="minus">-</span>
                                <span class="num">01</span>
                                <span class="plus">+</span>
                              </div>
                              <script>
                               const plus = document.querySelector(".plus"),
                                minus = document.querySelector(".minus"),
                                num = document.querySelector(".num");
                                let a = 1;
                                plus.addEventListener("click", ()=>{
                                  a++;
                                  a = (a < 10) ? "0" + a : a;
                                  num.innerText = a;
                                });
                                minus.addEventListener("click", ()=>{
                                  if(a > 1){
                                    a--;
                                    a = (a < 10) ? "0" + a : a;
                                    num.innerText = a;
                                  }
                                });
                              </script>
                        </div>
                    </div>
                </div>
                <hr>



                <div class="content d-flex justify-content-evenly">
                    <div class="image-cart">
                        <img src="{{ url('images/Content-product 1.png')}}" alt="" width="200px">
                    </div>
                    <div class="desc-cart align-self-center" >
                        <div class="text">
                            <h3>Product</h3>
                            <h5>Name of product here</h5>
                            <h5>25gr</h5>
                            <h5>Price : $90</h5>
                            <div class="wrapper">
                                <span class="minus">-</span>
                                <span class="num">01</span>
                                <span class="plus">+</span>
                              </div>
                              <script>
                               const plus = document.querySelector(".plus"),
                                minus = document.querySelector(".minus"),
                                num = document.querySelector(".num");
                                let a = 1;
                                plus.addEventListener("click", ()=>{
                                  a++;
                                  a = (a < 10) ? "0" + a : a;
                                  num.innerText = a;
                                });
                                minus.addEventListener("click", ()=>{
                                  if(a > 1){
                                    a--;
                                    a = (a < 10) ? "0" + a : a;
                                    num.innerText = a;
                                  }
                                });
                              </script>
                        </div>
                    </div>
                </div>
                <hr>
              </div>
             
              <button class="btn btn-primary" style="width: 100%;">BELI SEKARANG</button>
            </div>
          </div>

          <div class="container">
<div class="row mt-4">
  
<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $products->id)}}" class="list">
  <div class="card text-center" style="background-color: #DBD3CD">
    <div class="img__product">
    <img src="{{ url('images/content 5.png')}}" class="card-img-top" data-bs-toggle="offcanvas" data-bs-target="#xlmk" aria-controls="offcanvasBottom"  alt="...">
  </div>
    <div class="card-body">
      <h6 class="card-title">XLMK Tour LS</h6>
      <p class="card-text mt-2">Rp. 199.000</p>

    </div>
  </div>
</a>
</div>

<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $products->id)}}" class="list">
  <div class="card text-center" style="background-color: #DBD3CD">
    <div class="img__product">
    <img src="{{ url('images/content 5.png')}}" class="card-img-top" data-bs-toggle="offcanvas" data-bs-target="#xlmk" aria-controls="offcanvasBottom"  alt="...">
  </div>
    <div class="card-body">
      <h6 class="card-title">XLMK Tour LS</h6>
      <p class="card-text mt-2">Rp. 199.000</p>

    </div>
  </div>
</a>
</div>

<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $products->id)}}" class="list">
  <div class="card text-center" style="background-color: #DBD3CD">
    <div class="img__product">
    <img src="{{ url('images/content 5.png')}}" class="card-img-top" data-bs-toggle="offcanvas" data-bs-target="#xlmk" aria-controls="offcanvasBottom"  alt="...">
  </div>
    <div class="card-body">
      <h6 class="card-title">XLMK Tour LS</h6>
      <p class="card-text mt-2">Rp. 199.000</p>

    </div>
  </div>
</a>
</div>

<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $products->id)}}" class="list"> 
  <div class="card text-center" style="background-color: #DBD3CD">
    <div class="img__product">
    <img src="{{ url('images/content 5.png')}}" class="card-img-top" data-bs-toggle="offcanvas" data-bs-target="#xlmk" aria-controls="offcanvasBottom"  alt="...">
  </div>
    <div class="card-body">
      <h6 class="card-title">XLMK Tour LS</h6>
      <p class="card-text mt-2">Rp. 199.000</p>

    </div>
  </div>
</a>
</div>

<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $products->id)}}" class="list">
  <div class="card text-center" style="background-color: #DBD3CD">
    <div class="img__product">
    <img src="{{ url('images/content 5.png')}}" class="card-img-top" data-bs-toggle="offcanvas" data-bs-target="#xlmk" aria-controls="offcanvasBottom"  alt="...">
  </div>
    <div class="card-body">
      <h6 class="card-title">XLMK Tour LS</h6>
      <p class="card-text mt-2">Rp. 199.000</p>

    </div>
  </div>
</a>
</div>

<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $products->id)}}" class="list">
  <div class="card text-center" style="background-color: #DBD3CD">
    <div class="img__product">
    <img src="{{ url('images/content 5.png')}}" class="card-img-top" data-bs-toggle="offcanvas" data-bs-target="#xlmk" aria-controls="offcanvasBottom"  alt="...">
  </div>
    <div class="card-body">
      <h6 class="card-title">XLMK Tour LS</h6>
      <p class="card-text mt-2">Rp. 199.000</p>

    </div>
  </div>
</a>
</div>

<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $products->id)}}" class="list">
  <div class="card text-center" style="background-color: #DBD3CD">
    <div class="img__product">
    <img src="{{ url('images/content 5.png')}}" class="card-img-top" data-bs-toggle="offcanvas" data-bs-target="#xlmk" aria-controls="offcanvasBottom"  alt="...">
  </div>
    <div class="card-body">
      <h6 class="card-title">XLMK Tour LS</h6>
      <p class="card-text mt-2">Rp. 199.000</p>

    </div>
  </div>
</a>
</div>

<div class="col-lg-3 col-md-3 col-sm-4 col-6 mt-3">
  <a href="{{ route('detail', $products->id)}}" class="list">
  <div class="card text-center" style="background-color: #DBD3CD">
    <div class="img__product">
    <img src="{{ $products->image_product}}" class="card-img-top" data-bs-toggle="offcanvas" data-bs-target="#xlmk" aria-controls="offcanvasBottom"  alt="...">
  </div>
    <div class="card-body">
      <h6 class="card-title">XLMK Tour LS</h6>
      <p class="card-text mt-2">Rp. 199.000</p>

    </div>
  </div>
</a>
</div>

</div>
<div class="col-12 text-center">        
<a href="" class="btn btn-outline-dark rounded-2 px-4 py-2 text-uppercase mt-3" style="width: 30%;">View More</a>
</div>
</div>
    </div>


    <style>
        .main {
background-image: url('{{ url('images/bg2.png') }}');
background-size: cover; /* atau 'contain' */
min-height: 100vh; 
max-width: 100%; 
}
.wrapper{
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
.wrapper span{
  width: 100%;
  text-align: center;
  font-size: 25px;
  font-weight: 600;
  cursor: pointer;
  user-select: none;
}
.wrapper span.num{
  font-size: 20px;
  border-right: 2px solid rgba(0,0,0,0.2);
  border-left: 2px solid rgba(0,0,0,0.2);
  pointer-events: none;
}
.list{
  text-decoration: none
}
    </style>
@endsection



{{-- 
<div class="wrapper">
    <span class="minus">-</span>
    <span class="num">01</span>
    <span class="plus">+</span>
  </div>
  <script>
   const plus = document.querySelector(".plus"),
    minus = document.querySelector(".minus"),
    num = document.querySelector(".num");
    let a = 1;
    plus.addEventListener("click", ()=>{
      a++;
      a = (a < 10) ? "0" + a : a;
      num.innerText = a;
    });
    minus.addEventListener("click", ()=>{
      if(a > 1){
        a--;
        a = (a < 10) ? "0" + a : a;
        num.innerText = a;
      }
    });
  </script> --}}
@extends('layouts.app')

@section('title', 'About')

@section('content')

<!-- Why us-->
@if($user)
<div id="why-us" class="mt-3 mb-3">
 <div class="container">
  <div class="row">

    <!-- Title -->
    <div class="col-12 col-lg-6">
      <h2 class="mb-5 display-4 fw-bold">Why Us?</h2>

      <!-- 1st row -->
      <div class="row mb-3">
        <div class="col-2 text-center">
          <i class="bi bi-check2-square fs-1 text-primary"></i>
        </div>
        <div class="col-10">
        <h5>Help you choose the right build</h5>
        <p>
          That is suitable for you
        </p>
      </div>
    </div>

    <!-- 2nd row -->
    <div class="row mb-3">
      <div class="col-2 text-center">
        <i class="bi bi-check2-square fs-1 text-primary"></i>
      </div>
      <div class="col-10">
        <h5>Help you build your pc</h5>
        <p>
          The parts that you wanted
        </p>
      </div>
    </div>

    <!-- 3rd row -->
    <div class="row mb-3">
      <div class="col-2 text-center">
        <i class="bi bi-check2-square fs-1 text-primary"></i>
      </div>
      <div class="col-10">
        <h5>Help you safe money</h5>
        <p>
          Only in my store
        </p>
      </div>
    </div>
  </div>

  <!-- Image row -->
  <div class="col-12 col-lg-6">
    <div class="p-2 mt-5">
      <img src="/images/maxresdefault.jpg" class="img-fluid" />
    </div>
  </div>

  </div>
 </div>
</div>

<!-- Our services -->     
<div id="services" class="mb-3">
 <h2 class="text-center display-4 fw-bold mb-5">Our Services</h2>
 <div class="container">
  <div class="row">

  <!-- 1st row -->
    <div class="col-lg-6">
      <div class="row mb-3">
        <div class="col-2 text-center">
          <i class="bi bi-shop fs-1 text-primary"></i>
        </div>
        <div class="col-10">
          <h5>Store</h5>
          <p>
            Oder your product at our local store 
          </p>
        </div>
      </div>
    </div>

    <!-- 2nd row -->
    <div class="col-lg-6">
      <div class="row mb-3">
        <div class="col-2 text-center">
          <i class="bi bi-phone fs-1 text-primary"></i>
        </div>
        <div class="col-10">
          <h5>Online Store</h5>
          <p>
            Order Your product online
          </p>
        </div>
      </div>
    </div>

    <!-- 3rd row -->
    <div class="col-lg-6">
      <div class="row mb-3">
        <div class="col-2 text-center">
          <i class="bi bi-credit-card fs-1 text-primary"></i>
        </div>
        <div class="col-10">
          <h5>Online Payment</h5>
          <p>
            Pay your product with online payment
          </p>
        </div>
      </div>
    </div>

    <!-- 4th row -->
    <div class="col-lg-6">
      <div class="row mb-3">
        <div class="col-2 text-center">
          <i class="bi bi-truck fs-1 text-primary"></i>
        </div>
        <div class="col-10">
          <h5> Delivery</h5>
          <p>
            Your online product and product from local store will be dlivered
          </p>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>                             

<!-- Product brand -->
<div id="clients" class="bg-dark">
  <div class="container">
    <div class="row">

      <!-- Left column (Title) -->
      <div class="col-md-6 d-flex justify-content-start align-items-center">
        <h2 class="text-white fw-bold mb-3 display-4 pt-4">
          Trusted by brands all over the world
        </h2>
        
      </div>

    <!-- Image box for 6 -->
      <div class="col-md-6">
        <div class="row">
          <div class="col-6 col-lg-4 mt-3">
            <div class="logo">
              <a class="brand-logo" href="https://www.asus.com/my/" target="_blank">
                <img src="/logo/226422.webp" class="img-fluid" >
              </a>
            </div>
          </div>
          <div class="col-6 col-lg-4 mt-3">
            <div class="logo">
              <a class="brand-logo" href="https://store.playstation.com/" target="_blank">
              <img src="/logo/playstation-ps5-ps4-logo-free-free-vector.jpg" class="img-fluid" />
              </a>
            </div>
          </div>
          <div class="col-6 col-lg-4 mt-3">
            <div class="logo">
              <a class="brand-logo" href="https://razerstore.my/" target="_blank"> 
              <img src="/logo/Razer-Logo-Vector-scaled.jpg" class="img-fluid" />
              </a>
            </div>
          </div>
          <div class="col-6 col-lg-4 mt-3 mb-3">
            <div class="logo">
              <a class="brand-logo" href="https://www.keychron.com" target="_blank"> 
              <img src="/logo/keychron-blacktext2_large.webp" class="img-fluid" />
              </a>
            </div>
          </div>
          <div class="col-6 col-lg-4 mt-3">
            <div class="logo">
              <a class="brand-logo" href="https://www.lg.com/my/gaming-monitors" target="_blank">
              <img src="/logo/LG-Logo-Vector-scaled-1.jpg" class="img-fluid" />
              </a>
            </div>
          </div>
          <div class="col-6 col-lg-4 mt-3">
            <div class="logo">
              <a class="brand-logo" href="https://www.logitechg.com/" target="_blank">
              <img src="/logo/untitled-1_66.png" class="img-fluid" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@else

<!-- Lead to 404 page -->
<?php
  abort(404);
?>
@endif

@endsection
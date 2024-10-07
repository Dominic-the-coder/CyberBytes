<!--header-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | CyberBytes</title>

<!-- Bootstrap CSS -->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

<!-- Bootstrap Icons -->    
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

<!--CSS-->
 <link
      rel="stylesheet"
      href="{{ asset('css/style.css') }}" 
    />    

</head>
<body>

<!--Header-->

  <nav class="navbar navbar-expand-lg bg-black">
   <div class="container">

<!--Logo-->    

    <a class="navbar-brand" href="/"
        ><img src="/logo/Screenshot 2024-09-12 010434.png" width="150px"
    /></a>

    <button class="navbar-toggler" type="button" 
    data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

<!-- navbar -->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="/"
            >Home</a
            >
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="/products">Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="/about">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="/contact">Contact Us</a>
        </li>
        </ul>

        <a type="button" class="btn btn-dark me-3" href="/cart"><i class="bi bi-bag-fill"></i></i></a>
        @auth
            <a type="button" class="btn btn-primary" href='/logout'>Logout</a>
        @else
            <a type="button" class="btn btn-primary me-1" href='/login'>Login</a>
            <a type="button" class="btn btn-primary" href='/signup'>Sign Up</a>
        @endauth
    </div>
</nav>

@yield('content')

<!--footer-->

<div id="footer" class="d-flex justify-content-center pt-5 bg-black">
      <div class="container">
        <div class="row feet">
          <div class="col-lg-6">
            <p class="fs-5 text-white">© 2024 CyberBytes.com (For Educational Purposes Only)</p>
          </div>
          <div class="col-lg-6 d-flex justify-content-end">
            <p class="fs-3 text-white">
              <i class="bi bi-facebook"></i>
              <i class="bi bi-twitter"></i>
              <i class="bi bi-instagram"></i>
            </p>
          </div>
        </div>
      </div>
    </div> 

<!--Java Script-->    
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"
></script>
</body>
</html>
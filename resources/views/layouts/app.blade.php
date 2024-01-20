<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <script src="{{ asset('js/app.js') }}"></script>

</head>

<body>
<div id="app">
        <!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

<div class="container">
    <a class="navbar-brand" href="home">ZETAX<span>.</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
            <li class="nav-item active">
                <a class="nav-link" href="/home">Home</a>
            </li>
            <li><a class="nav-link" href="/shop">Shop</a></li>
            <li><a class="nav-link" href="about.html">About us</a></li>
            <li><a class="nav-link" href="services.html">Services</a></li>
            <li><a class="nav-link" href="blog.html">Blog</a></li>
            <li><a class="nav-link" href="contact.html">Contact us</a></li>
        </ul>

       
        <div class="dropdown  mb-2 mb-md-0 ms-5">
  <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
  </a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="{{ url('profile') }}">Profile</a></li>
    <li><a class="dropdown-item" href="{{ url('history') }}">Riwayat Pemesanan</a></li>
    <li><a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </li>
  </ul>

</div>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
            <li><a class="nav-link" href="/profile"><i class="fa fa-user"></i></a></li>
            <!-- <li><a class="nav-link" href="cart.html"><img src="images/cart.svg"></a></li> -->
            <li class="nav-item">
                    <?php
                     $pesanan_utama = \App\Models\Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
                     if(!empty($pesanan_utama))
                        {
                         $notif = \App\Models\PesananDetail::where('pesanan_id', $pesanan_utama->id)->count(); 
                        }
                    ?>
                    <a class="position-relative nav-link" href="{{ url('check-out') }}">
                    <!-- <img src="images/cart.svg"> -->
                    <i class="fa fa-shopping-cart"></i>
                        @if(!empty($notif))
                        <span class="position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger">{{ $notif }}</span>
                        @endif
                    </a>
                </li>
        </ul>
    </div>
</div>
    
</nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
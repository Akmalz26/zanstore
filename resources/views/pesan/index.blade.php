@extends('layouts.app')

@section('content')
   <!-- Navigation-->
   <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav> -->
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('image/' . $produk->image) }}" alt="..." /></div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">{{ $produk->nama }}</h1>
                        <div class="fs-5 mb-5">
                            <!-- <span class="text-decoration-line-through">Rp. {{ number_format ($produk->harga) }}</span> -->
                            <span>Rp. {{ number_format ($produk->harga) }}</span>
                            <p class="lead fw">Stok : {{$produk->stok}}</p>
                        </div>
                        <div class="small mb-3 "><strong>Pemilik : </strong>{{ $produk->kasir->nama }}</div>
                        <p class="lead fw-bolder">Deskripsi :</p>
                        <p>{{$produk->deskripsi}}</p>
                        
                    <form method="post" action="{{ url('pesan') }}/{{ $produk->id }}" >
                    @csrf
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="jumlah_pesan" name="jumlah_pesan" type="num" value="1" style="max-width: 3rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="sumbit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; ZETAX</p></div>
        </footer>
        <!-- Bootstrap core JS-->
@endsection
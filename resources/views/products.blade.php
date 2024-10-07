@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container mt-5">
    <hr>
</div>

<!-- Popular Products Section -->
<div class="container">
    <h2>
        {{$user->role_id}}
    </h2>
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Popular Right Now</h2>
</div>
<div class="container text-center">
    <div class="row mt-5 mb-5">
    @foreach($popularProducts as $product)
            <div class="col-12 col-md-6 col-lg-4 pt-2">
                <div class="card rounded shadow-lg">
                    <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="card-img-top"/>
                    <div class="card-box">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p>From RM {{ number_format($product->price, 2) }}</p>

                        <!-- Modal Trigger Button -->
                        @if($user->role_id == 1)
                        <div class="d-flex justify-content-center gap-3 align-items-center w-100 ">
                        <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2 mb-3">Remove</button>
                                </form>
                                <button type="button" class="btn btn-success mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $product->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editmodal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('product.edit', $product->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body d-flex flex-column">
                                                    <label>Change your quantity</label>
                                                    <div>
                                                        <label class="mt-3">Change your name:</label>
                                                        <input type="text" name="name" class="px-3 py-2" placeholder="name" value="{{ $product->name }}" required />
                                                        <label class="mt-3">Change your price:</label>
                                                        <input type="number" name="price" class="px-3 py-2" placeholder="price" value="{{ $product->price }}" min="1" required />
                                                    </div>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                @else

                                <button type="button" class="btn btn-primary mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                                    Add to cart
                                </button>
                            @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container mt-5">
    <hr>
</div>

<!-- Latest Products Section -->
<div class="container mt-5">
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Checkout The Latest</h2>
</div>
<div class="container text-center">
    <div class="row mt-5 mb-5">
        @foreach($latestProducts as $product)
        <div class="col-12 col-md-6 col-lg-4 pt-2">
                <div class="card rounded shadow-lg">
                    <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="card-img-top"/>
                    <div class="card-box">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p>From RM {{ number_format($product->price, 2) }}</p>

                        <!-- Modal Trigger Button -->
                        @if($user->role_id == 1)
                        <div class="d-flex justify-content-center gap-3 align-items-center w-100 ">
                        <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2 mb-3">Remove</button>
                                </form>
                                <button type="button" class="btn btn-success mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $product->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editmodal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('product.edit', $product->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body d-flex flex-column">
                                                    <label>Change your quantity</label>
                                                    <div>
                                                        <label class="mt-3">Change your name:</label>
                                                        <input type="text" name="name" class="px-3 py-2" placeholder="name" value="{{ $product->name }}" required />
                                                        <label class="mt-3">Change your price:</label>
                                                        <input type="number" name="price" class="px-3 py-2" placeholder="price" value="{{ $product->price }}" min="1" required />
                                                    </div>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                @else

                                <button type="button" class="btn btn-primary mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                                    Add to cart
                                </button>
                            @endif

                    </div>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container mt-5">
    <hr>
</div>
@endsection

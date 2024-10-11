@extends('layouts.app')

@section('title', 'Products')

@section('content')

<!-- Button to trigger the Add Product modal -->
@if($user)
@if(session('lol'))
    <div id="successAlert" class="alert alert-success m-3" role="alert">
        {{ session('lol') }}
    </div>
@endif

<script>
    // Check if the success alert is present
    window.onload = function() {
        const alert = document.getElementById('successAlert');
        if (alert) {
            // Set a timeout to hide the alert after 5 seconds
            setTimeout(function() {
                alert.style.display = 'none'; // Hide the alert
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    }
</script>

@if($user->role_id == 1)
<div class="container d-flex justify-content-end">
    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
        Add Product
    </button>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductLabel">Add New Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Add Product Form -->
            <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
                <!-- Laravel CSRF token for security -->
                @csrf 
                <div class="modal-body">
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name:</label>
                        <input type="text" id="productName" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>
                    
                    <!-- Product Image -->
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image:</label>
                        <input type="file" id="productImage" name="image" class="form-control" required>
                    </div>
                    
                    <!-- Product Price -->
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price:</label>
                        <input type="number" id="productPrice" name="price" class="form-control" placeholder="Enter product price" min="1" required>
                    </div>
                    
                    <!-- Product Type -->
                    <div class="mb-3">
                        <label for="productType" class="form-label">Product Type:</label>
                        <select id="productType" name="type" class="form-select" required>
                            <option selected disabled>Select a type</option>
                            <option value="popular">Popular</option>
                            <option value="latest">Latest</option>
                            <option value="sale">Sale</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endif

<!-- Modal for Adding Product -->

<div class="container mt-1">
    <hr>
</div>

<!-- Popular Products Section -->
<div class="container">
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Popular Right Now</h2>
</div>
<div class="container text-center">
 <div class="row mt-5 mb-5">
    @foreach($popularProducts as $product)
    <div class="col-12 col-md-6 col-lg-4 pt-2">
 <div class="card rounded shadow-lg">
    <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="card-img-top" />
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">From RM {{ number_format($product->price, 2) }}</p>

        <!-- Modal Trigger Buttons -->
        <div class="d-flex justify-content-center gap-1">
            @if($user->role_id == 1 || auth()->user()->role_id === 2 )
                <!-- Admin Actions -->
                <form action="{{ route('product.delete', $product->id) }}" method="POST">
                    <!-- Laravel CSRF token for security -->
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $product->id }}">
                    Edit
                </button>
            @else
                <!-- User Actions -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                    Add to Cart
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-review-{{ $product->id }}">
                    Review
                </button>
            @endif
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editmodal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
                <!-- Laravel CSRF token for security -->
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label class="form-label">Product Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required value="{{ $product->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Image:</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price:</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter product price" min="1" required value="{{ $product->price }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Type:</label>
                        <select name="type" class="form-select" required>
                            <option value="" disabled>Select a type</option>
                            <option value="popular" {{ $product->type === 'popular' ? 'selected' : '' }}>Popular</option>
                            <option value="latest" {{ $product->type === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="sale" {{ $product->type === 'sale' ? 'selected' : '' }}>Sale</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add to Cart Modal -->
<div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                <!-- Laravel CSRF token for security -->
                @csrf
                <div class="modal-body">
                    <p>Do you want to add this item to your cart?</p>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" name="quantity" class="form-control" min="1" value="1" max="10">
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="modal-review-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('review.add') }}" method="POST">
                <!-- Laravel CSRF token for security -->
                @csrf
                <div class="modal-body">
                    <p>What's your review?</p>
                    <textarea name="content" class="form-control" rows="4" required></textarea>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>

            <!-- Modal Trigger Buttons -->
            <div class="modal-footer">
                @if($product->reviews->isNotEmpty())
                    @foreach ($product->reviews as $review)
                        <div class="review container border p-2 my-2 rounded shadow-sm">
                            <strong>{{ $review->user->name }}</strong>
                            <p>{{ $review->content }}</p>
                            
                            @if($review->user->id === $user->id)
                                <form action="{{ route('review.delete', $review->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-center bg-warning w-100 p-2 rounded">No reviews for this product. Would you like to add one?</p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
     @endforeach
    </div>
  </div>
</div>

<div class="container mt-5">
    <hr>
</div>

<!-- Latest Products Section -->
<div class="container mt-5">
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Checkout The Latest Release</h2>
</div>
<div class="container text-center">
 <div class="row mt-5 mb-5">
    @foreach($latestProducts as $product)
    <div class="col-12 col-md-6 col-lg-4 pt-2">
 <div class="card rounded shadow-lg">
    <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="card-img-top" />
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">From RM {{ number_format($product->price, 2) }}</p>

        <!-- Modal Trigger Buttons -->
        <div class="d-flex justify-content-center gap-1">
            @if($user->role_id == 1 || auth()->user()->role_id === 2 )
                <!-- Admin Actions -->
                <form action="{{ route('product.delete', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $product->id }}">
                    Edit
                </button>
             @else
                <!-- User Actions -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                    Add to Cart
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-review-{{ $product->id }}">
                    Review
                </button>
            @endif
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editmodal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
                <!-- Laravel CSRF token for security -->
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label class="form-label">Product Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required value="{{ $product->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Image:</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price:</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter product price" min="1" required value="{{ $product->price }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Type:</label>
                        <select name="type" class="form-select" required>
                            <option value="" disabled>Select a type</option>
                            <option value="popular" {{ $product->type === 'popular' ? 'selected' : '' }}>Popular</option>
                            <option value="latest" {{ $product->type === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="sale" {{ $product->type === 'sale' ? 'selected' : '' }}>Sale</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add to Cart Modal -->
<div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                <!-- Laravel CSRF token for security -->
                @csrf
                <div class="modal-body">
                    <p>Do you want to add this item to your cart?</p>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" name="quantity" class="form-control" min="1" value="1" max="10">
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="modal-review-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('review.add') }}" method="POST">
                <!-- Laravel CSRF token for security -->
                @csrf
                <div class="modal-body">
                    <p>What's your review?</p>
                    <textarea name="content" class="form-control" rows="4" required></textarea>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>

            <!-- Modal Trigger Buttons -->
            <div class="modal-footer">
             @if($product->reviews->isNotEmpty())
                @foreach ($product->reviews as $review)
                  <div class="review container border p-2 my-2 rounded shadow-sm">
                    <strong>{{ $review->user->name }}</strong>
                    <p>{{ $review->content }}</p>
                    
                    @if($review->user->id === $user->id)
                      <form action="{{ route('review.delete', $review->id) }}" method="POST" class="d-inline">
                         @csrf
                         @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                      </form>
                    @endif
                  </div>
                @endforeach
                @else
                    <p class="text-center bg-warning w-100 p-2 rounded">No reviews for this product. Would you like to add one?</p>
                @endif
               </div>
             </div>
           </div>
         </div>
       </div>
      @endforeach
    </div>
  </div>
</div>


<div class="container mt-5">
    <hr>
</div>

<!-- Sales Products Section -->
<div class="container mt-5">
    <h2 class="mt-5 fw-bold d-flex justify-content-center">Checkout The Sales</h2>
</div>
<div class="container text-center">
 <div class="row mt-5 mb-5">
    @foreach($saleProducts as $product)
    <div class="col-12 col-md-6 col-lg-4 pt-2">
 <div class="card rounded shadow-lg">
    <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="card-img-top" />
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">From RM {{ number_format($product->price, 2) }}</p>

        <!-- Modal Trigger Buttons -->
        <div class="d-flex justify-content-center gap-1">
            @if($user->role_id == 1)
                <!-- Admin Actions -->
                <form action="{{ route('product.delete', $product->id) }}" method="POST">
                    <!-- Laravel CSRF token for security -->
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $product->id }}">
                    Edit
                </button>
            @else
                <!-- User Actions -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                    Add to Cart
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-review-{{ $product->id }}">
                    Review
                </button>
            @endif
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editmodal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
                <!-- Laravel CSRF token for security -->
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label class="form-label">Product Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required value="{{ $product->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Image:</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price:</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter product price" min="1" required value="{{ $product->price }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Type:</label>
                        <select name="type" class="form-select" required>
                            <option value="" disabled>Select a type</option>
                            <option value="popular" {{ $product->type === 'popular' ? 'selected' : '' }}>Popular</option>
                            <option value="latest" {{ $product->type === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="sale" {{ $product->type === 'sale' ? 'selected' : '' }}>Sale</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add to Cart Modal -->
<div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                <!-- Laravel CSRF token for security -->
                @csrf
                <div class="modal-body">
                    <p>Do you want to add this item to your cart?</p>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" name="quantity" class="form-control" min="1" value="1" max="10">
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="modal-review-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('review.add') }}" method="POST">
                <!-- Laravel CSRF token for security -->
                @csrf
                <div class="modal-body">
                    <p>What's your review?</p>
                    <textarea name="content" class="form-control" rows="4" required></textarea>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>

            <!-- Modal Trigger Buttons -->
            <div class="modal-footer">
                @if($product->reviews->isNotEmpty())
                    @foreach ($product->reviews as $review)
                        <div class="review container border p-2 my-2 rounded shadow-sm">
                            <strong>{{ $review->user->name }}</strong>
                            <p>{{ $review->content }}</p>
                            
                            @if($review->user->id === $user->id)
                                <form action="{{ route('review.delete', $review->id) }}" method="POST" class="d-inline">
                                    <!-- Laravel CSRF token for security -->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-center bg-warning w-100 p-2 rounded">No reviews for this product. Would you like to add one?</p>
                @endif
               </div>
             </div>
           </div>
         </div>
       </div>
      @endforeach
    </div>
  </div>
</div>

<div class="container mt-5">
    <hr>
</div>

@else

<!-- Lead to 404 page -->
<?php
  abort(404);
?>
@endif

@endsection

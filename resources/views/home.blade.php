@extends('layouts.app')

@section('title', 'Home')

@section('content')

<link
      rel="stylesheet"
      href="{{ asset('css/style.css') }}"
    />

<!--content-->
<div class="container-hero">
 <div class="overlay">
  <div class="content">
          <div class="container">
            <div class="row">
              <div class="text-content text-center">
                <h1 class="text-light p-3">
                  Game For Better Experience
                </h1>
                <a class="btn btn-primary" href="/products">Shop Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection  
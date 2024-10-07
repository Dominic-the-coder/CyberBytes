@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<div class="container mt-5">
        <div class="card rounded shadow-lg">
           <div class="card-body">
             <h3 class="card-title">Fill in your Name:</h3>
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                </div>
              </div>
           </div>
        </div>   
    </div>
   <div class="container mb-3 mt-3">
     <div class="card rounded shadow-lg">
        <div class="card-body">
         <h3 class="card-title">Fill in your Email:</h3>
             <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                </div>
                <div class="d-grid">
                 <button type="submit" class="btn btn-primary btn-fu">
                   Submit
                 </button>
                </div>
              </form>
        </div>
     </div>
   </div>
   <div class="container mb-5">
     <div class="card rounded shadow-lg">
        <div class="card-body">
         <h3 class="card-title">Fill in your Feedback:</h3>
            <form>
             <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Feedback</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
             </div>
             <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-fu">
                Submit
              </button>
             </div>
            </form>
        </div>
     </div>
   </div>

@endsection
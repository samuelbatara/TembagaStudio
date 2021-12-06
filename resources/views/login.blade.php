@extends('layouts.app')

@section('content')

{{-- Homepage Layanan Sewa --}}

<div class="bg" style="background-image: url('/img/Drum.png'); background-size: cover; height:100%; align-self: center;">
    <div class="container position-absolute top-50 start-50 translate-middle">
    <div class="container" style="padding-top: 2.5%">
        <div class="row d-flex">
          <div class="col-lg-5 text order-1 order-lg-1" style="align-content: flex-start;">
            <style>
                .form-control{
                    border: none;
                    border-radius: 0;
                    border-bottom: 1px solid #C4C4C4;
                    background: none;
                    margin: 20px 0;
                    color: #C4C4C4;
                }

                .form-control:focus{
                    background: none;
                    color: #C4C4C4;
                    box-shadow: none;
                }

                .form-group{
                    margin: 5px 0;
                }

                label{
                    color: #F0F0F0;
                    font-size: 22px;
                }

                .btn{
                    background-color: #C5AC58; 
                    color: #F0F0F0; 
                    padding: 10 60px
                }

                .btn:hover{
                    background-color: #F0F0F0;
                    color: #C5AC58;
                }
            </style>
            <h4 style="color: #C5AC58; font-size: 38px"> <b>Login Admin</b></h4>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group" style="margin-top: 30px">
                  <label for="inputUsername"><b>Email</b></label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Admin">
                </div>
                <div class="form-group">
                  <label for="inputPassword"><b>Password</b></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <br><br>
                <button type="submit" class="btn" style="font-weight: bold; font-size: 18">Masuk</button>
              </form>
          </div>
        </div>
    </div>
    </div>
  </div>

  @endsection
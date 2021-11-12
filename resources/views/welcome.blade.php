@extends('layouts.app')

@section('content')
<!-- Home -->
<!-- Prosedur Pinjam -->
<div class="bg" style="background-image: url('/img/Drum.png'); background-size: cover; height:100%; align-self: center;">
<div class="container position-absolute top-50 start-50 translate-middle">
  <div class="row d-flex justify-content-center">
    <div class="col-lg-10 text order-2 order-lg-1 text-center">
      <h1 class = "fw-bold" style="font-family: 'Roboto'; font-size: 78px; color: #C5AC58">Tembaga Studio</h1>
      <h5 style="font-weight: bold; font-size: 40px; color: #FFFFFF">Music, Rental Sound System, & Recording</h5>
      <p class="text-center" style="color: #878787">Jl. TMN Candi Tembaga No.943, Kalipancur, Kec. Ngaliyan, Kota Semarang, Jawa Tengah 50183</p>
      <a class="btn btn-lg" style="margin-top:40px; padding-left:40px; padding-right:40px; background-color: #C5AC58; color: #FFFFFF; font-weight: bold;" href="#" role="button">Mulai</a>
    </div>
  </div>
</div>
</div>

<div class="bg" style="background-color: #14171A">
<div class="container" style="padding-top: 2.5%">
  <div class="row d-flex">
    <div class="col-lg-6 text order-1 order-lg-1" style="align-content: flex-start">
      <h1 style="margin: 5% 0% 5% 0%; color: #C5AC58"><b>Tembaga Studio</b></h1>
      <p style="color: #FFFFFF">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nulla porttitor massa id neque aliquam vestibulum morbi blandit. Senectus et netus et malesuada. Venenatis cras sed felis eget velit aliquet sagittis. Eu ultrices vitae auctor eu augue ut lectus arcu bibendum. 
        Venenatis cras sed felis eget velit aliquet sagittis. </p>

        <br/>
        <div class="line col-lg-6" style="width: 546px; height: 1px; background-color:#C5AC58"></div>
        <br/>
      <p style="margin: 0% 0% 10% 0%; color: #FFFFFF">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nulla porttitor massa id neque aliquam vestibulum morbi blandit. Senectus et netus et malesuada. Venenatis cras sed felis eget velit aliquet sagittis. Eu ultrices vitae auctor eu.</p>
    </div>
    <div class="col-lg-6 order-2 order-lg-2">
      <div class="mapouter" style="align-content: center">
        <div class="gmap_canvas position-absolute top-50 start-50 translate-middle">
          <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Jl.%20TMN%20Candi%20Tembaga%20No.943,%20Kalipancur,%20Kec.%20Ngaliyan,%20Kota%20Semarang,%20Jawa%20Tengah%2050183&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
          <style>.mapouter{
            position:relative;
            text-align:right;
            height:500px;width:600px;
          }
          </style>
          <a href="https://www.embedgooglemap.net">add google maps html</a>
          <style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:400px;}</style>
        </div>
      </div>
    </div>
  </div>

</div>
</div>

<div class="bg" style="background-image: url('/img/Studio2.jpg'); background-size: cover; height:90%; align-self: center;"">
  <div class="container"style="padding-top: 7.5%;">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-10 text order-1 order-lg-1 text-center">
        <h1 class = "fw-bold" style="font-family: 'Roboto'; font-size: 62px; color: #C5AC58;">Brands</h1>
        <h5 style="font-weight: bold; font-size: 30px; color: #C4C4C4;">Alat Studio Band</h5>
        <img src="/img/Logo.png" style="width: 900px; margin: 30px">
        <br/>
        <a class="btn btn-lg" style="margin-top:40px; padding-left:40px; padding-right:40px; background-color: #C5AC58; color: #FFFFFF; font-weight: bold;" href="#" role="button">Selengkapnya</a>
      </div>
    </div>
  </div>
  </div>


@endsection
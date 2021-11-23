@extends('layouts.app')

@section('content')

{{-- Homepage Layanan Sewa --}}
<div class="bg" style="background-image: url('/img/Layanan.png'); background-size: cover; height:100%; align-self: center; margin-top:55px">
    <div class="container position-absolute top-50 start-50 translate-middle">
    <div class="container" style="padding-top: 2.5%">
        <div class="row d-flex">
          <div class="col-lg-5 text order-1 order-lg-1" style="align-content: flex-start;">
            <h4 style="color: #F0F0F0; font-size: 38px"> <b>Detail</b></h4>
            <h2 class="col-lg-12" style="color: #C5AC58; font-size: 85px"><b>Layanan Sewa</b></h2>
          </div>
        </div>
    </div>
    </div>
  </div>


  
  <div class="bg" style="background-color: #14171A">
    <div class="container" style="padding: 2.5% 0 2.5% 0">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-12 text order-1 order-lg-1 text-center">
          <h3 class = "fw-bold" style="font-family: 'Roboto'; color: #C5AC58; margin:30px">Layanan Sewa Studio</h3>
          <div class="row row-cols-auto justify-content-around">
            <style>
              ul {
                margin: 25px;
                list-style-type: '\2713';
                font-weight: 600;
              }
              li::marker {
                color: #C5AC58;
              }
            </style>
          
            <div class="card col" style="background-color: #1A2229; color: #C4C4C4; width: 350px; border-radius: 30px; margin: 20px"> 
              <div class="card-body" style="margin: 20px 0 20px 0;">
                <p class="fs-2" style="margin:0; color: white; font-weight: 500;">Pelajar</p>
                <p style="font-size:22pt; margin: 0; color:#C5AC58;">
                  <b>Rp<span style="font-size:44pt">50.000</span></b>
                </p>
                <p>Per grup (maksimal 5 orang)<br>Tarif per jam</p>
                <a class="btn btn-lg d-grid gap-2" style="padding:3px 0 3px 0; background-color: #C5AC58; color: white; font-weight: bold;" href="#" role="button">Sewa</a>
                <div class="text-start" >
                  <ul class="list-group">
                    <li style="color: white;">Alat Musik Lengkap</li>
                    <li>Amply gitar Marshall JCM 2000</li>
                    <li>Amply bass Fender Rumble 100 dan Marshall Bass State 150</li>
                    <li>Boss GT 8 dan POD Line 6 XT Live</li>
                    <li>Ruangan AC</li>
                  </ul>
                </div>
              </div>
            </div>
  
            <div class="card col" style="background-color: #1A2229; color: #C4C4C4; width: 350px; border-radius: 30px; margin-top: 20px"> 
              <div class="card-body" style="margin: 20px 0 20px 0;">
                <p class="fs-2" style="margin:0; color: white; font-weight: 500;">Reguler</p>
                <p style="font-size:22pt; margin: 0; color:#C5AC58;">
                  <b>Rp<span style="font-size:44pt">80.000</span></b>
                </p>
                <p>Per grup (maksimal 5 orang)<br>Tarif per jam</p>
                <a class="btn btn-lg d-grid gap-2" style="padding:3px 0 3px 0; background-color: #C5AC58; color: white; font-weight: bold;" href="#" role="button">Sewa</a>
                <div class="text-start" >
                  <ul class="list-group">
                    <li style="color: white;">Semua Fasilitas Paket Pelajar</li>
                    <li>Set alat musik lebih lengkap</li>
                    <li>Akses ke ruangan rekaman</li>
                    <li>Audio Controller</li>
                  </ul>
                </div>
              </div>
            </div>
  
            <div class="card col" style="background-color: #1A2229; color: #C4C4C4; width: 350px; border-radius: 30px; margin-top: 20px;"> 
              <div class="card-body" style="margin: 20px 0 20px 0;">
                <p class="fs-2" style="margin:0; color: white; font-weight: 500;">Profesional</p>
                <p style="font-size:22pt; margin: 0; color:#C5AC58;">
                  <b>Rp<span style="font-size:44pt">120.000</span></b>
                </p>
                <p>Per grup (maksimal 5 orang)<br>Tarif per jam</p>
                <a class="btn btn-lg d-grid gap-2" style="padding:3px 0 3px 0; background-color: #C5AC58; color: white; font-weight: bold;" href="#" role="button">Sewa</a>
                <div class="text-start" >
                  <ul class="list-group">
                    <li style="color: white;">Semua fasilitas Paket Reguler</li>
                    <li>Request Setting</li>
                    <li>Professional audio monitor</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg" style="background-image: url('/img/Studio4.png'); padding: 25px">
  <div class="content">
    <h3 class = "fw-bold text-center" style="font-family: 'Roboto'; color: #C5AC58; margin:30px;">Layanan Sewa Sound System</h3>
    
    <div class="row row-cols-2 justify-content-center" style="align-items: center;"> 
      <div class="card col" style="background-color: #1A2229; color: #C4C4C4; width: 380px; border-radius: 30px; margin: 30px 60px 30px 60px">
        <div class="card-body" style="margin: 20px 0 20px 0;">
           <p class="fs-2" style="margin:0; color: white; font-weight: 500; text-align: center">Paket A</p>
          <p style="font-size:22pt; margin: 0; color:#C5AC58; text-align: center">
            <b>Rp<span style="font-size:44pt">850.000</span></b>
          </p>
          <a class="btn btn-lg d-grid gap-2" style="padding:3px 0 3px 0; background-color: #C5AC58; color: white; font-weight: bold;" href="#" role="button">Sewa</a>
          <div class="text-start" >
            <ul class="list-group">
              <li style="color: white">Mixer 12 Ch Yamaha MG12XU</li>
              <li style="margin-top:5px">Behringer Feedback Destroyer</li>
              <li style="margin-top:5px">Mic Wireless Hardwell</li>
              <li style="margin-top:5px">Out Yamaha DBR 12</li>
            </ul>
          </div>
        </div>
      </div>  
  
      <div class="card col" style="background-color: #1A2229; color: #C4C4C4; width: 380px; border-radius: 30px; margin: 30px 60px 30px 60px">
        <div class="card-body" style="margin: 20px 0 20px 0;">
          <p class="fs-2" style="margin:0; color: white; font-weight: 500; text-align: center">Paket B</p>
          <p style="font-size:22pt; margin: 0; color:#C5AC58; text-align: center">
            <b>Rp<span style="font-size:44pt">1.500.000</span></b>
          </p>
          <a class="btn btn-lg d-grid gap-2" style="padding:3px 0 3px 0; background-color: #C5AC58; color: white; font-weight: bold;" href="#" role="button">Sewa</a>
          <div class="text-start">
            <ul class="list-group">
              <li style="color: white">Mixer Digital 16 ch Presonus 16.0.2</li>
              <li style="margin-top:5px">Behringer Feedback Destroyer</li>
              <li style="margin-top:5px">Mic Wireless Hardwell</li>
              <li style="margin-top:5px">Out Yamaha DBR 12</li>
              <li style="margin-top:5px">Out SUB Yamaha DXS 18</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    

    <div class="row row-cols-2 justify-content-center">
      <div class="card col" style="background-color: #1A2229; color: #C4C4C4; width: 380px; border-radius: 30px; margin: 30px 60px 30px 60px">
        <div class="card-body" style="margin: 20px 0 20px 0;">
          <p class="fs-2" style="margin:0; color: white; font-weight: 500; text-align: center">Paket C</p>
          <p style="font-size:22pt; margin: 0; color:#C5AC58; text-align: center">
            <b>Rp<span style="font-size:44pt">2.000.000</span></b>
          </p>
          <a class="btn btn-lg d-grid gap-2" style="padding:3px 0 3px 0; background-color: #C5AC58; color: white; font-weight: bold;" href="#" role="button">Sewa</a>
          <div class="text-start">
            <ul class="list-group">
              <li style="color: white">Mixer Digital 16 ch Presonus 16.0.2</li>
              <li style="margin-top:5px">Behringer Feedback Destroyer</li>
              <li style="margin-top:5px">Mic Wireless Hardwell</li>
              <li style="margin-top:5px">Out Yamaha DBR 12</li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="card col" style="background-color: #1A2229; color: #C4C4C4; width: 380px; border-radius: 30px; margin: 30px 60px 30px 60px">
        <div class="card-body" style="margin: 20px 0 20px 0;">
          <p class="fs-2" style="margin:0; color: white; font-weight: 500; text-align: center">Paket D</p>
          <p style="font-size:22pt; margin: 0; color:#C5AC58; text-align: center">
            <b>Rp<span style="font-size:44pt">2.500.000</span></b>
          </p>
          <a class="btn btn-lg d-grid gap-2" style="padding:3px 0 3px 0; background-color: #C5AC58; color: white; font-weight: bold;" href="#" role="button">Sewa</a>
          <div class="text-start">
            <ul class="list-group">
              <li style="color: white">Mixer Digital 16 ch Presonus 16.0.2</li>
              <li style="margin-top:5px">Behringer Feedback Destroyer</li>
              <li style="margin-top:5px">Mic Wireless Hardwell</li>
              <li style="margin-top:5px">Out Yamaha DBR 12</li>
              <li style="margin-top:5px">Out SUB Yamaha DXS 18</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    

  </div>
  </div>

  <div class="bg" style="background-color: #14171A; padding: 25px">
    <div class="content" style="align-items: center; padding: 40px">
        <h2 class="col-lg-12 text-center" style="color: #C5AC58; font-size: 65px; margin: 20px 20px 50px 0"><b>Layanan Jasa Recording</b></h2>
        <table class="h-50" style="color: #F0F0F0; margin-left: auto; margin-right:auto; width: 50%">
            <tr>
                <td>Sewa Studio Recording (6 jam)</td>
                <td>Rp 550.000</td>
            </tr>
            <tr>
                <td>Live Recording (2 jam + Mixdown)</td>
                <td>Rp 200.000</td>
            </tr>
            <tr>
                <td>Live Recording (6 jam)</td>
                <td>Rp 1.500.000</td>
            </tr>
            <tr>
                <td>Overtime Sewa Studio (per jam)</td>
                <td>Rp 75.000</td>
            </tr>
            <tr>
                <td>Mixing 1 Lagu</td>
                <td>Rp 450.000</td>
            </tr>
            <tr>
                <td>Mastering 1 Lagu</td>
                <td>Rp 100.000</td>
            </tr>
            <tr>
                <td>Paket Mini Album (5 Lagu, 5 Sewa Studio, 5 Lagu Mixing & Mastering)</td>
                <td>Rp 3.750.000</td>
            </tr>
        </table>
    </div>
</div>
  
@endsection
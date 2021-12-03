@extends('layouts.app')

@section('content')
<!-- Home -->
<!-- Prosedur Pinjam -->

<div class="bg" style="background-color: #14171A">
  <div class="container" style="padding: 10% 0% 5% 0%">
    <div class="row d-flex">
      <div class="col-lg-6 align-self-center">
        <h1 style="color: #C5AC58; font-size: 72px"><b>Sewa Studio</b></h1>
      </div>
      <div class="col-lg-6">
        <div style="background-color: white; border-radius: 20px">
          <div style="padding: 5% 10%">
            <h5 class="text-center">Sewa Studio Paket</h5><h5 class="text-center" id="sumpaket"></h5>

            <div class="form-group" style="margin-bottom: 20px">
              <label for="nama" style="font-weight: bold">Nama</label>
              <input type="text" class="form-control" placeholder="Nama Anda" id="nama" name="nama">
            </div>

            <div class="form-group" style="margin-bottom: 20px">
              <label for="WA" style="font-weight: bold">Nomor WhatsApp</label>
              <input type="tel" class="form-control" placeholder="081234567890" id="WA" name="WA">
            </div>

            <div class="form-group" style="margin-bottom: 20px">
              <label for="email" style="font-weight: bold">Email</label>
              <input type="email" class="form-control" placeholder="nama@email.com"name="email" id="email">
            </div>

            <div class="d-flex justify-content-between align-items-center" style="padding: 10px 0;">
              <p style="margin: 0 10px">Tanggal</p>
              <p id="sumtanggal" style="margin: 0 10px">23/12/2021</p></span>
            </div>

            <div class="d-flex justify-content-between align-items-center" style="padding: 10px 0; margin-bottom: 20px; ">
              <p style="margin: 0 10px">Waktu</p>
              <p id="sumwaktu" style="margin: 0 10px">10:00 - 12:00</p></span>
            </div>

            <div class="d-flex justify-content-between align-items-center" style="padding: 10px 0; margin-bottom: 20px; font-weight: bold; background-color: #F9F7EE">
              <p style="margin: 0 10px">Total Biaya</p>
              <p id="totalbiaya" style="margin: 0 10px">Rp200.000,00</p></span>
            </div>

            <div class="d-flex justify-content-center" style="padding: 10px 0">
              <a class="btn" style="padding:3px 0; margin:0 5px; background-color: #C4C4C4; color: white; font-weight: bold; width:30%" href="/sewa1" role="button">Batal</a>
              <a class="btn" style="padding:3px 0; margin:0 5px; background-color: #C5AC58; color: white; font-weight: bold; width:30%" href="#" role="button">Konfirmasi</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
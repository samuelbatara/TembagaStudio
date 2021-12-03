@extends('layouts.app')

@section('content')
<!-- Home -->
<!-- Prosedur Pinjam -->

<div class="bg" style="background-color: #14171A">
  <div class="container" style="padding: 10% 0% 5% 0%; height: 100%">
    <div class="row d-flex">
      <div class="col-lg-6 align-self-center">
        <h1 style="color: #C5AC58; font-size: 72px"><b>Sewa Studio</b></h1>
      </div>
      <div class="col-lg-6">
        <div style="background-color: white; border-radius: 20px">
          <div style="padding: 5% 10%">
            <h5 class="text-center">Pilih Tanggal & Waktu Sewa</h5>

            <div class="form-group" style="margin-bottom: 20px">
              <label for="tanggalsewa" style="font-weight: bold">Tanggal</label>
              <input type="date" class="form-control" name="tanggalsewa" id="tanggalsewa"> 
            </div>

            <div class="form-group" style="margin-bottom: 20px">
              <label for="waktusewa" style="font-weight: bold">Waktu</label>
              <input type="time" class="form-control" name="waktusewa" id="waktusewa"> 
            </div>

            <div style="padding: 10px 0">
              <a class="btn d-grid" style="padding:3px 0;  background-color: #C5AC58; color: white; font-weight: bold;" href="/sewa3" role="button">Lanjut</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
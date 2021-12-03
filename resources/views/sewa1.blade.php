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
            <h5 class="text-center">Pilih Paket & Detail Sewa</h5>

            <div class="form-group" style="margin-bottom: 20px">
              <label for="paket" style="font-weight: bold">Paket</label>
              <select class="form-control" id="paket" name="paket">
                <option value="0">--Pilih Paket--</option>
                <option value="Pelajar">Pelajar</option>
                <option value="Reguler">Reguler</option>
                <option value="Professional">Professional</option>
              </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px">
              <label for="jmlorang" style="font-weight: bold">Jumlah orang</label>
              <input type="number" class="form-control" id="jmlorang" name="jmlorang" value="1" min="1" max="5">
            </div>

            <div class="form-group" style="margin-bottom: 20px">
              <label for="lamasewa" style="font-weight: bold">Lama waktu sewa (jam)</label>
              <input type="number" class="form-control" name="lamasewa" id="lamasewa" value="1" min="1" max="24">
            </div>
            <div style="padding: 10px 0">
              <a class="btn d-grid" style="padding:3px 0;  background-color: #C5AC58; color: white; font-weight: bold;" href="/sewa2" role="button">Lanjut</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
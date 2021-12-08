@extends('layouts.app')

@section('content')
<!-- Home -->
<!-- Prosedur Pinjam --> 
<div class="bg" style="background-color: #14171A">
  <div class="container" style="padding: 10% 0% 5% 0%; height: 100%">
    <div class="row d-flex">
      
 
        @if ($message = Session::get('exception'))
        <div class="alert alert-secondary" role="alert">
          {{ $message }}
        </div>
        @endif 

      <div class="col-lg-6 align-self-center">
        <h1 style="color: #C5AC58; font-size: 72px"><b>Sewa Studio</b></h1>
      </div>
      <div class="col-lg-6">
        <div style="background-color: white; border-radius: 20px">
          <div style="padding: 5% 10%">
            <h5 class="text-center">Pilih Paket & Detail Sewa</h5>
            <form action="/sewa2" method="get">
              <div class="form-group" style="margin-bottom: 20px">
                <label for="paket" style="font-weight: bold">Paket</label>
                <select class="form-control @error('paket') is-invalid @enderror" id="paket" name="paket" required>
                  <option value="none">--Pilih Paket--</option> 
                  @foreach ($packets as $packet)
                      <option value="{{ $packet->packet_id }}" {{ isset($_SESSION['order']['paket']) && $_SESSION['order']['paket']==$packet->packet_id? 'selected' : ''; }}>{{ $packet->name }}</option>
                  @endforeach
                </select>
                @error('paket')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group" style="margin-bottom: 20px">
                <label for="jmlorang" style="font-weight: bold">Jumlah orang</label>
                <input type="number" class="form-control @error('jlh_orang') is-invalid @enderror" id="jlh_orang" name="jlh_orang" 
                  value="@error('oldJlhOrang') {{ $message }} @enderror" min="1" required>
                @error('jlh_orang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group" style="margin-bottom: 20px">
                <label for="lamasewa" style="font-weight: bold">Lama waktu sewa (jam)</label>
                <input type="number" class="form-control @error('durasi') is-invalid @enderror" name="durasi" id="durasi" 
                  value="@error('oldDurasi') {{ $message }} @enderror" min="1" max="24" required>
                  @error('durasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="d-grid gap-2">
                <button class="btn" type="submit" name="submit" style="padding:3px 0;  background-color: #C5AC58; color: white; font-weight: bold;">
                  Lanjut
                </button> 
              </div>
            </form>            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
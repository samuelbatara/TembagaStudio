<script>
    var data = {};
    function pushData(name) {
        var E = document.getElementById(name);
        if(E.value == null || E.value=="none") {
            delete data['price']; 
        } else {
            if(name=='duration' || name=='jlh_orang') {
                data[name] = parseInt(E.value);
            } else { 
                data['price'] = parseInt(E.value);
            }
        }  
        if(Object.keys(data).length == 3) { 
            calculate();
        } else {
            reset();
        }
    }

    function calculate() {
        var E = document.getElementById('price');
        var price = data['price'];
        var durasi = data['duration'];
        var jlh_orang = data['jlh_orang']; 
        // alert([price, durasi, jlh_orang]);
        var total = durasi * price + Math.max(0,  jlh_orang-5) * 30000;  
        E.innerHTML = "Total biaya: " + total;
    }

    function reset() {
        var E = document.getElementById('price');
        E.innerHTML = "Total biaya: -";
    }

</script>

@extends('layouts.main')
 
@section('content')
<script>document.title = "Tambah Buku - Perpustakaan"</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Orders</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
      </div>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Orders</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body"> 
                            <form method="POST" action="/addOrders" enctype="multipart/form-data">
                            @csrf 
                                <div class="col">
                                {{-- @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif --}}
                                <div class="form-group">
                                    <label for="name" style="font-weight: bold">Name</label>
                                    <input type="text" id="name" class="form-control @error('name')
                                        is-invalid
                                    @enderror" placeholder="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone" style="font-weight: bold">Phone</label>
                                    <input type="text" id="phone" class="form-control @error('phone')
                                        
                                    @enderror" placeholder="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" style="font-weight: bold">Email</label>
                                    <input type="text" id="email" class="form-control @error('email')
                                        is-invalid
                                    @enderror" placeholder="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" >
                                    <label for="time" style="font-weight: bold">Tanggal dan Waktu Pemakaian</label>
                                    <input type="datetime-local" id="time" class="form-control @error('time')
                                        is-invalid
                                    @enderror" placeholder="time" name="time" value="{{ old('time') }}" required>
                                    @error('time')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="packet_id" style="font-weight: bold">Paket</label>
                                    <select class="form-control @if ($message = Session::get('packet_id'))
                                        is-invalid
                                    @endif" name="packet_id" id="packet_id" value="{{ old('packet_id') }}" required>
                                        <option value="none" onclick="pushData('packet_id')">-- Pilih Paket --</option>
                                        @foreach ($Paket as $item)
                                            <option value="{{ $item->packet_id }}" onclick="pushData({{ $item->packet_id }})">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($message = Session::get('packet_id'))
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @endif
                                    @foreach ($Paket as $item)
                                        <input type="hidden" id="{{ $item->packet_id }}" value="{{ $item->price }}" required>
                                    @endforeach
                                </div>
                                
                                <div class="form-group">
                                    <label for="jlh_orang" style="font-weight: bold">Jumlah orang</label>
                                    <input class="form-control @error('jlh_orang')
                                        is-invalid
                                    @enderror" type="number" name="jlh_orang" id="jlh_orang" min="1" placeholder="Jumlah orang" value="{{ old('jlh_orang') }}" 
                                            onchange="pushData('jlh_orang')" required>
                                    @error('jlh_orang')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="duration" style="font-weight: bold">Durasi</label>
                                    <input type="number" id="duration" class="form-control @error('duration')
                                        is-invalid
                                    @enderror" min="1" name="duration" placeholder="duration" value="{{ old('duration') }}" onchange="pushData('duration')" required>
                                    @error('duration')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status" style="font-weight: bold">Status</label>
                                    <select class="form-control @if ($message = Session::get('status'))
                                       is-invalid
                                    @endif" name="status" id="status" value="{{ old('status') }}" required>
                                        {{-- <option value="none">-- Pilih Status --</option> --}}
                                        <option value="Paid">Paid</option>
                                        {{-- <option value="Pending">Pending</option> --}}
                                    </select>
                                    @if ($message = Session::get('status'))
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @endif
                                </div> 
                                <div style="font-weight: bold; color: red">
                                    <label id="price">Total biaya: -</label> 
                                </div>
                            </div> 
                            <div class="col-12 d-flex justify-content-end">
                                <button style="margin-right: 5px" type="submit" class="btn btn-primary" name="submit" value="Simpan Data">Tambah</button>
                                <a href="/orders" class="btn btn secondary">Cancel</a>
                            </div>
                        </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </main>
@endsection

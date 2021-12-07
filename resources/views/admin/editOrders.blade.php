@extends('layouts.main')

@section('content')
<script>document.title = "Edit Orders"</script>
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
                                    <h4 class="card-title">Edit Orders</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @foreach ($editOrders as $p)
                                        <form method="POST" action="/orders/update"   enctype="multipart/form-data">
                                        @csrf
                                            <div class="row">
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
                                            <input type="hidden" name="order_id"  value="{{ $p->order_id }}">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input type="text" id="name" class="form-control @error('name')
                                                    is-invalid
                                                @enderror" placeholder="name" name="name" value="{{ $p->name }}">
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                </div> 
                                            <div class="form-group">
                                                <label for="phone">No. WhatsApp</label>
                                                <input type="text" id="phone" class="form-control @error('phone')
                                                    is-invalid
                                                @enderror" placeholder="phone" name="phone" value="{{ $p->phone }}">

                                                @error('phone')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" id="email" class="form-control @error('email')
                                                    is-invalid
                                                @enderror" placeholder="email" name="email" value="{{ $p->email }}">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row mx-auto">
                                                <div class="form-group" style="margin-right: 20px">
                                                    <label for="time">Tanggal Pemakaian</label>
                                                    <input type="date" id="tanggal" class="form-control @error('tanggal')
                                                        is-invalid
                                                    @enderror" name="tanggal" value="{{ date('Y-m-d', strtotime($p->time)) }}">
                                                    @error('tanggal')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group" style="margin-right: 20px">
                                                    <label for="time">Waktu Pemakaian</label>
                                                    <input type="time" id="waktu" class="form-control @error('waktu')
                                                        is-invalid
                                                    @enderror" name="waktu" value="{{ date('H:i', strtotime($p->time)) }}">
                                                    @error('waktu')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                            </div>
                                            

                                            <div class="form-group">
                                                <label for="packet_id">Paket</label>
                                                <select class="form-control" name="packet_id" id="packet_id" placeholder="packet_id" {{ (strcmp("Paid", $p->status)==0)? 'disabled':''; }}>
                                                    @foreach ($packets as $item)
                                                        <option value="{{ $item->packet_id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="duration">Durasi</label>
                                                <input type="number" id="duration" class="form-control"
                                                    name="duration" placeholder="duration" value="{{ $p->duration }}" min="1" {{ (strcmp('Paid', $p->status)==0)? 'disabled':''; }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>  
                                                <select class="form-control" name="status" id="status" {{ (strcmp('Paid', $p->status)==0)? 'disabled':''; }}>
                                                    <option value="Paid" {{ strcmp($p->status,'Paid')==0? 'selected':''; }}>Paid</option>
                                                    <option value="Pending" {{ strcmp($p->status,'Pending')==0? 'selected':''; }}>Pending</option>
                                                    <option value="Denied" {{ strcmp($p->status,'Denied')==0? 'selected':''; }}>Denied</option>
                                                </select>
                                            </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary" name="submit" value="Simpan Data">Submit</button>
                                                    <a href="/orders" class="btn btn secondary">Cancel</a>
                                                </div>
                                            </div>
                                            </div>
                                            
                                        </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
  </main>
@endsection

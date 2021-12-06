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
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            <input type="hidden" name="id"  value="{{ $p->order_id }}">
                                                <div class="form-group">
                                                    <label for="name">name</label>
                                                    <input type="text" id="name" class="form-control"
                                                        placeholder="name" name="name" value="{{ $p->name }}">
                                                </div>
                                            <div class="form-group">
                                                <label for="phone">phone</label>
                                                <input type="text" id="phone" class="form-control"
                                                    placeholder="phone" name="phone" value="{{ $p->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">email</label>
                                                <input type="text" id="email" class="form-control"
                                                    placeholder="email" name="email" value="{{ $p->email }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="time">time</label>
                                                <input type="text" id="time" class="form-control"
                                                    name="time" placeholder="time" value="{{ $p->time }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="packet_id">Paket</label>
                                                <select class="form-control" name="packet_id" id="packet_id" placeholder="packet_id" >
                                                    @foreach ($Paket as $packet_id => $name)
                                                        <option value="{{ $packet_id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="duration">Durasi</label>
                                                <input type="number" id="duration" class="form-control"
                                                    name="duration" placeholder="duration" value="{{ $p->duration }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                        <option value="Paid">Paid</option>
                                                        <option value="Unpaid">Unpaid</option>
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

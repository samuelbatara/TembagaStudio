@extends('layouts.main')

@section('content')
<script>document.title = "Detail Order - Tembaga Studio"</script>
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
                      <h4 class="card-title">Detail Order</h4>
                  </div>
                  <div class="card-content">
                      <div class="card-body"> 
                          <div class="row">
                          <div class="col"> 
                          <input type="hidden" name="order_id"  value="{{ $order->order_id }}" disabled>
                          <div class="form-group">
                              <label for="name">Nama</label>
                              <input type="text" id="name" class="form-control" placeholder="name" name="name" value="{{ $order->name }}" disabled> 
                              </div> 
                          <div class="form-group">
                              <label for="phone">No. WhatsApp</label>
                              <input type="text" id="phone" class="form-control" placeholder="phone" name="phone" value="{{ $order->phone }}" disabled> 
                          </div>
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="text" id="email" class="form-control" placeholder="email" name="email" value="{{ $order->email }}" disabled> 
                          </div>

                          <div class="row mx-auto">
                              <div class="form-group" style="margin-right: 20px">
                                  <label for="time">Tanggal Pemakaian</label>
                                  <input type="date" id="tanggal" class="form-control" name="tanggal" disabled value="{{ date('Y-m-d', strtotime($order->time)) }}">
                              </div>
                              
                              <div class="form-group" style="margin-right: 20px">
                                  <label for="time">Waktu Pemakaian</label>
                                  <input type="time" id="waktu" class="form-control" name="waktu" disabled value="{{ date('H:i', strtotime($order->time)) }}"> 
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label for="packet_id">Paket</label>
                              <select class="form-control" name="packet_id" id="packet_id" placeholder="packet_id" disabled>
                                  @foreach ($packets as $item)
                                      <option value="{{ $item->packet_id }}">{{ $item->name }}</option>
                                  @endforeach
                              </select>
                          </div> 
                          
                          <div class="form-group">
                              <label for="duration">Durasi</label>
                              <input type="number" id="duration" class="form-control"
                                  name="duration" placeholder="duration" value="{{ $order->duration }}" min="1" disabled>
                          </div>
                          <div class="form-group">
                              <label for="status">Status</label>  
                              <select class="form-control" name="status" id="status" disabled>
                                  <option value="Paid" {{ strcmp($order->status,'Paid')==0? 'selected':''; }}>Paid</option>
                                  <option value="Pending" {{ strcmp($order->status,'Pending')==0? 'selected':''; }}>Pending</option>
                                  <option value="Denied" {{ strcmp($order->status,'Denied')==0? 'selected':''; }}>Denied</option>
                              </select>
                          </div class="form-group">
                              <div class="col-12 d-flex justify-content-end">
                                  <a href="/orders" style="font-weight: bold">Kembali</a>
                              </div>
                          </div>
                          </div> 
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  </main>
@endsection

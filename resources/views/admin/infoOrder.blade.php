<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

@extends('layouts.main')

@section('content')
<script>document.title = "Detail Order - Tembaga Studio"</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2" style="font-weight: bold;">Order</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
          <div class="mr-2">
            <a type="button" class="btn btn-secondary" href="/orders" style="font-weight: bold">
                Kembali
            </a>
            </div>
          @if ($order->status == 'Pending') 
          <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" style="font-weight: bold">
                Batalkan Order
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Batalkan Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <h6>Apakah Anda yakin untuk menghapus order {{ $order->order_id }}?</h6>
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <form action="/cancel/{{ $order->order_id }}" method="GET">
                            <button type="submit" class="btn btn-danger">Ya</button>
                        </form>                         
                    </div>
                </div>
                </div>
            </div> 
          @endif
      </div>
    </div>
    <section id="multiple-column-form">
      <div class="row match-height">

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold;">Detail Order</h4>
                </div>
                <div class="card-content">
                    <div class="card-body"> 
                        <div class="form-group">
                            <label style="font-weight: bold;">ID Order</label>
                            <input class="form-control" type="text" value="{{ $order->order_id }}" disabled>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold;">Tipe Pembayaran</label>
                            <input class="form-control" type="text" value="{{ $store }}" disabled>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold;">Paket</label>
                            <input class="form-control" type="text" value="{{ $packet->name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">Durasi</label>
                            <input class="form-control" type="text" value="{{ $order->duration }} Jam" disabled>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">Biaya</label>
                            <input class="form-control" type="text" value="Rp. {{ (int)$amount }}" disabled>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">Tanggal Pemakaian</label>
                            <input class="form-control" type="text" value="{{ date('Y-m-d H:i', strtotime($order->time)) }}" disabled>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">Tanggal Pemesanan</label>
                            <input class="form-control" type="text" value="{{ date('Y-m-d H:i', strtotime($order->created_at)) }}" disabled>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">Status</label>
                            <input class="form-control" type="text" value="{{ ucfirst($order->status) }}" disabled>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold;">Detail Customer</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        <div class="form-group">
                            <label style="font-weight: bold;">Nama</label>
                            <input class="form-control" type="text" value="{{ $order->name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">No. WhatsApp</label>
                            <input class="form-control" type="text" value="{{ $order->phone }}" disabled>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">Email</label>
                            <input class="form-control" type="text" value="{{ $order->email }}" disabled>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        
        <div class="col-6">
            <br><br>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold;">Detail Pembayaran</h4>
                    {{-- @if ($order->status != 'Paid')
                        <span style="font-style: italic; font-weight: bold; color:red">Belum dibayar</span>
                    @endif --}}
                </div>
                <div class="card-content">
                    <div class="card-body">
                         
                        <div class="form-group">
                            <label style="font-weight: bold;">Kode Pembayaran</label>
                            <input class="form-control" type="text" value="{{ $payment_code }}" disabled>
                        </div> 
                        <div class="form-group">
                            <label style="font-weight: bold;">Tanggal Kadaluarsa</label>
                            <input class="form-control" type="text" value="{{ date('Y-m-d H:i', strtotime('+1 days', strtotime($order->created_at))) }}" disabled>
                        </div> 
                        
                    </div>
                </div>
            </div>

        </div> 
      </div>
      <div class="row match-height"> 
        <div class="col">
            <br><br>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold;">Detail Item</h4>
                </div>
                <div class="card-content">
                    <div class="card-body table-responsive">

                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kuantitas</th>
                                    <th>Harga per Unit</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td>Paket {{ $packet->name }}</td>
                                    <td>{{ $order->duration }}</td>
                                    <td>Rp. {{ $packet->price }}</td>
                                    <td>Rp. {{ $order->duration * $packet->price }}</td>
                                </tr>
                                @if ($jlh_orang > 0)
                                <tr>
                                    <td>{{ "Charge" }}</td>
                                    <td>{{ $jlh_orang }}</td>
                                    <td>Rp. 30000</td>
                                    <td>Rp. {{ $jlh_orang * 30000 }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="font-weight: bold;">Total</td>
                                    <td></td>
                                    <td></td>
                                    <td style="font-weight: bold;">Rp. {{ (int)$amount }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
      </div>
      
      <div class="row match-height">
        <div class="col">
            <br><br>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold;">History Pembayaran</h4>
                    @if ($order->status != 'Settlement')
                        <span style="font-style: italic; color: red;">Belum ada pembayaran</span>
                    @endif
                </div>
                <div class="card-content">
                    <div class="card-body table-responsive">

                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Waktu Pembayaran</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if ($order->status == 'Settlement')
                                    <tr>
                                        <td>{{ date('Y-m-d H:i', strtotime($payment->time)) }}</td>
                                        <td>Rp. {{ $payment->amount }}</td>
                                        <td>Lunas</td>
                                    </tr>
                                @endif 
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
      </div>

  </section>
  </main>
@endsection

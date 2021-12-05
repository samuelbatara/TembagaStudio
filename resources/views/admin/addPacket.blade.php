@extends('layouts.main')

@section('content')
<script>document.title = "Tambah Paket - Tembaga Studio"</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Paket</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
      </div>
    </div>
    <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tambah Paket</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" action="/packets/addPackets/sukses" enctype="multipart/form-data">
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
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name" class="form-control"
                                                        placeholder="name" name="name" value="{{ old('name') }}">
                                                </div>
                                            <div class="form-group">
                                                <label for="price">Harga</label>
                                                <input type="text" id="price" class="form-control"
                                                    placeholder="price" name="price" value="{{ old('price') }}">
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary" name="submit" value="Simpan Data">Submit</button>
                                                    <a href="/packets" class="btn btn secondary">Cancel</a>
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

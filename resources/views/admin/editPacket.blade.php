@extends('layouts.main')

@section('content')
<script>document.title = "Edit Paket"</script>
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
                                    <h4 class="card-title">Edit Paket</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @foreach ($editPacket as $p)
                                        <form method="POST" action="/packets/update"   enctype="multipart/form-data">
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
                                            <input type="hidden" name="id"  value="{{ $p->packet_id }}">
                                                <div class="form-group">
                                                    <label for="name">name</label>
                                                    <input type="text" id="name" class="form-control"
                                                        placeholder="name" name="name" value="{{ $p->name }}">
                                                </div>
                                            <div class="form-group">
                                                <label for="price">price</label>
                                                <input type="text" id="price" class="form-control"
                                                    placeholder="price" name="price" value="{{ $p->price }}">
                                            </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary" name="submit" value="Simpan Data">Submit</button>
                                                    <a href="/packets" class="btn btn secondary">Cancel</a>
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

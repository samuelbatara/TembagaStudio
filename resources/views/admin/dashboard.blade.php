@extends('layouts.main')

@section('content')

<script>document.title = "Dashboard - Tembaga Studio"</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="container">
    <div class="top">
        <p><span class="text-top">Tembaga</span>admin</p>
        <div class="line-top"></div>
        <p>Dashboard</p>
    </div>
    <div class="mid">
        <p class="mid-title">Halo Gading Ihsan!!!</p>
        <p>
            Hari ini ada<span class="text-mid">{{$paid}} studio dibooking</span>dan<span class="text-mid">{{$pending}} pending</span>
        </p>
    </div>
    <div class="bottom">
        <div class="bottom-left">
            <p>Total Jumlah Orders :<span class="text-mid">{{$countorder}}  </span></p>
            <!-- chart -->
            <p>Total Jumlah Pendapatan Paket 1 :<span class="text-mid">{{$sumpacket1}}  </span></p>      
            <p>Total Jumlah Pendapatan Paket 2 :<span class="text-mid">{{$sumpacket2}}  </span></p>  

        </div>
        <div class="bottom-right">
            <p>Pendapatan bulan ini</p>
            <h1 class="font-weight-bold">Rp. {{$sum}},-</h1>
        </div>
    </div>
</div>
</main>
@endsection
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" style="color: #C5AC58; font-family: 'Roboto';" href="#">Tembaga</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav"> 
          <a class="nav-link" aria-current="page" href="/">Beranda</a>
          <a class="nav-link" href="/layanan">Layanan</a>
          <a class="nav-link" href="/sewa1">Sewa</a>
          <a class="nav-link" href="{{ route('admin.dashboard') }}" tabindex="-1"><img class = "img-fluid" style="height: 30px; " src="img/profile.png"></a>
        </div>
      </div>
    </div>
  </nav>

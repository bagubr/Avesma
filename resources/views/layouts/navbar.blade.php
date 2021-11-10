<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0px 5px 30px #383f85; z-index: 1">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="asset/logo-avesma-10.png" class="img-fluid navbar-brand" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item mx-3 {{Request::routeIs('home') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('home')}}">Beranda</a>
                </li>
                <li class="nav-item mx-3 {{Request::routeIs('pasar_virtual') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('pasar_virtual')}}">Pasar Virtual</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="#">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
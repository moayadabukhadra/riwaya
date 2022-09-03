<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="{{ asset('images/riwaya.jpg') }}" width="50" class="rounded-full ">
    <a class="font-semibold navbar-brand" href="/dashboard">Riwaya</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="flex gap-3 mr-auto navbar-nav">
            @guest
            <li class="nav-item active">
                <a class="nav-link" href="/login-register">Login <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/login-register">Register</a>
            </li>
            @endguest

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    language
                </a>
                <div class="text-center dropdown-menu" aria-labelledby="navbarDropdown">
                    <button class="dropdown-item" wire:click="language('ar')">العربية</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" wire:click="language('en')">English</button>
                </div>
            </li>
            @auth
            <li>
                <a href="/shopping-cart" class="text-2xl"><i class="bi bi-cart3"></i> {{ \Cart::getTotalQuantity() }}</a>
            </li>
            <li>
                <a class="font-bold nav-link" wire:click.prevent="logout" href="#">Logout</a>

            </li>
            @endauth
        </ul>







        <form class="my-2 form-inline my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="my-2 btn btn-outline-success my-sm-0" type="submit">Search</button>
        </form>

    </div>
</nav>

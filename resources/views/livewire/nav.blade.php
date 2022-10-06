<nav class="navbar navbar-expand-lg navbar-light bg-secondary d-flex gap-5 justify-content-around align-items-center" id="nav">

    <a class="font-semibold navbar-brand text-white d-flex gap-2 align-items-center mr-auto" href="/dashboard"> <img
            src="{{ asset('images/riwaya.jpg') }}" width="50" class="rounded-full ">Riwaya</a>
    <button class="navbar-toggler bg-white m-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="flex lg:gap-5 mr-auto navbar-nav m-2 ">
            @guest
                <li class="nav-item ">
                    <a class="nav-link text-white" href="/login-register">Login <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/login-register">Register</a>
                </li>
            @endguest
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    language
                </a>
                <div class="text-center dropdown-menu" aria-labelledby="navbarDropdown">
                    <button class="dropdown-item" wire:click="language('ar')">العربية</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" wire:click="language('en')">English</button>
                </div>
            </li>
                @auth()
                    @if(auth()->user()->email === 'moayadabukhadra54@gmail.com')
                        <li>
                            <a class="font-bold nav-link text-white  " href="/orders">Orders</a>
                        </li>
                    @endif
                @endauth
            @auth
                <li class="align-self-center">
                    <a href="/shopping-cart" class="text-2xl text-primary text-decoration-none"><i
                            class="bi bi-cart"></i> {{ \Cart::getTotalQuantity() }}</a>
                </li>
                <li>
                    <a class="font-bold nav-link text-white d-flex align-items-center gap-1" wire:click.prevent="logout" href="#"><i class="bi bi-box-arrow-left fw-bold"></i>Logout</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

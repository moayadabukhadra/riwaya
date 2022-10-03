<nav class="navbar navbar-expand-lg navbar-light bg-dark " id="nav">

    <a class="font-semibold navbar-brand text-white d-flex gap-2" href="/dashboard"> <img
            src="{{ asset('images/riwaya.jpg') }}" width="50" class="rounded-full ">Riwaya</a>
    <button class="navbar-toggler bg-white m-2" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="flex lg:gap-5 mr-auto navbar-nav m-2 ">
            @guest
                <li class="nav-item active">
                    <a class="nav-link text-white" href="/login-register">Login <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/login-register">Register</a>
                </li>
            @endguest

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <a class="font-bold nav-link text-white " href="/orders">Orders</a>
                        </li>
                    @endif
                @endauth
            @auth
                <li>
                    <a href="/shopping-cart" class="text-2xl"><i
                            class="bi bi-cart3"></i> {{ \Cart::getTotalQuantity() }}</a>
                </li>
                <li>
                    <a class="font-bold nav-link text-white " wire:click.prevent="logout" href="#">Logout</a>
                </li>
            @endauth
        </ul>


    </div>
</nav>

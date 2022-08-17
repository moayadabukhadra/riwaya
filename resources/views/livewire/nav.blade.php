@if(auth()->check())


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/dashboard">Riwaya</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="mr-auto navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">My Orders</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Language
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <button class="dropdown-item"  wire:click="language('ar')">Arabic </button>
                    <button class="dropdown-item"  wire:click="language('en')">English </button>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link " wire:click.prevent="logout">Logout</a>
            </li>
            <a href="/shopping-cart">
            <li class="flex text-red-500 nav-item justify-selfcol-end-1 text-end" >

            <img src="https://img.icons8.com/ios-glyphs/30/FA5252/shopping-cart--v1.png"/>{{ \Cart::getTotalQuantity() }}

            </li>
            </a>
        </ul>
        <form class="my-2 form-inline my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" wire:model="searchTerm">
            <button class="my-2 btn btn-outline-success my-sm-0" type="submit" wire:click.prevent="search()">Search</button>
        </form>
    </div>
</nav>



@else
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/dashboard">Riwaya</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="mr-auto navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard">Home <span class="sr-only">(current)</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link " href="/login-register">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/login-register">Login</a>
            </li>

        </ul>
        <form class="my-2 form-inline my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" wire:model="searchTerm">
            <button class="my-2 btn btn-outline-success my-sm-0" type="submit" wire:click.prevent="search()">Search</button>
        </form>
    </div>
</nav>

@endif

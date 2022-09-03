@props(['book','wire','lang'])

@if($lang=="en")
<div class="mb-12 card bg-light lg:w-60 ">
    <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
    <h6 class="absolute px-4 py-1 mt-64 mr-24 bg-red-500 rounded-r-xl sm:mt-1/2">{{ $book->price }}jd</h6>
        <img src="{{$book->image}}" />
        <a href="#!">

            <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </div>
        </a>
    </div>
    <div class="card-body">
        <a href="" class="no-underline text-reset hover:underline">
            <h5 class="mb-3 card-title ">{{ $book->title }}</h5>
        </a>
        <a href="" class="no-underline text-reset hover:underline">
            <p>{{ $book->author }}</p>
        </a>
        <button type="button"
                class="p-2 bg-blue-400" wire:click.prevent="{{$wire}}">

                <b> View </b>
            </button>
    </div>
</div>
@else

<div class="mb-12 card bg-light lg:w-60 ">
    <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
    <h6 class="absolute px-4 py-1 mt-48 mr-24 bg-red-500 rounded-r-xl sm:mt-1/2">{{ $book->price }}jd</h6>
        <img src="{{$book->image}}" />
        <a href="#!">

            <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </div>
        </a>
    </div>
    <div class="card-body">
        <a href="" class="no-underline text-reset hover:underline">
            <h5 class="mb-3 card-title ">{{ $book->translate('ar')->title }}</h5>
        </a>
        <a href="" class="no-underline text-reset hover:underline">
            <p>{{ $book->translate('ar')->author }}</p>
        </a>
        <button type="button"
                class="p-2 bg-blue-400" wire:click.prevent="{{$wire}}">

                <b> View </b>
            </button>
    </div>
</div>
@endif

@props(['book','wire','lang'])

    <div class="mb-12 card bg-light  text-right h-75 ">
        <div class="position-relative" data-mdb-ripple-color="light">
            <h6 class="absolute px-5 py-1 bottom-0 mb-5  bg-red-500 rounded-r-xl ">{{ $book->book->price }}jd</h6>
            <img src="{{$book->book->image}}" width="350" height="350"/>
        </div>
        <div class="card-body">
            <a href="" class="no-underline text-reset hover:underline">
                <h5 class="mb-3 card-title ">{{ $book->title }}</h5>
            </a>
            <a href="" class="no-underline text-reset hover:underline">
                <p>{{ $book->author }}</p>
            </a>
            <button type="button"
                    class="p-2 bg-info rounded w-25" wire:click.prevent="{{$wire}}">

                <b> عرض </b>
            </button>
        </div>
    </div>

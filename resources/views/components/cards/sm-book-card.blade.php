
@props(['book','wire','lang'])
<div class="col">
<div class="card">
    <img src="{{$book->book->image}}" class="card-img-top" alt="book image">
    <h6 class="absolute px-5 py-1 bottom-48 mb-5  bg-red-500 rounded-r-xl">{{ $book->book->price }}jd</h6>
    <div class="card-body">
        <h5 class="card-title">{{ $book->title }}</h5>
        <p>{{ $book->author }}</p>
    </div>
    <button type="button"
            class="btn btn-primary w-24 m-3" wire:click.prevent="{{$wire}}">

        <b> عرض </b>
    </button>
    <div class="card-footer">
        <small class="text-muted">{{ $book->book->updated_at }}</small>
    </div>
</div>
</div>

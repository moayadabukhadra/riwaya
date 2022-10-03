@props(['book','wire','lang'])
<div class="col">
    <div class="card">
        <img src="{{$book->book->image}}" class=" d-block img-fluid" alt="book image"
             style="width: 100%;height: 400px;object-fit: cover">
        <h6 class="absolute px-5 py-1 bottom-48 mb-5  bg-red-500 rounded-r-xl">{{ $book->book->price }}jd</h6>
        <div class="card-body">
            <h5 class="card-title {{ $lang=='ar' ? "text-right" : "text-left" }}">{{ $book->title }}</h5>
            <p class="{{ $lang=='ar' ? "text-right" : "text-left" }}">{{ $book->author }}</p>
        </div>
        <button type="button"
                class="btn btn-primary w-24 m-3 {{ $lang=='ar' ? "align-self-end" : "align-self-start" }}" wire:click.prevent="{{$wire}}">

            <b> {{ $lang=='ar' ? "عرض" : "view" }} </b>
        </button>
        <div class="card-footer">
            <small class="text-muted">{{ $book->book->updated_at }}</small>
        </div>
    </div>
</div>

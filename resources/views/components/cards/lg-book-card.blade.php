@props(['src','wire','book'])

<button href="#" class="block w-full p-5 mt-8 transition-all duration-300 transform scale-100 rounded-lg hover:scale-95" style="background: url({{ $src }} ) center; background-size: cover;" wire:click.prevent="{{ $wire }}">
    <div class="h-48"></div>

    <div class="w-full ">

        <div class="">
            <h2 class="mb-3 text-2xl font-bold leading-tight text-center text-white">{{ $book->title }} - {{ $book->author }}</h2>
            <div class="text-lg font-bold text-white"></div>
        </div>
        <div class="w-20 px-3 py-2 mt-3 text-2xl font-bold text-white bg-blue-300 rounded-xl">{{ $book->price}} Jd</div>

    </div>

</button>

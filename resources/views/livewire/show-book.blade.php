<div class="">

    @if(!$show)



    <div tabindex="0" class="focus:outline-none">

        <div class="container py-8 mx-auto">
            <div class="flex flex-wrap items-center justify-center lg:justify-between">


                @foreach($books as $book)
                <x-cards.sm-book-card :book="$book" wire="show({{ $book->id}})" :lang=$language />
                @endforeach

            </div>
        </div>
        <div class="flex justify-center mb-4">
        </div>


        @else


        <section class="overflow-hidden text-gray-700 bg-white body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap mx-auto lg:w-4/5">
                    <img class="object-cover object-center w-full border border-gray-200 rounded lg:w-1/2" src="{{ asset('storage/'.$selectedBook->image) }}">
                    <div class="w-full mt-6 lg:w-1/2 lg:pl-10 lg:py-6 lg:mt-0">
                        @if($language == 'en')
                        <h2 class="text-sm tracking-widest text-gray-500 title-font">{{ $selectedBook->author }}</h2>
                        <h1 class="mb-1 text-3xl font-medium text-gray-900 title-font">{{ $selectedBook->title }}</h1>
                        <div class="flex mb-4">


                        </div>
                        <p class="leading-relaxed">{{ $selectedBook->description}}</p>
                        @else
                        <h2 class="text-sm tracking-widest text-gray-500 title-font">{{ $selectedBook->translate('ar')->author }}</h2>
                        <h1 class="mb-1 text-3xl font-medium text-gray-900 title-font">{{ $selectedBook->translate('ar')->title }}</h1>
                        <div class="flex mb-4">
                            <div class="flex items-center">
                                <div class="flex items-center">

                                    <p class="text-sm leading-relaxed">{{ $selectedBook->translate('ar')->description }}</p>
                                </div>
                            </div>
                        </div>
                        @if(auth()->check())
                        <div class="flex mt-4">
                            <span class="text-2xl font-medium text-gray-900 title-font">{{ $selectedBook->price }}jd</span>
                            <button class="flex px-6 py-2 ml-auto text-white bg-red-500 border-0 rounded focus:outline-none hover:bg-red-600" wire:click="addToCart({{ $selectedBook }})">Add To Cart</button>
                            <button class="inline-flex items-center justify-center w-10 h-10 p-0 ml-4 text-gray-500 bg-gray-200 border-0 rounded-full">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                </svg>
                            </button>
                        </div>
                        @else
                        @livewire('login-modal')
                        @endif
                        <x-session-message />
                        @endif


                    </div>
                </div>

            </div>

        </section>



        <div class="container py-8 mx-auto">
            <h1 class="text-xl font-bold text-center">Books For The same writer</h1>
            <div class="flex flex-wrap items-center justify-center lg:justify-between">


                @foreach($books as $book)
                <x-cards.sm-book-card :book="$book" wire="show({{ $book->id}})" :lang=$language />
                @endforeach

            </div>

        </div>
        <div class="flex justify-center mb-4">
        </div>

    </div>
</div>


@endif


</div>

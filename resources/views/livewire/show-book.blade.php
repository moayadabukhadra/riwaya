<div class="position-relative" id="container">
    <div class="flex flex-column justify-content-center align-items-center">
        <a href="#nav" class="position-fixed bottom-20 left-0 z-50" >
            <i class="bi bi-arrow-up p-6 rounded-full bg-gray-300 m-8 "></i>
        </a>
        <a  class="position-fixed bottom-20 right-0 z-50" id="search-icon">
            <i class="bi bi-search p-6 rounded-full bg-gray-300 m-8 " aria-hidden="true"></i>

        </a>

            <input class="form-control form-control-solid form-control-lg mt-5 text-right w-75 mb-6 z-40" id="search"
                   placeholder="أدخل نص البحث .." aria-label=".form-control-lg example" wire:model="searchTerm">



    </div>

    @if(!$show)






        <div class="focus:outline-none">

            <div class="row row-cols-lg-5 row-cols-md-2 row-cols-sm-1 g-4 m-2">
                @foreach($books as $book)
                    <x-cards.sm-book-card :book="$book" wire="show({{ $book->book_id}})" :lang="$language"/>
                @endforeach
            </div>



            @else


                <section class="text-gray-700 bg-white border border-b" id="selected_book">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="flex flex-wrap mx-auto ">
                            <img class="object-cover object-center w-full border-gray-200 rounded-lg lg:w-1/2"
                                 src="{{$selectedBook->image }}">
                            <div class="w-full mt-6 lg:w-1/2 lg:pl-10 lg:py-6 lg:mt-0">
                                @if($language == 'en')
                                    <div class=text-left>
                                        <h2 class="text-sm tracking-widest text-gray-500 title-font">{{ $selectedBook->author }}</h2>
                                        <h1 class="mb-1 text-3xl font-medium text-gray-900 title-font">{{ $selectedBook->title }}</h1>
                                    </div>
                                    <p class="p-3 text-sm leading-relaxed text-left rounded-xl bg-light">{{ $selectedBook->description}}</p>
                                @else
                                    <div class="text-right">
                                        <h2 class="text-sm tracking-widest text-gray-500 title-font ">{{ $selectedBook->translate('ar')->author }}</h2>
                                        <h1 class="mb-1 text-3xl font-medium text-gray-900 title-font">{{ $selectedBook->translate('ar')->title }}</h1>

                                        <p class="p-3 text-sm leading-relaxed rounded-xl bg-light">{{ $selectedBook->translate('ar')->description }}</p>
                                    </div>


                                @endif
                                @if(auth()->check())
                                    <div class="flex mt-4">
                                        <span class="text-2xl font-medium text-gray-900 title-font">{{ $selectedBook->price }}jd</span>
                                        <button
                                            class="flex px-6 py-2 ml-auto text-white bg-red-500 border-0 rounded focus:outline-none hover:bg-red-600"
                                            wire:click="addToCart({{ $selectedBook }})">Add To Cart
                                        </button>
                                        <button
                                            class="inline-flex items-center justify-center w-10 h-10 p-0 ml-4 text-gray-500 bg-gray-200 border-0 rounded-full">
                                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                 stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path
                                                    d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @else
                                    @livewire('login-modal')
                                @endif
                                <x-session-message/>


                            </div>
                        </div>

                    </div>

                </section>


                <div class="row row-cols-lg-5 row-cols-md-1 g-4 m-2 ">
                    @foreach($books as $book)
                        <x-cards.sm-book-card :book="$book" wire="show({{ $book->book_id}})" :lang="$language"/>
                    @endforeach
                </div>


        </div>



    @endif


</div>

<script>
    document.getElementById('search-icon').addEventListener('click',function (){
        document.getElementById('search').style.position='fixed'

    })

</script>


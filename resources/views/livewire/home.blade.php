<x-layout>
    @include('components.header')



    <section class="text-gray-600 body-font">
        <div class="container px-5 py-5 mx-auto">
            <div class="flex flex-wrap -m-4">

                @livewire('show-book')

            </div>
        </div>
    </section>



</x-layout>

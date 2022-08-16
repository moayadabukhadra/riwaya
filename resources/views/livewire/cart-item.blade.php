<div class="flex items-center px-6 py-5 -mx-8 hover:bg-gray-100">
    <div class="flex w-2/5">
        <!-- product -->
        <div class="w-20">
            <img class="w-24 h-24" src="{{ asset('storage/'.$item['attributes']['image'])}}" alt="">
        </div>
        <div class="flex flex-col justify-between flex-grow ml-4">
            <span class="mt-10 text-sm font-bold ">{{ $item['name']}} </span>
        </div>
    </div>

    <span class="w-1/5 text-sm font-semibold text-center">{{ $item['price']}} Jd</span>
    <div class="flex justify-center w-1/5">
        <svg class="w-3 text-gray-600 fill-current" viewBox="0 0 448 512">
            <path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
        </svg>

        <input class="w-12 mx-2 text-center border" wire:model="quantity" type="number" min="1" max="100" wire:change="updateCart" value="{{ $item['quantity']}}">

        <svg class="w-3 text-gray-600 fill-current" viewBox="0 0 448 512">
            <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
        </svg>
    </div>

    <div >
        <button  class="px-6 py-2 text-red-800 bg-red-300" wire:click.prevent="removeCart('{{$item['id']}}')">Remove Cart</button>
    </div>


</div>

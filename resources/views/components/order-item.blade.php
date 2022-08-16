@props(['item'])
<div class="flex flex-col items-start justify-start w-full mt-6 mb-8 space-y-4 md:mt-0 md:flex-row md:items-center md:space-x-6 xl:space-x-8">
    <div>
        <img class="" src="{{ asset('storage/'.$item['attributes']['image']) }}" alt="item" width="100" height="100" />
    </div>
    <div class="flex flex-col items-start justify-between w-full space-y-4 md:flex-row md:space-y-0">
        <div class="flex flex-col items-start justify-start w-full space-y-8">
            <h3 class="text-xl font-semibold leading-6 text-gray-800 dark:text-white xl:text-2xl">{{$item['name']}}</h3>

        </div>
        <div class="flex items-start justify-between w-full space-x-8">
            <p class="text-base leading-6 dark:text-white xl:text-lg">{{$item['price']}}jd</p>
            <p class="text-base leading-6 text-gray-800 dark:text-white xl:text-lg">{{$item['quantity']}}</p>
            <p class="text-base font-semibold leading-6 text-gray-800 dark:text-white xl:text-lg">{{$item['price'] *$item['quantity']}} jd</p>
        </div>
    </div>
</div>

<div class="container mx-auto mt-10">
    <x-session-message />
    <div class="flex my-10 shadow-md">
        <div class="w-3/4 px-10 py-10 bg-white">
            <div class="flex justify-between pb-8 border-b">
                <h1 class="text-2xl font-semibold">Shopping Cart</h1>
                <h2 class="text-2xl font-semibold"> Total {{ Cart::getTotalQuantity()}} Cart </h2>

            </div>
            @if(!empty($cartItems))
            <div class="flex mt-10 mb-5">
                <h3 class="w-2/5 text-xs font-semibold text-gray-600 uppercase">Product Details</h3>
                <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Price</h3>
                <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Quantity</h3>

            </div>

            @foreach($cartItems as $item)


            <livewire:cart-item :item="$item" :key="$item['id']" />

            @endforeach
            @else
            <div class="items-center mt-12 space-y-20 text-center">
                <h1 class="mb-4 text-xl text-gray-500">سلة المشتريات فارغة</h1>
                <a href="/dashboard" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">
                    اضف اكتر من صنف
                </a>
            </div>
            @endif

            <a class="flex mt-10 text-sm font-semibold text-indigo-600" href="/dashboard">

                <svg class="w-4 mr-2 text-indigo-600 fill-current" viewBox="0 0 448 512">
                    <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                اضف المزيد
            </a>
        </div>

        <div id="summary" class="w-1/4 px-8 py-10">
            <h1 class="pb-8 text-2xl font-semibold border-b">Order Summary</h1>
            <div class="flex justify-between mt-10 mb-5">
                <span class="text-sm font-semibold uppercase">Total {{ Cart::getTotalQuantity()}} Cart</span>
                <span class="text-sm font-semibold">Total: {{ Cart::getTotal() }} jd</span>
            </div>
            <div>
                <label class="inline-block mb-3 text-sm font-medium uppercase">Shipping - {{ $shipping }}</label>

            </div>


            <div class="mt-8 border-t">
                <div class="flex justify-between py-6 text-sm font-semibold uppercase">
                    <span>Total cost</span>
                    <span>{{Cart::getTotal() +2}} jd</span>
                </div>
                @if(empty($cartItems))
                    @livewire('modal')
                @else
                <a href="/check-out">
                    <div class="py-3 text-sm font-semibold text-center text-white uppercase bg-indigo-500 xl:w-full hover:bg-indigo-600">Checkout</div>
                </a>
                @endif
            </div>
        </div>

    </div>
</div>

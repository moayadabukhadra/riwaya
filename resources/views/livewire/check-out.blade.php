<div class="grid h-screen grid-cols-3 mb-48">
    <div class="col-span-3 px-12 mt-20 space-y-8 bg-white lg:col-span-2">
        <div class="relative flex flex-col p-4 mt-8 bg-white rounded-md shadow sm:flex-row sm:items-center">
            <div class="flex flex-row items-center w-full pb-4 border-b sm:border-b-0 sm:w-auto sm:pb-0">
                <div class="text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3 text-sm font-medium">Checkout</div>
            </div>
            <div class="mt-4 text-sm tracking-wide text-gray-500 sm:mt-0 sm:ml-4">Complete your shipping and details below.</div>
            <div class="absolute ml-auto text-gray-400 cursor-pointer sm:relative sm:top-auto sm:right-auto right-4 top-4 hover:text-gray-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        </div>
        <div class="rounded-md">
            <form method="POST" action="/check-out">
                @csrf
                <section>
                    <h2 class="my-2 text-lg font-semibold tracking-wide text-gray-700 uppercase">Shipping Information</h2>
                    <fieldset class="mb-3 text-gray-600 bg-white rounded shadow-lg">
                        <label class="flex items-center h-12 py-3 border-b border-gray-200">
                            <span class="px-2 text-right">Name</span>
                            <input name="name" class="px-3 focus:outline-none" placeholder="name">
                        </label>
                        <label class="flex items-center h-12 py-3 border-b border-gray-200">
                            <span class="px-2 text-right">Phone Number</span>
                            <input name="phone" type="phone" class="px-3 focus:outline-none" placeholder="07xxxxxxxx">
                        </label>
                        <label class="flex items-center h-12 py-3 border-b border-gray-200">
                            <span class="px-2 text-right">Email</span>
                            <input name="email" type="email" class="px-3 focus:outline-none" placeholder="try@example.com">
                        </label>
                        <label class="flex items-center h-12 py-3 border-b border-gray-200">
                            <span class="px-2 text-right">Address</span>
                            <input name="address" class="px-3 focus:outline-none" placeholder="10 Street XYZ 654">
                        </label>
                        <label class="flex items-center h-12 py-3 border-b border-gray-200">
                            <span class="px-2 text-right">City</span>
                            <input name="city" class="px-3 focus:outline-none" placeholder="Amman">
                        </label>

                            <span class="px-2 text-right">Notes</span>
                            <textarea name="coustomer_note" class="w-full mt-3 focus:outline-none" placeholder="Notes"></textarea>

                    </fieldset>
                </section>
                <button class="w-full px-4 py-3 text-xl font-semibold text-white transition-colors bg-blue-400 rounded-full submit-button focus:ring focus:outline-none hover:bg-blue-700" type="submit">
            Order
        </button>
            </form>
        </div>


    </div>
    <div class="hidden col-span-1 bg-white lg:block">
        <h1 class="px-8 py-6 text-xl text-gray-600 border-b-2">Order Summary</h1>
        <ul class="px-8 py-6 space-y-6 border-b">
            @foreach($cartItems as $item)
            @livewire('cart-item', ['item' => $item])
            @endforeach
        </ul>
        <div class="px-8 border-b">
            <div class="flex justify-between py-4 text-gray-600">
                <span>Subtotal</span>
                <span class="font-semibold text-pink-500">{{Cart::getTotal()}} jd</span>
            </div>
            <div class="flex justify-between py-4 text-gray-600">
                <span>Shipping</span>
                <span class="font-semibold text-pink-500">2jd</span>
            </div>
        </div>
        <div class="flex justify-between px-8 py-8 text-xl font-semibold text-gray-600">
            <span>Total</span>
            <span>{{Cart::getTotal() +2}} jd</span>
        </div>
    </div>
</div>

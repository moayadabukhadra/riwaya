@if(auth()->check())
<div class="flex flex-wrap place-items-center">
    <section class="relative mx-auto">
        <!-- navbar -->
        <nav class="flex justify-between w-screen text-white bg-gray-900">
            <div class="flex items-center w-full px-5 py-6 xl:px-12">
                <a class="text-3xl font-bold font-heading" href="#">
                    <!-- <img class="h-9" src="logo.png" alt="logo"> -->
                    Riwaya
                </a>
                <!-- Nav Links -->
                <ul class="px-4 mx-auto space-x-12 font-semibold md:flex font-heading sm:flex sm:text-xs">
                    <li><a class="hover:text-gray-200" href="/dashboard">Home</a></li>
                    <li><a class="hover:text-gray-200" href="#">My Orders</a></li>
                    <li><a class="hover:text-gray-200" href="#">English Books</a></li>
                    <li><a class="hover:text-gray-200" href="#">Arabic Books</a></li>
                </ul>
                <!-- Search Form -->

                <div class="relative ">
                    <input type="search" id="search-dropdown" class="rounded-xl block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search " wire:model="searchTerm">
                    <button class="absolute right-0 top-0 p-2.5 z-20 text-sm text-gray-900 bg-gray-50 rounded-l-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" wire:click.prevent="search()">
                        <svg class="w-4 h-5 " fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <!-- logout -->
                <button class="flex items-center justify-center px-5 py-6 text-sm font-semibold text-white bg-gray-900 rounded-full xl:px-12 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500" wire:click.prevent="logout">
                   <p class="text-white">Logout</p>
                </button>

                <!-- Header Icons -->
                <div class="items-center space-x-5 xl:flex xl:ml-36">

                    <a class="flex items-center hover:text-gray-200" href="/shopping-cart">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="absolute flex ml-4 -mt-5">

                            <span class="absolute inline-flex w-3 h-3 text-pink-400 rounded-full opacity-75 animate-ping"></span>
                            <span class="relative inline-flex w-3 h-3 text-pink-500 rounded-full"> {{ Cart::getTotalQuantity() }}
                            </span>
                        </span>
                    </a>



                </div>
            </div>

        </nav>

    </section>
</div>



@else
<div class="flex flex-wrap place-items-center">
    <section class="relative mx-auto">
        <!-- navbar -->
        <nav class="flex justify-between w-screen text-white bg-gray-900">
            <div class="flex items-center w-full px-5 py-6 xl:px-12">
                <a class="text-3xl font-bold font-heading" href="/">
                    <!-- <img class="h-9" src="logo.png" alt="logo"> -->
                    Riwaya - رواية
                </a>
                <!-- Nav Links -->
                <ul class="px-4 mx-auto space-x-12 font-semibold md:flex font-heading sm:flex">

                    <li><a class="hover:text-gray-200" href="login-register">Login</a></li>
                    <li><a class="hover:text-gray-200" href="login-register">Register</a></li>

                </ul>
                <!-- Search Form -->

                <div class="relative ">
                    <input type="search" id="search-dropdown" class="rounded-xl block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search " wire:model="searchTerm">
                    <button class="absolute right-0 top-0 p-2.5 z-20 text-sm text-gray-900 bg-gray-50 rounded-l-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" wire:click.prevent="search()">
                        <svg class="w-4 h-5 " fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>


            </div>

        </nav>

    </section>
</div>

@endif

@props(['name'])

<div class="d-flex gap-3 flex-column container mt-5">
    <div>
        <h2 class="font-semibold text-gray-600">{{ $name }}</h2>
    </div>
    <div class="flex items-center p-2 rounded-md bg-gray-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20"
             fill="currentColor">
            <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"/>
        </svg>
        <input class="block ml-1 outline-none bg-gray-50 form-control " type="search" name="" id=""
               placeholder="search..."
               wire:model="searchTerm">
    </div>
    <div class="d-flex gap-3 justify-content-around flex-wrap ">


        <a href="/dashboard"
           class="btn btn-outline-dark  d-flex align-items-center justify-content-center ">Books</a>
        <a href="/orders" class="btn btn-outline-dark d-flex align-items-center justify-content-center">Orders</a>
        <a href="/categories"
           class="btn btn-outline-dark  d-flex align-items-center justify-content-center ">Categories</a>
        <a href="/create-book"
           class="btn btn-outline-dark  d-flex align-items-center justify-content-center ">Create
            Book</a>
    </div>
</div>

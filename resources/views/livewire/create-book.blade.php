<x-layout>

    <div class="p-5 text-center card-body shadow-5">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>
        <div class="container items-center px-5 py-12 lg:px-20">
            <form class="flex flex-col w-full p-10 px-8 pt-6 mx-auto my-6 mb-4 transition duration-500 ease-in-out transform bg-white border rounded-lg lg:w-1/2 " method="POST" action="/create-book" enctype="multipart/form-data">
                @csrf
                <section class="flex flex-col w-full h-full p-1 overflow-auto">
                    <label for="name" class="mb-5 text-base leading-7 text-blueGray-500">Input Image</label>
                    <header class="flex flex-col items-center justify-center py-12 text-base transition duration-500 ease-in-out transform bg-white border border-dashed rounded-lg text-blueGray-500 focus:border-blue-500 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
                        <p class="flex flex-wrap justify-center mb-3 text-base leading-7 text-blueGray-500">
                            <span>Drag and drop your</span> <span>files anywhere or</span>
                        </p>
                        <input class="w-auto px-2 py-1 my-2 mr-2 transition duration-500 ease-in-out transform border rounded-md text-blueGray-500 hover:text-blueGray-600 text-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-gray-100" type="file" name="image" />
                        @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                    </header>
                </section>
                <!-- category select-->
                <select class="form-control" name="category_id">
                    <option value="" selected>Choose category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category') <span class="text-danger error">{{ $message }}</span>@enderror

                <div class="relative pt-4">
                    <label for="name" class="text-base leading-7 text-blueGray-500">Book Title</label>
                    <input type="text" name="title" placeholder="title" class="w-full px-4 py-2 mt-2 mr-4 text-base text-black transition duration-500 ease-in-out transform bg-gray-100 rounded-lg focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="relative pt-4">
                    <label for="name" class="text-base leading-7 text-blueGray-500">Author Name</label>
                    <input type="text" name="author" placeholder="name" class="w-full px-4 py-2 mt-2 mr-4 text-base text-black transition duration-500 ease-in-out transform bg-gray-100 rounded-lg focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
                    @error('author') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="relative pt-4">
                    <label for="name" class="text-base leading-7 text-blueGray-500">Price</label>
                    <input type="number" name="price" placeholder="price" class="w-full px-4 py-2 mt-2 mr-4 text-base text-black transition duration-500 ease-in-out transform bg-gray-100 rounded-lg focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
                    @error('price') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="flex flex-wrap mt-4 mb-6 -mx-3">
                    <div class="w-full px-3">
                        <label class="text-base leading-7 text-blueGray-500" for="description">description </label>
                        <textarea class="w-full h-32 px-4 py-2 mt-2 text-base transition duration-500 ease-in-out transform bg-white border rounded-lg text-blueGray-500 focus:border-blue-500 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 apearance-none autoexpand" type="text" name="description" placeholder="description"></textarea>
                        @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="flex items-center w-full pt-4 mb-4">
                    <button class="w-full py-3 text-base text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800" type="submit"> Create </button>

                </div>

            </form>
        </div>
    </div>

</x-layout>

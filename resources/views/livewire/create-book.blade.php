<x-layout>
@livewire('nav')
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
                        <input class="w-auto px-2 py-1 my-2 mr-2 transition duration-500 ease-in-out transform border rounded-md text-blueGray-500 hover:text-blueGray-600 text-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-gray-100" type="text" name="image" />
                        @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                    </header>
                </section>
                <div class="relative pt-4">
                    <label for="name" class="text-base leading-7 text-blueGray-500">Price</label>
                    <input type="number" name="price" placeholder="price" class="w-full px-4 py-2 mt-2 mr-4 text-base text-black transition duration-500 ease-in-out transform bg-gray-100 rounded-lg focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
                    @error('price') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link bg-aqua-active" href="#" id="english-link">EN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="arabic-link">ar</a>
                    </li>
                </ul>
                <div class="card-body" id="english-form">
                    <div class="form-group">
                        <label class="required" for="en_title">title (EN)</label>
                        <input class="form-control {{ $errors->has('en_title') ? 'is-invalid' : '' }}" type="text" name="en_title" id="en_title" value="{{ old('en_title', '') }}" required>
                        @if($errors->has('en_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('en_title') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="en_author">author (EN)</label>
                        <textarea class="form-control {{ $errors->has('en_author') ? 'is-invalid' : '' }}" name="en_author" id="en_author">{{ old('en_author') }}</textarea>
                        @if($errors->has('en_author'))
                        <div class="invalid-feedback">
                            {{ $errors->first('en_author') }}
                        </div>
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="en_description">description (EN)</label>
                        <textarea class="form-control {{ $errors->has('en_description') ? 'is-invalid' : '' }}" name="en_description" id="en_description">{{ old('en_description') }}</textarea>
                        @if($errors->has('en_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('en_description') }}
                        </div>
                        @endif

                    </div>

                </div>

                <div class="card-body d-none" id="arabic-form">
                    <div class="form-group">
                        <label class="required" for="title">title (ar)</label>
                        <input class="form-control {{ $errors->has('ar_title') ? 'is-invalid' : '' }}" type="text" name="ar_title" id="ar_title" value="{{ old('ar_title', '') }}" required>
                        @if($errors->has('ar_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ar_title') }}
                        </div>
                        @endif

                    </div>





                    <div class="form-group">
                        <label for="ar_author">author (ar)</label>
                        <textarea class="form-control {{ $errors->has('ar_author') ? 'is-invalid' : '' }}" name="ar_author" id="ar_author">{{ old('ar_author') }}</textarea>
                        @if($errors->has('ar_author'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ar_author') }}
                        </div>
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="ar_description">description (EN)</label>
                        <textarea class="form-control {{ $errors->has('ar_description') ? 'is-invalid' : '' }}" name="ar_description" id="ar_description">{{ old('ar_description') }}</textarea>
                        @if($errors->has('ar_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ar_description') }}
                        </div>
                        @endif

                    </div>
                </div>


                <div class="flex items-center w-full pt-4 mb-4">
                    <button class="w-full py-3 text-base text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800" type="submit"> Create </button>

                </div>

            </form>
        </div>
    </div>

    <script>
        var $englishForm = $('#english-form');
        var $arabicForm = $('#arabic-form');
        var $englishLink = $('#english-link');
        var $arabicLink = $('#arabic-link');

        $englishLink.click(function() {
            $englishLink.toggleClass('bg-aqua-active');
            $englishForm.toggleClass('d-none');
            $arabicLink.toggleClass('bg-aqua-active');
            $arabicForm.toggleClass('d-none');
        });

        $arabicLink.click(function() {
            $englishLink.toggleClass('bg-aqua-active');
            $englishForm.toggleClass('d-none');
            $arabicLink.toggleClass('bg-aqua-active');
            $arabicForm.toggleClass('d-none');
        });
    </script>
</x-layout>

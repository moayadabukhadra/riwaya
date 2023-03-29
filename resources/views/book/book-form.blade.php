@extends('layouts.layout')
@section('content')
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <h3 class="text-white fw-bolder fs-2qx me-5">{{ $book ? 'تعديل' : 'اضافة' }} كتاب</h3>
            <div class="d-flex align-items-center flex-wrap py-2">
                <div id="kt_header_search" class="d-flex align-items-center w-200px w-lg-250px my-2 me-4 me-lg-6"
                     data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter"
                     data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-permanent="true"
                     data-kt-menu-placement="bottom-end">
                </div>
            </div>
        </div>
    </div>
    <div class="card card-page container">
        <div class="card-body">
            <div class="row gy-5 g-xl-8">
                <div class="col-xxl-6">
                    <div class="card card-xxl-stretch">
                        <div class="card-header border-0 pt-5 pb-3">
                            <h3 class="card-title fw-bolder text-gray-800 fs-2">{{ $book ? 'تعديل' : 'اضافة' }}
                                كتاب</h3>
                        </div>
                        <div class="card-body py-0">
                            <form method="POST" action="{{ route('book.store',['book'=>$book?->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="image-input">
                                    <label class=" image-input-edit">
                                        <i class="fa fa-edit text-white"></i>
                                        <input type="file" hidden name="image" class="input-image">
                                    </label>
                                    <div class="image-input-preview"
                                         style="background-image:url({{ $book?->image ? "riwaya/storage/app/public/images/" . $book->image->path : 'assets/images/placeholder.jpg' }})">
                                    </div>
                                    <label class="image-input-delete">
                                        <i class="fa fa-times text-white"></i>
                                        <input type="checkbox" hidden name="remove_image">
                                    </label>
                                </div>

                                <div class="form-group mb-5">
                                    <input name="title" type="text" class="form-control form-control-solid"
                                           value="{{ $book?->title ?? old('title') }}"
                                           placeholder="العنوان">
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-5">
                                    <select class="form-select fw-bold" data-control="select2" name="author_id"
                                            data-placeholder="المؤلف" data-hide-search="false">
                                        <option value="{{ null }}"></option>
                                        @foreach($authors as $author)
                                            <option
                                                @if($book && $book->author?->id == $author->id)
                                                    selected
                                                @endif
                                                value="{{$author->id}}">{{$author->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('author_id') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="mb-5">
                                    <select class="form-select fw-bold" data-control="select2" name="category_id"
                                            data-placeholder="التصنيف" data-hide-search="false">
                                        <option value="{{ null }}"></option>
                                        @foreach($categories as $category)
                                            <option
                                                @if($book && $book->category?->id == $category->id)
                                                    selected
                                                @endif
                                                value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-group mb-5">
                                    <input name="publisher" type="text" class="form-control form-control-solid"
                                           value="{{ $book?->publisher ?? old('publisher') }}"
                                           placeholder="الناشر">
                                </div>
                                @error('publisher') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-group mb-5">
                                    <input name="published_date" type="date" class="form-control form-control-solid"
                                           value="{{ $book?->published_date ?? old('published_date') }}"
                                           placeholder="تاريخ النشر">
                                </div>
                                @error('published_date') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-group mb-5">
                                    <input name="page_count" type="text" class="form-control form-control-solid"
                                           value="{{ $book?->page_count ?? old('page_count') }}"
                                           placeholder="عدد الصفحات">
                                </div>
                                @error('page_count') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-group mb-5">
                                    <input name="price" type="text" class="form-control form-control-solid"
                                           value="{{ $book?->page_count ?? old('price') }}"
                                           placeholder="السعر">
                                </div>
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-group mb-5">
                                    <textarea class="editor" name="description">
                                        {{ $book?->description ?? old('description')}}
                                    </textarea>
                                </div>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-group">
                                    <label class="btn btn-info d-flex align-items-center justify-content-center gap-1">
                                        <i class="fa fa-file-upload"></i>
                                        <span>اضافة ملف</span>
                                        <input type="file" class="d-none" name="book_file">
                                    </label>
                                </div>
                                @error('book_file') <span class="text-danger">{{ $message }}</span> @enderror
                                <button class="btn btn-primary float-start mb-4">
                                    {{ $book ? 'تعديل' : 'حفظ' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('.editor'), {
                language: '{{ app()->getLocale() }}'
            })

        $('input[name="image"]').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-input-preview').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('input[name="remove_image"]').on('change', function () {
            $('.image-input-preview').css('background-image', 'url(assets/images/placeholder.jpg)');
        });

    </script>
@endpush

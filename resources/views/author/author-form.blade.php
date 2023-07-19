@extends('layouts.layout')
@section('content')
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <h3 class="text-white fw-bolder fs-2qx me-5">{{ $author ? 'تعديل' : 'اضافة' }} مؤلف</h3>
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
                    <div class="card card-xxl-stretch">
                        <div class="card-body py-0">
                            <form method="POST" action="{{ route('author.store',['author'=>$author?->id]) }}"  enctype="multipart/form-data">
                                @csrf
                                <div class="image-input">
                                    <label class=" image-input-edit">
                                        <i class="fa fa-edit text-white"></i>
                                        <input type="file" hidden name="image" class="input-image">
                                    </label>
                                    <div class="image-input-preview"
                                         style="background-image:url({{ $author?->image ? "riwaya/storage/app/public/images/" . $author->image->path : '/assets/images/placeholder.jpg' }})">
                                    </div>
                                    <label class="image-input-delete">
                                        <i class="fa fa-times text-white"></i>
                                        <input type="checkbox" hidden name="remove_image">
                                    </label>
                                </div>

                                <div class="form-group mb-5">
                                    <input name="name" type="text" class="form-control form-control-solid"
                                           value="{{ $author?->name ?? old('name') }}"
                                           placeholder="الاسم">
                                </div>
                                <div class="form-group mb-5">
                                    <input name="country" type="text" class="form-control form-control-solid"
                                           value="{{ $author?->country ?? old('country') }}"
                                           placeholder="الدولة">
                                </div>
                                <div class="form-group mb-5">
                                    <textarea class="editor" name="bio">
                                        {{ $author?->bio ?? old('bio')}}
                                    </textarea>
                                </div>
                                <button class="btn btn-primary float-start mb-4">
                                    {{ $author ? 'تعديل' : 'حفظ' }}
                                </button>
                            </form>
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

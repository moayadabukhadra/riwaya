@extends('layouts.layout')
@section('content')
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <h3 class="text-white fw-bolder fs-2qx me-5">{{ $quote ? 'تعديل' : 'اضافة' }} تصنيف</h3>
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
                        <div class="card-body py-0">
                            <form method="POST" action="{{ route('quote.store',['quote'=>$quote?->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="my-5">
                                    <select class="form-select fw-bold" data-control="select2" name="author_id"
                                            data-placeholder="المؤلف" data-hide-search="false">
                                        <option value="{{ null }}">حميع المؤلفين</option>
                                        @foreach($authors as $author)
                                            <option
                                                @if($quote?->author_id == $author->id) selected @endif
                                            value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-5">
                                    <textarea class="editor" name="body">
                                        {{ $quote?->body ?? old('body') }}
                                    </textarea>
                                </div>
                                <button class="btn btn-primary float-start mb-4">
                                    {{ $quote ? 'تعديل' : 'حفظ' }}
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



    </script>
@endpush

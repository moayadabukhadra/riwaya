<div>
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <h3 class="text-white fw-bolder fs-2qx me-5">التصنيفات</h3>
            <div class="d-flex align-items-center flex-wrap py-2">
                <div id="kt_header_search" class="d-flex align-items-center w-200px w-lg-250px my-2 me-4 me-lg-6"
                     data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter"
                     data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-permanent="true"
                     data-kt-menu-placement="bottom-end">
                    <form data-kt-search-element="form" class="search w-100 position-relative" autocomplete="off">
                        <input type="hidden"/>
                        <span
                            class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-white position-absolute start-0 top-50 translate-middle-y">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                      rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"/>
												<path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black"/>
											</svg>
										</span>
                        <input type="text" class="form-control ps-15" name="search" value=""
                               placeholder="البحث في التصنيفات..." wire:model="query"
                        />
                    </form>
                </div>
                <a href="{{ route('category.show') }}" class="btn btn-primary my-2 me-2">
                    <i class="fa fa-plus-circle"></i>
                    إضافة تصنيف
                </a>
            </div>
        </div>
    </div>
    <div class="card card-page">
        <div class="card-body">
            <div class="row gy-5 g-xl-8">
                    <div class="card card-xxl-stretch">
                        <div class="card-header border-0 pt-5 pb-3">
                        </div>
                        <div class="card-body py-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered table-row-dashed gy-5"
                                       id="kt_table_widget_1">
                                    <thead>
                                    <tr class="text-gray-400 fw-boldest fs-7" >
                                        <th >الاسم</th>
                                        <th colspan="2" class="text-center">الخيارات</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="p-0">
                                                <div class="d-flex align-items-center">
                                                    <img alt="" class="w-50px"
                                                         src="{{ "storage/images/" . $category->image?->path }}"/>
                                                    <div class="ps-3 fw-bold me-1">
                                                        {{ $category->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-flex align-items-center justify-content-center gap-1">
                                                <a href="{{ route('category.show',['category'=>$category->id]) }}"
                                                   class="btn btn-success d-flex align-items-center justify-content-center gap-1">
                                                    <i class="fa fa-edit p-0"></i>
                                                   <span class="d-none d-md-block">تعديل</span>
                                                </a>
                                                <button wire:click="deleteCategory({{$category->id}})" class="btn btn-danger d-flex align-items-center justify-content-center gap-1">
                                                    <i class="fa fa-trash p-0"></i>
                                                   <span class="d-none d-md-block">حذف</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{ $categories->links() }}
                    </div>

            </div>
        </div>
    </div>

</div>

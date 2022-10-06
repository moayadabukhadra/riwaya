<div class="container">
    <x-admin.admin-nav name="Categories"/>

    <button type="button" class="btn btn-outline-primary fw-bold d-flex align-items-center gap-2 px-4 m-3"
            data-bs-toggle="modal"
            data-bs-target="#categoryModal">{{ __('Add') . " " . __
        ('Category')}}<i class="bi bi-plus-circle-fill"></i></button>


    <table class="table text-center">
        <thead class="table-dark">
        <tr>
            <th scope="col">delete</th>
            <th scope="col">description</th>
            <th scope="col">name</th>
            <th scope="col">#</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    <div class="d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-outline-danger fw-bold d-flex align-items-center"
                                wire:click.prevent="delete({{ $category->category_id }})"><i
                                class="bi bi-trash"></i>{{ __('Delete') }}</button>
                    </div>
                </td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->name }}</td>
                <th scope="row">{{ $loop->iteration }}</th>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">{{   __('Add') . " ". __('Category') }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex gap-2 flex-column">
                        <div class="d-flex justify-content-between flex-column">
                            <h3>English</h3>
                            <div class="form-group">
                                <input wire:model="en_name" name="en_name" placeholder="name" class="form-control">
                                @error('en_name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input wire:model="en_description" name="en_description" placeholder="description"
                                       class="form-control">
                                @error('en_description') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between flex-column">
                            <h3 class="text-right">عربي</h3>
                            <div class="form-group">
                                <input type="text" name="ar_name" wire:model="ar_name" placeholder="الاسم"
                                       class="form-control text-right">
                                @error('ar_name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group ">
                                <input type="text" name="ar_description" wire:model="ar_description" placeholder="الوصف"
                                       class="form-control text-right">
                                @error('ar_description') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button class="btn btn-outline-dark fw-bold" wire:click.prevent="store"
                    >{{ __('Add') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>



@if($dropDown == 'category')
<div class="mt-8 form-group row">
    <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>
    <div class="col-md-6">
        <select class="form-control">
            <option value="" >Choose category</option>
            @foreach($categories as $category)
            <button value="$category" wire:click.prevent="SelectCategory({{ $category }})"><option> {{ $category->name }} </option></button>
            @endforeach
        </select>
    </div>
</div>
@else
<div></div>
@endif

<div class="modal-header">
    <h5 class="modal-title" id="add">@lang('lang.add')</h5>
    <button class="btn btn-primary btn-close" type="button" data-dismiss="modal" aria-label="Close"
            data-bs-original-title="" title=""></button>
</div>
<form action="{{route('something.store')}}" method="post">
    @csrf
<div class="modal-body">
<div class="form-group">
    <div class="col-form-label"> Name</div>
    <input type="text" class="form-control" name="name">
</div>
    <div class="form-group">
        <div class="col-form-label"> Category</div>
        <select name="category_id">
            @foreach(\App\Models\Category::get(['id', 'name']) as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <div class="col-form-label"> Subcategory</div>
        <select name="subcategory_id" multiple>
            @foreach(\App\Models\SubCategory::get(['id', 'name']) as $subcategory)
                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-danger" type="button" data-dismiss="modal" data-bs-original-title=""
            title="">close</button>
    <button type="button" class="btn btn-primary store-something">Store Something</button>
</div>
</form>

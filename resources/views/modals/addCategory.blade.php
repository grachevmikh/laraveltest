<div class="modal-header">
    <h5 class="modal-title" id="add">@lang('lang.add')</h5>
    <button class="btn btn-primary btn-close" type="button" data-dismiss="modal" aria-label="Close"
            data-bs-original-title="" title=""></button>
</div>
<form action="{{route('category.store')}}" method="post">
    @csrf
<div class="modal-body">
<div class="form-group">
    <div class="col-form-label"> Name</div>
    <input type="text" class="form-control" name="name">
</div>
</div>
<div class="modal-footer">
    <button class="btn btn-danger" type="button" data-dismiss="modal" data-bs-original-title=""
            title="">close</button>
    <button type="button" class="btn btn-primary store-category">Store Category</button>
</div>
</form>

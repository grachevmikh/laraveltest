<div class="modal-header">
    <h5 class="modal-title" id="add">Add</h5>
    <button class="btn btn-primary btn-close" type="button" data-dismiss="modal" aria-label="Close"
            data-bs-original-title="" title="">&times;</button>
</div>
<form action="{{route('subCategory.store')}}" method="post">
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
        <button type="button" class="btn btn-primary store-subCategory">Store SubCategory</button>
    </div>
</form>

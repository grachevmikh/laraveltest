<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>PoliLingua</title>
</head>
<body>

<section class="section-content bg border-top">
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status.msg') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-6 mt-5">
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" id="add-category" class="btn btn-primary mr-2"> Add category</button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table center" id="categories">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <th scope="row">{{++ $key}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <button type="button" data-url="{{route('category.edit', $category->id)}}" class="btn btn-success edit-category">Edit</button>
                                        <button type="button" data-url="{{route('category.destroy', $category->id)}}" class="btn btn-danger destroy-category">Destroy</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-5">
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" id="add-subCategory" class="btn btn-primary"> Add subCategory</button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table center" id="subCategory">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">SubCategory</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subCategories as $key => $subCategory)
                                <tr>
                                    <th scope="row">{{++ $key}}</th>
                                    <td>{{$subCategory->name}}</td>
                                    <td>
                                        <button type="button" data-url="{{route('subCategory.edit', $subCategory->id)}}" class="btn btn-success edit-subCategory">Edit</button>
                                        <button type="button" data-url="{{route('subCategory.destroy', $subCategory->id)}}" class="btn btn-danger destroy-subCategory">Destroy</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" id="add-something" class="btn btn-primary mr-2"> Add Somethings with cat and subCat</button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table center" id="something">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">SubCategory</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($somethings as $key => $something)
                                    <tr>
                                        <th scope="row">{{++ $key}}</th>
                                        <td>{{$something->name}}</td>
                                        <td>{{\App\Models\Category::find($something->category_id)->name}}</td>
                                        <td>
                                            @php
                                              $imp = $something->subCategory()->pluck('subcategory_id')->map(function ($item,$key){
                                                    return \App\Models\SubCategory::find($item)->name;
                                                })->toArray();
                                                echo implode('<br>', $imp);
                                            @endphp
                                        </td>
                                        <td>
                                            <button type="button" data-url="{{route('something.edit', $something->id)}}" class="btn btn-success edit-something">Edit</button>
                                            <button type="button" data-url="{{route('something.edit', $something->id)}}" class="btn btn-danger destroy-something">Destroy</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script>
    $(function () {
        $('body').on('click', '#add-category', function (){
            $.ajax({
                url: '{{route('category.create')}}',
                method: 'get',
                dataType: 'html',
            }).done((result) => {
                $('#modal').find('.modal-content').html(result);
                $('#modal').modal('show');
            })
        }).on('click', '.store-category', function (){
            let form = $(this).closest('form'),
                fd = new FormData($(this).closest('form')[0]);
            fd.append('_token', $('meta[name=_token]').attr('content'));
            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: fd,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(() => {
                $("#categories").load(" #categories");
                $('#modal').modal('hide');
            })
        }).on('click', '.edit-category', function () {
            $.ajax({
                url: $(this).attr('data-url'),
                method: 'get',
                dataType: 'html',
            }).done((result) => {
                $('#modal').find('.modal-content').html(result);
                $('#modal').modal('show');
            })
        }).on('click', '.update-category', function () {
            let form = $(this).closest('form'),
                fd = new FormData($(this).closest('form')[0]);
            fd.append('_token', $('meta[name=_token]').attr('content'));
            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: fd,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done((result) => {
                $("#category").load(" #category");
                $('#modal').modal('hide');
            })
        }).on('click', '.destroy-category', function () {
            let self = $(this);
            swal({
                title: 'delete',
                text: 'are you sure?',
                icon: "error",
                buttons: [
                    'exit',
                    'delete'
                ],
                dangerMode: true,
            }).then(function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: self.attr('data-url'),
                        method: 'delete',
                        data: {_token: $('meta[name=_token]').attr('content')}
                    }).done(() => {
                        $("#category").load(" #category");
                    });
                }
            })
        }).on('click', '#add-subCategory', function (){
            $.ajax({
                url: '{{route('subCategory.create')}}',
                method: 'get',
                dataType: 'html',
            }).done((result) => {
                $('#modal').find('.modal-content').html(result);
                $('#modal').modal('show');
            })
        }).on('click', '.store-subCategory', function (){
            let form = $(this).closest('form'),
                fd = new FormData($(this).closest('form')[0]);
            fd.append('_token', $('meta[name=_token]').attr('content'));
            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: fd,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(() => {
                $("#subCategory").load(" #subCategory");
                $('#modal').modal('hide');
            })
        }).on('click', '.edit-subCategory', function () {
            $.ajax({
                url: $(this).attr('data-url'),
                method: 'get',
                dataType: 'html',
            }).done((result) => {
                $('#modal').find('.modal-content').html(result);
                $('#modal').modal('show');
            })
        }).on('click', '.update-subCategory', function () {
            let form = $(this).closest('form'),
                fd = new FormData($(this).closest('form')[0]);
            fd.append('_token', $('meta[name=_token]').attr('content'));
            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: fd,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done((result) => {
                $("#subCategory").load(" #subCategory");
                $('#modal').modal('hide');
            })
        }).on('click', '.destroy-subCategory', function () {
            let self = $(this);
            swal({
                title: 'delete',
                text: 'are you sure?',
                icon: "error",
                buttons: [
                    'exit',
                    'delete'
                ],
                dangerMode: true,
            }).then(function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: self.attr('data-url'),
                        method: 'delete',
                        data: {_token: $('meta[name=_token]').attr('content')}
                    }).done(() => {
                        $("#subCategory").load(" #subCategory");
                    });
                }
            })
        }).on('click', '#add-something', function (){
            $.ajax({
                url: '{{route('something.create')}}',
                method: 'get',
                dataType: 'html',
            }).done((result) => {
                $('#modal').find('.modal-content').html(result);
                $('#modal').modal('show');
            })
        }).on('click', '.store-something', function (){
            let form = $(this).closest('form'),
                fd = new FormData($(this).closest('form')[0]);
            fd.append('_token', $('meta[name=_token]').attr('content'));
            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: fd,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(() => {
                $("#something").load(" #something");
                $('#modal').modal('hide');
            })
        }).on('click', '.edit-something', function () {
            $.ajax({
                url: $(this).attr('data-url'),
                method: 'get',
                dataType: 'html',
            }).done((result) => {
                $('#modal').find('.modal-content').html(result);
                $('#modal').modal('show');
            })
        }).on('click', '.update-something', function () {
            let form = $(this).closest('form'),
                fd = new FormData($(this).closest('form')[0]);
            fd.append('_token', $('meta[name=_token]').attr('content'));
            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: fd,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done((result) => {
                $("#something").load(" #something");
                $('#modal').modal('hide');
            })
        }).on('click', '.destroy-something', function () {
            let self = $(this);
            swal({
                title: 'delete',
                text: 'are you sure?',
                icon: "error",
                buttons: [
                    'exit',
                    'delete'
                ],
                dangerMode: true,
            }).then(function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: self.attr('data-url'),
                        method: 'delete',
                        data: {_token: $('meta[name=_token]').attr('content')}
                    }).done(() => {
                        $("#something").load(" #something");
                    });
                }
            })
        })
    })
</script>
</body>
</html>

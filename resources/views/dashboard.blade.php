<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/jspanel4@4.15.0/dist/jspanel.css" rel="stylesheet">
    <!-- jsPanel JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.15.0/dist/jspanel.js"></script>

    <!-- optional jsPanel extensions -->
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.15.0/dist/extensions/modal/jspanel.modal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.15.0/dist/extensions/tooltip/jspanel.tooltip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.15.0/dist/extensions/hint/jspanel.hint.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.15.0/dist/extensions/layout/jspanel.layout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.15.0/dist/extensions/contextmenu/jspanel.contextmenu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.15.0/dist/extensions/dock/jspanel.dock.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Management</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#editTabs" type="button" role="tab" aria-controls="contact" aria-selected="false" style="display: none">Edit</button>
                </li>
            </ul>
            <div class="tab-content " id="myTabContent">

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Article</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="recipient-title" class="col-form-label">Title:</label>
                                        <input type="text" name="title" class="form-control" id="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description-text" class="col-form-label">Description:</label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                    <label for="categories">Category:</label>
                                    <select class="categories" name="categories" id="categoriesModal" style="width: 100%">
                                        @foreach($categories as $category)
                                            <option value='{{ $category->id }}'>{{ $category->title }}</option>
                                        @endforeach
                                    </select><br><br>
                                    <label for="tags">Tags:</label>
                                    <select class="tags" name="tags[]" id="tagsModal" style="width: 100%" multiple="multiple">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="article_id" id="article_id">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="btn_save1">Save Data</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th width="105px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="/create" method="post" class="registrationForm">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <lable>Title</lable>
                                <input type="text" name="title" placeholder="Title" class="form-control">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <lable>Description</lable>
                            <input type="text" name="description" placeholder="Description">
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row">
                            <lable>Tags</lable>
                            <select class="tags" name="tags[]" style="width: 100%" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <lable>Categories</lable>
                            <select class="categories" name="categories" style="width: 100%">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <lable>Is Active</lable>
                            <select class="isActive" name="isActive" style="width: 100%">
                                <option value="0">no</option>
                                <option value="1">yes</option>
                            </select>
                        </div>
                        <input type="submit" value="submit">
                    </form>
                </div>
                <div class="tab-pane fade" id="editTabs" role="tabpanel" aria-labelledby="editTabs">
                    <form class="registrationForm1" method="post" action="updateArticleData">
                        <div class="mb-3">
                            <label for="recipient-title" class="col-form-label">Title:</label>
                            <input type="text" name="title" class="form-control" id="tab_title">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="description" id="tab_description"></textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="categories">Category:</label>
                        <select class="categories" id="categoriesTab" name="categories" style="width: 100%">
                            @foreach($categories as $category)
                                <option value='{{ $category->id }}'>{{ $category->title }}</option>
                            @endforeach
                        </select><br><br>
                        <label for="tags">Tags:</label>
                        <select class="tags" name="tags[]" id="tagsTab" style="width: 100%" multiple="multiple">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="tab_article_id" id="tab_article_id">
                        <button type="button" class="btn btn-primary" id="btn_save_tabs">Save Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@stack('scripts')

</body>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>.error{color: red;}</style>
<script>

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {


        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'date', name: 'date', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false,
                    mRender: function (data, type, full){
                        var deleteButtumn = '<a href="#" class="btn btn-sm btn-danger deleteUser"  data-id="'+full['id']+'" onclick="jqueryConfirm(this);"><i class="fa-solid fa-trash"></i></a>';
                        var updateJsPanel = '<button type="button" class="btn btn-sm btn-success updateUserJsPanel" data-id="'+full['id']+'">jsPanel</button>';
                        var updateTabs = '<button type="button" class="btn btn-sm btn-success updateUserTabs" data-id="'+full['id']+'"><i class="fa-solid fa-pen-to-square"></i></button>';
                        //var updateUser = '<button type="button" class="btn btn-sm btn-info updateUser" data-id="'+full['id']+'" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><i class="fa-solid fa-pen-to-square"></i></button>';
                        return deleteButtumn+updateJsPanel+updateTabs/*+updateUser*/;
                    }
                },
            ]
        });

        $('.categories').select2();
        $('.tags').select2();



        // Update record data from modal
        $('#home').on('click','.updateUser',function(){
            var id = $(this).data('id');

            $('#article_id').val(id);
            $.ajax({
                url: "{{ route('getArticleData') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                dataType: 'json',
                success: function(response){

                    if(response.success == 1){

                        $('#title').val(response.title);
                        $('#description').val(response.description);

                        changeCategory(response.category);
                        changeTags(response.tag);
                        table.ajax.reload();
                    }else{
                        alert("Invalid ID.");
                    }
                }
            });


        });




        $('#home').on('click','.updateUserJsPanel',function(){
            const panel = jsPanel.create({
                headerTitle: 'My Form Panel',
                contentSize: '400 auto',
                content: `
                <form class="registrationForm2">
                    <label for="title1">Title:</label>
                    <input type="text" id="title1" name="title" required><br><br>

                    <label for="description1">Description:</label>
                    <input type="text" id="description1" name="description" required><br><br>

                    <label for="categories">Category:</label>
                    <select class="categories" name="categories" id="categoriesPanel" style="width: 100%">
                                    @foreach($categories as $category)
                    <option value='{{ $category->id }}'>{{ $category->title }}</option>
                                    @endforeach
                    </select><br><br>
                    <label for="tags">Tags:</label>
                    <select class="tags" name="tags[]" id="tagsPanel" style="width: 100%" multiple="multiple">
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @endforeach
                    </select>
            <input type="hidden" id="article_id1" name="article_id">

            <button type="button" class="btn btn-primary " onclick="saveJsPanel()" id="saveJsPanel">Save Data</button>
        </form> `,
            });
            $('#saveJsPanel').click(function (){
                const title1 = document.getElementById('title1');
                const fieldValue = title1.value;
                if (fieldValue.length < 1) {
                    panel.content.innerHTML = 'Title is Required.';
                }


                const description1 = document.getElementById('description1');
                const fieldValue1 = description1.value;
                if (fieldValue1.length < 1) {
                    panel.content.innerHTML = 'Description is Required.';
                }
                if (fieldValue1.length > 50) {
                    panel.content.innerHTML = 'Maximum Description character is 50.';
                }
                saveJsPanel();
            })

            $('#tags').select2();
            var id = $(this).data('id');

            $('#article_id1').val(id);
            $.ajax({
                url: "{{ route('getArticleData') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                dataType: 'json',
                success: function(response){

                    if(response.success == 1){

                        $('#title1').val(response.title);
                        $('#description1').val(response.description);

                        changeCategory(response.category);
                        changeTags(response.tag);
                        table.ajax.reload();
                    }else{
                        alert("Invalid ID.");
                    }
                }
            });

        });

+
    // Update record data from tabs
    $('#home').on('click','.updateUserTabs',function(){
        var id = $(this).data('id');

        $('#edit-tab').show();
        $('.tab-pane').removeClass('active').removeClass('show');
        $('#editTabs').addClass('active').addClass('show');

        $('.nav-link').removeClass('active');
        $('#edit-tab').addClass('active');

        $('#tab_article_id').val(id);
        $.ajax({
            url: "{{ route('getArticleData') }}",
            type: 'post',
            data: {_token: CSRF_TOKEN,id: id},
            dataType: 'json',
            success: function(response){

                if(response.success == 1){

                    $('#tab_title').val(response.title);
                    $('#tab_description').val(response.description);

                    changeCategory(response.category);
                    changeTags(response.tag);
                    table.ajax.reload();
                }else{
                    alert("Invalid ID.");
                }
            }
        });

    });


        //save and update from modal
        $('#btn_save1').click(function(){
            var id = $('#article_id').val();

            var title = $('#title').val().trim();
            var description = $('#description').val().trim();
            var categories = $('#categoriesModal').val();
            $('#tagsModal').select2();
            var tags = $('#tagsModal').val();


            if(title !='' && description != ''){

                // AJAX request
                $.ajax({
                    url: "{{ route('updateArticleData') }}",
                    type: 'post',
                    data: {_token: CSRF_TOKEN,id: id,title: title, description: description, categories: categories, tags: tags},
                    dataType: 'json',
                    success: function(response){
                        if(response.success == 1){
                            //alert(response.msg);

                            // Empty and reset the values
                            $('#title','#description').val('');


                            // Reload DataTable
                            table.ajax.reload();

                            // Close modal
                            $('#exampleModal').modal('toggle');
                        }else{
                            alert(response.msg);
                        }
                    }
                });

            }else{
                alert('Please fill all fields.');
            }
        });


        //save and update from jsPanel
        $('.btn_save1').click(function(){alert(true);

        });

        //save and update from tabs
        $('#btn_save_tabs').click(function(){
            var id = $('#tab_article_id').val();

            var title = $('#tab_title').val().trim();
            var description = $('#tab_description').val().trim();
            var categories = $('#categoriesTab').val();



            $('#tagsTab').select2();
            var tags = $('#tagsTab').val();

            if(title !='' && description != ''){

                // AJAX request
                $.ajax({
                    url: "{{ route('updateArticleData') }}",
                    type: 'post',
                    data: {_token: CSRF_TOKEN,id: id,title: title, description: description, categories: categories, tags: tags},
                    dataType: 'json',
                    success: function(response){
                        if(response.success == 1){
                            //alert(response.msg);

                            // Empty and reset the values
                            $('#tab_title','#tab_description').val('');


                            // Reload DataTable
                            table.ajax.reload();
                            $('#edit-tab').hide();
                            $('#editTabs').removeClass('active').removeClass('show');
                            $('#home').addClass('active').addClass('show');

                            $('#edit-tab').removeClass('active');
                            $('.nav-link').addClass('active');
                        }else{
                            alert(response.msg);
                        }
                    }
                });

            }else{
                alert('Please fill all fields.');
            }
        });

    });
    function table(){
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'date', name: 'date', orderable: false, searchable: false},
                {
                    data: 'action', name: 'action', orderable: false, searchable: false,
                    mRender: function (data, type, full) {
                        var deleteButtumn = '<a href="#" class="btn btn-sm btn-danger deleteUser"  data-id="' + full['id'] + '" onclick="jqueryConfirm(this);"><i class="fa-solid fa-trash"></i></a>';
                        var updateJsPanel = '<button type="button" class="btn btn-sm btn-success updateUserJsPanel" data-id="' + full['id'] + '">jsPanel</button>';
                        var updateTabs = '<button type="button" class="btn btn-sm btn-success updateUserTabs" data-id="' + full['id'] + '"><i class="fa-solid fa-pen-to-square"></i></button>';
                        //var updateUser = '<button type="button" class="btn btn-sm btn-info updateUser" data-id="' + full['id'] + '" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><i class="fa-solid fa-pen-to-square"></i></button>';
                        return deleteButtumn + updateJsPanel + updateTabs /*+ updateUser*/;
                    }
                }
            ]
        });
        table.ajax.reload();
    }

    function saveJsPanel(){

        var id = $('#article_id1').val();

        var title = $('#title1').val().trim();
        var description = $('#description1').val().trim();
        var categories = $('#categoriesPanel').val();


        $('#tagsPanel').select2();
        var tags = $('#tagsPanel').val();

        if(title !='' && description != ''){

            // AJAX request
            $.ajax({
                url: "{{ route('updateArticleData') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id,title: title, description: description, categories: categories, tags: tags},
                dataType: 'json',
                success: function(response){
                    if(response.success == 1){
                        //alert(response.msg);

                        // Empty and reset the values
                        $('#title','#description').val('');

                        $('.jsPanel ').toggle();
                        alert('sucess!');table();
                        // Reload DataTable
                        //table.ajax.reload();


                    }else{
                        alert(response.msg);
                    }
                }
            });

        }else{
            alert('Please fill all fields.');
        }
    }

    function jqueryConfirm(element){
        var id = $(element).data('id');
        $.confirm({
            title: "Confirm!",
            content: "Are you sure?",
            buttons: {
                confirm: function(){
                    window.location = "dashboard/delete/"+id;
                },
                cancel: function(){
                    $.alert("Canceled!");
                },

            }
        });
    }

    function changeCategory(id){
        $('.categories').select2().val(id).trigger("change");
    }
    function changeTags(id){
        var arr = id.split(',');
        $('.tags').select2().val(arr).trigger("change");
    }
</script>
<script src="{{ asset('script.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".registrationForm").validate({
            rules: {
                title: "required",
                description: {
                    required: true,
                    maxlength: 50
                },
                tags: "required",
                categories: "required",
            },
            messages: {
                title: "Please enter your title",
                description: {
                    required: "Please enter a description",
                    maxlength: "Your description must be at least 50 characters long"
                },
                tags: "Please enter your tags",
                categories: "Please enter your categories",
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
        $(".registrationForm1").validate({
            rules: {
                title: "required",
                description: {
                    required: true,
                    maxlength: 50
                },
                tags: "required",
                categories: "required",
            },
            messages: {
                title: {
                    required: "Please enter a title"
                },
                description: {
                    required: "Please enter a description",
                    maxlength: "Your description must be at least 50 characters long"
                },
                tags: "Please enter your tags",
                categories: "Please enter your categories",
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
        $(".registrationForm2").validate({
            rules: {
                title: "required",
                description: {
                    required: true,
                    maxlength: 50
                },
                tags: "required",
                categories: "required",
            },
            messages: {
                title: "Please enter your title",
                description: {
                    required: "Please enter a description",
                    maxlength: "Your description must be at least 50 characters long"
                },
                tags: "Please enter your tags",
                categories: "Please enter your categories",
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
    });
</script>
</html>

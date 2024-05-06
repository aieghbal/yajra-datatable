<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles List in VueJs component</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body>

<div id="app"><parent-Component /></div>

@vite('resources/js/app.js')
<script>
    $(document).ready(function() {


        $('#categoryAdd').select2();
        $('#tagAdd').select2();
    });
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    function editFunction(element){
        $('.tab-pane').removeClass('active').removeClass('show');
        $('.nav-link').removeClass('active');
        $('#edit').addClass('active').addClass('show');
        $('#edit-tab').addClass('active');
        $('#edit-tab').show();

        var id = $(element).data('id');
        $('#tab_article_vue_id').val(id);

        /*$.ajax({
            url: "{{ route('getArticleData') }}",
            type: 'post',
            data: {_token: CSRF_TOKEN,id: id},
            dataType: 'json',
            success: function(response){

                if(response.success == 1){

                    $('#titleTab').val(response.title);
                    $('#descriptionTab').val(response.description);
                    $('#isActiveTab').val(response.isActive);
                    $('#categoryHidden').val(response.category);

                    $('#categoryTab').select2().val(response.category).trigger("change");

                    changeTags(response.tag);
                }else{
                    alert("Invalid ID.");
                }
            }
        });*/
    }
    function jqueryConfirm(element){console.log($(element).data('id'));
        var id = $(element).data('id');
        $.confirm({
            title: "Confirm!",
            content: "Are you sure?",
            buttons: {
                confirm: function(){
                    window.location = "/article/delete/"+id;
                },
                cancel: function(){
                    $.alert("Canceled!");
                },

            }
        });
    }
    function changeTags(id){
        var arr = id.split(',');
        $('#tagEdit').select2().val(arr).trigger("change");
    }

</script>
</body>
</html>

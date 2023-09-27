<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container py-4">
        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#taskModel">Task Create</button>
    </div>
    <div class="container mb-4">
        <div id="successMessage"></div>
        <table class="table table-striped responsive-table">
        </table>
        @include('layouts.modal')
        @include('layouts.editModal')
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
@stack('scripts')
<script>
    $(document).ready(function() {
        fetchTask()

        function fetchTask() {
            $('.table-striped').DataTable({
                processing: true,
                rowId: 'id',
                serverSide: true,
                ajax: "{{route('task.data')}}",
                columns: [{
                        data: "id",
                        title: "id",
                        name: "id"
                    },
                    {
                        data: "title",
                        title: "Title",
                        name: "title"
                    },
                    {
                        data: "description",
                        title: "Description",
                        name: "description"
                    },
                    {
                        data: "action",
                        title: "Action",
                        name: "action"
                    },
                ],
            });
        }
    })
    $(document).on('click', '#taskSubmit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            type: "POST",
            url: "{{route('task.create')}}",
            data: {
                title: $('#title').val(),
                description: $('#description').val(),
            },
            success: function(response) {
                if (response.status === 400) {
                    $("#errorList").html("");
                    $("#errorList").addClass('alert alert-danger');
                    let data = response.erros;
                    $.each(data, (function(i, item) {
                        $("#errorList").append(`<li>${item}</li>`);
                    }));
                } else if (response.status == 200) {
                    $("#successMessage").html("");
                    $("#successMessage").addClass('alert alert-success');
                    $("#taskModel").modal('hide');
                    $("#successMessage").append(response.message)
                    $("#taskModel").find('input,textarea').val("");
                    fetchTask()
                }
            }
        })
    });
    $(document).on('click','.deleteTask', function(e) {
        e.preventDefault();
        let task_id = $(this).data('id');
        let url = "{{route('task.destory',':id')}}";
        url = url.replace(":id",task_id);
        $.ajax({
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: task_id,
            success:function(response){
                $('.table-striped').DataTable().row('tr').remove().draw();
            }
        });
    })
    
  
</script>

</html>
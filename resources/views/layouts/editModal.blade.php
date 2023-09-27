<div class="modal fade" id="edittaskModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="errorList"></ul>
                <form action="" method="POST" id="#taskFormUpdate">
                    @csrf
                    <input type="hidden" id="task_id">
                    <div class="form-group">
                        <label for="my-input">Title</label>
                        <input class="form-control" type="text" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="my-input">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary taskUpdate">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
     $(document).on('click','.editTask', function(e){
        e.preventDefault();
        $(document).find("#edittaskModel").modal('show');
        let task_id = $(this).data('id');
        let url = "{{route('task.edit',':id')}}";
        url = url.replace(':id',task_id)
        $.ajax({
            type:"GET",
            url:url,
            headers:{
                "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
            },
            data:task_id,
            success:function(response){
                $("#edittaskModel").find('#task_id').val(response.response.id);
                $("#edittaskModel").find("#title").val(response.response.title);
                $("#edittaskModel").find("#description").val(response.response.description);
            }
        });
    })
</script>
@endpush
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('post_store') }}" id="postForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="my-input">Post Name</label>
                        <input id="name" class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="my-input">Post Description</label>
                        <textarea id="description" class="form-control" name="description" rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Post Image</label>
                        <input id="image" class="form-control" type="file" name="image">
                    </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>
</div>
@section('js')
<script>
    $("form #postModal").on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:"POST",
            url: $(this).attr('action'),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data);
                $(document).find("#postModal").modal('hide');
            }
        });
    });
</script>
@endsection
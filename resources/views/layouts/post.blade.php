<style>
    .commit_area {
        background-color: red;
    }
</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Posts') }}</div>
                <div class="card-body">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#postModal">Create Post</button>
                </div>
            </div>
            @include('layouts.post_modal')
            <div class="container">
                <div class="card-body">
                    @foreach ($post as $posts)
                    <h5 class="card-title">{{$posts->name}}</h5>
                    <img src="images/{{$posts->image}}" class="img-fluid" height="145px" ; width="100%">
                    <p>{{$posts->description}}</p>
                    <div class="container commit-section">
                        <form action="{{route('post_commit')}}" id="commitSubmit" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" data-id="{{$posts->id}}" name="post_id" value="{{$posts->id}}">
                                <input type="hidden" name="user_id" value="{{$posts->u_id}}">
                                <label for="my-input">User Commit</label>
                                <div class="commit_list"></div>
                                <textarea name="commit" class="form-control" id="commit" rows="2"></textarea>
                                <button class="btn btn-danger btn-sm btn-commit">Submit</button>
                            </div>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $("form #commitSubmit").on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                console.log(data);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        let post_id = $("input[name=post_id]").val();
        let commit_list = $(".commit_list");
        var url = '{{ route("get_commit", ":id") }}';
        url = url.replace(':id', post_id);
        var html = '<ul>';
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function(data) {
                $.each(data.posts, function(i, value) {
                var commitMessage = value.commit;
                html += `<li>Commit Message: ${commitMessage}</li>`;
            });
            html += '</ul>';
            commit_list.html(html); 
            }
        });
    })
</script>
@endpush
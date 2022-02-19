<x-admin-master>
    @section('content')
        @if($comments)
            <h1>Comments</h1>

            <div class="row">
                @if (Session::has('comment-deleted') )
                    <div class="alert alert-danger">
                        {{session('comment-deleted')}}
                    </div>
                @elseif (Session::has('comment-updated'))
                    <div class="alert alert-success">
                        {{session('comment-updated')}}
                    </div>
                @elseif (Session::has('comment-created-message'))
                    <div class="alert alert-success">
                        {{session('comment-created-message')}}
                    </div>
                @endif
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Post Id</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Home Post</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Post Id</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{$comment->id}}</td>
                                            <td>{{$comment->post_id}}</td>
                                            <td>{{$comment->post->user->name}}</td>
                                            <td><a href="{{ route('comment.edit', $comment->id) }}">{{$comment->body}}</a></td>
                                            <td>{{$comment->created_at->diffForHumans()}}</td>
                                            <td>{{$comment->updated_at->diffForHumans()}}</td>
                                            <td><a href="{{ route('post', $comment->post->id) }}">View Post</a></td>
                                            <td>
                                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            @else
                <h1>No comments</h1>
                @stop
            @endif
    @endsection

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    @endsection
</x-admin-master>
<x-home-master>

    @section('content')
            <!-- Title -->
            <h1 class="mt-4">{{ $post->title }}</h1>

            <!-- Author -->
            <p class="lead">
                by
                <h2 style="color: rgb(84, 84, 250)"><a href="{{ route('user.profile.show', $post->user_id) }}">{{ $post->user->name }}</a></h2>
                </p>

                <hr>

                    <!-- Date/Time -->
                    <p>Posted on {{ $post->created_at->diffForHumans() }}</p>

                <hr>

                    <!-- Preview Image -->
                    <img class="img-fluid rounded" src="{{ $post->post_image }}" alt="">

                <hr>

                    <!-- Post Content -->
                    <p> {{ $post->body }} </p>

                <hr>

                @if(Session::has('comment-message'))
                    {{ session('comment-message') }}
                @elseif(Session::has('reply-created-message'))
                    {{ session('reply-created-message') }}
                @elseif(Session::has('reply-deleted'))
                    {{ session('reply-deleted') }}
                @endif

                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="form-group">
                                <div class="form-group">
                                    <textarea   name="body"
                                                class="form-control"
                                                id="body"
                                                cols="30"
                                                rows="3"
                                    ></textarea>
                                </div>
                                @error('body')
                                    <span><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                @if(count($comments) > 0)
                    <div class="comments-container">
                        <h1>Comments</h1>
                        @foreach($comments as $comment)

                            <ul id="comments-list" class="comments-list">
                                <li>
                                    <div class="comment-main-level">
                                        <div class="comment-avatar"><img src="{{ $comment->user->avatar }}" alt="Err"></div>
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name by-author"><a href="{{ route('user.profile.show', $comment->author) }}">{{ $comment->user->username }}</a></h6>
                                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                <i class="fa fa-reply"><button id="formButton{{ $comment->id }}" type="button" onClick="$('#form{{ $comment->id }}').toggle();"></button></i>
                                                <i class="fa fa-heart"></i>
                                                @if(auth()->user()->userHasRole('Admin'))
                                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <i class="fa fa-trash-o" style="color: red;"><button type="submit"></button></i>
                                                    </form>
                                                @endif
                                            </div>
                                            <div class="comment-content">
                                                {{ $comment->body }}
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="comments-list reply-list" id="form{{ $comment->id }}" style="display: none;">
                                        <li>
                                            <div class="comment-box">
                                                <div class="comment-head">
                                                    <h6>Send a reply</h6>
                                                </div>
                                                <div class="comment-content">
                                                    <form action="{{ route('comment-reply.createReply') }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">

                                                        <textarea name="body" id="body" cols="75" rows="4" style="none; resize: none; overflow: auto; border: 1px solid #888;"></textarea>
                                                        <button class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="font-size:14px" type="submit">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                @if(count($comment->replies) > 0)
                                    @foreach($comment->replies as $commentReply)
                                        @if($commentReply->is_active == '1')
                                            <ul class="comments-list reply-list">
                                                <li>
                                                    <div class="comment-avatar"><img src="{{ $commentReply->user->avatar }}" alt="Err"></div>
                                                    <div class="comment-box">
                                                        <div class="comment-head">
                                                            <h6 class="comment-name"><a href="{{ route('user.profile.show', $commentReply->author) }}">{{ $commentReply->user->username }}</a></h6>
                                                            <span></span>
                                                            <i class="fa fa-heart"></i>
                                                            @if(auth()->user()->userHasRole('Admin'))
                                                                <form action="{{ route('reply.delete') }}" method="post" enctype="multipart/form-data" value="{{ $commentReply->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="comment_id" value="{{ $commentReply->id }}">

                                                                    <i class="fa fa-trash-o" style="color: red;"><button type="submit"></button></i>
                                                                </form>
                                                            @endif
                                                            <div class="comment-content">
                                                                {{ $commentReply->body }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endif
                                    @endforeach
                                @endif
                                </li>
                            </ul>
                        @endforeach
                    </div>
            @else
                <h1>There are no comments</h1>
            @endif

    @endsection

    @section('scripts')

    @endsection
</x-home-master>
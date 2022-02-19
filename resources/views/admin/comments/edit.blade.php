<x-admin-master>
    @section('content')

        <h1>Edit a Comment</h1>

        <form   method="post"
                action="{{route('comment.updateText', $comment->id)}}"
                enctype="multipart/form-data"
        >
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">Author</label>
                <input  type="text"
                        name="author"
                        class="form-control"
                        id="title"
                        aria-describedby=""
                        placeholder="Enter title"
                        value={{ $comment->author }}
                >
            </div>
            <div>
                @error('author')
                    <span><strong>{{$message}}</strong></span>
                @enderror
            </div>
            <div class="form-group">
                <textarea   name="body"
                            class="form-control"
                            id="body"
                            cols="30"
                            rows="10"
                > {{ $comment->body }} </textarea>
            </div>
            @error('body')
                <span><strong>{{$message}}</strong></span>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    @endsection
</x-admin-master>
<x-admin-master>
    @section('content')

        <div class="row">
            @if (Session::has('permission-updated') )
                <div class="alert alert-success">
                    {{session('permission-updated')}}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Permission: {{ $permission->name }}</h1>

                <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$permission->name}}">
                    </div>

                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    @endsection
</x-admin-master>
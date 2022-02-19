<x-admin-master>
    @section('content')

        <h1>Users</h1>

        @if(session('user-deleted'))
            <div class="alert alert-danger">{{ session('user-deleted') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Username</td>
                                    <td>Avatar</td>
                                    <td>Name</td>
                                    <td>Registered date</td>
                                    <td>Updated profile date</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <td>Id</td>
                                    <td>Username</td>
                                    <td>Avatar</td>
                                    <td>Name</td>
                                    <td>Registered date</td>
                                    <td>Updated profile date</td>
                                    <td>Delete</td>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>
                                            <img height="150px" width="150px" src="{{$user->avatar}}" alt="Error">
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->created_at->diffForHumans()}}</td>
                                        <td>{{$user->updated_at->diffForHumans()}}</td>
                                        <td>
                                            <form method="post" action="{{route('user.destroy', $user->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
            </div>
        </div>


    @endsection

    @section('scripts')

    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    @endsection
</x-admin-master>
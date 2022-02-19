<x-admin-master>
    @section('content')

        <h1>User Profile for {{ $user->name }}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <img height="200px" width="200px" class="img-profile rounded-circle" src="{{ $user->avatar }}" alt="Error">
                    </div>

                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input  type="text"
                                name="username"
                                class="form-control
                                        @error('username') is-invalid @enderror
                                        "
                                id="username"
                                value="{{$user->username}}"
                        >
                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input  type="text"
                                name="name"
                                class="form-control
                                        @error('name') is-invalid @enderror
                                        "
                                id="name"
                                value="{{$user->name}}"
                        >
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input  type="text"
                                name="email"
                                class=" form-control
                                        @error('email') is-invalid @enderror
                                        "
                                id="email"
                                value="{{$user->email}}"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input  type="password"
                                name="password"
                                class="form-control
                                        @error('password') is-invalid @enderror
                                        "
                                id="password"
                        >
                        @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input  type="password"
                                name="password_confirm"
                                class="form-control
                                        @error('password_confirm') is-invalid @enderror
                                        "
                                id="password_confirm"
                        >
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <td>Id</td>
                                            <td>Name</td>
                                            <td>Slug</td>
                                            <td>Atttach</td>
                                            <td>Detach</td>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Options</th>
                                            <td>Id</td>
                                            <td>Name</td>
                                            <td>Slug</td>
                                            <td>Atttach</td>
                                            <td>Detach</td>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <td><input  type="checkbox"
                                                            @foreach ($user->roles as $user_role)
                                                                @if($user_role->slug == $role->slug)
                                                                    checked
                                                                @endif
                                                            @endforeach
                                                ></td>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->slug }}</td>
                                                <td>
                                                    <form method="post" action="{{route('user.role.attach', $user)}}">
                                                        @method("PUT")
                                                        @csrf
                                                        <input type="hidden" name="role" value="{{ $role->id }}">
                                                        <button
                                                                class="btn btn-primary"
                                                                @if($user->roles->contains($role))
                                                                    disabled
                                                                @endif
                                                        >Attach</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{route('user.role.detach', $user)}}">
                                                        @method("PUT")
                                                        @csrf
                                                        <input type="hidden" name="role" value="{{ $role->id }}">
                                                        <button class="btn btn-danger"
                                                            @if(!$user->roles->contains($role))
                                                                disabled
                                                            @endif
                                                        >Detach</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
</x-admin-master>
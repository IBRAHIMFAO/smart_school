@extends('dashboard.master', ['title' => 'User List'])

@section('content')
    <div class="container">
        <h2>User List</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
            {{-- @role('super-admin', 'admin')
                I   am a super-admin!
                @else
                    I am not a super-admin...
            @endrole --}}
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>FullName</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if ($user->is_active)
                                <span class="badge badge-success">Actif</span>
                            @else
                                <span class="badge badge-danger">Inactif</span>
                            @endif
                        </td>
                        <td >
                            <div class="btn-group">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info mr-3">Show</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mr-3">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                                <form action="{{ route('dashboard.user.toggle', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        {{ $user->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                            </div>
                            {{-- <a href="{{ route('users.password', $user->id) }}" class="btn btn-success">Password</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
            color: black;           

        }
        .table {
            border-collapse: collapse;
            border-spacing: 0ch;
            border: 1px solid #ddd;

            width: 70%;
            color: #070707;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            text-align: left;

        }
       

        th, td {
            text-align: left;
            padding: 8px;

            border-collapse: collapse;
            border-spacing: 0ch;
            border: 1px solid #ddd;

        }
       

    </style>

<script>
    $('btn-active').click(function(){
        $(this).addClass('active');
    });

</script>
@endsection

@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="card-header">{{ __('Table Users') }}</div>

                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-secondary">
                        Tambah User
                    </a>
                    <a href="{{ route('user-export') }}" class="btn btn-sm btn-primary">
                        Export User to Excel
                    </a>
                    <a id="importButton" class="btn btn-sm btn-warning">
                        Import User
                    </a>
                    <table class="table table-striped" id="users">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>

                            @foreach($users as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->role->role_name}}</td>
                                <td>
                                    <a href="{{ route('users.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('users.destroy',$row->id) }}" method="POST" style="display: inline" onsubmit="return confirm('Do you really want to delete {{ $row->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="text-muted">
                                                Delete
                                            </span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="importModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="dynamic_modal_title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#importButton').click(function() {
                $('#dynamic_modal_title').text('Add Import User');
                $('#importModal').modal('show');
            });
        })
        new DataTable('#users');
    </script>
    @endsection
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
                <div class="card-header">{{ __('Table Sellings') }}</div>

                <div class="card-body">
                    <a href="{{ route('sellings.create') }}" class="btn btn-sm btn-secondary">
                        Add Sell
                    </a>
                    <a href="{{ route('sellings-export') }}" class="btn btn-sm btn-primary">
                        Export Sell to Excel
                    </a>
                    <a id="importButton" class="btn btn-sm btn-warning">
                        Import Sell
                    </a>
                    <a href="{{ route('sellings-report') }}" class="btn btn-sm btn-success">
                        Sellings Report
                    </a>
                    <table class="table table-striped" id="sellings">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NO TRX</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Cashier</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Total Item</th>
                                <th scope="col">Grand Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>

                            @foreach($sellings as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->code_trans}}</td>
                                <td>{{$row->date_sell}}</td>
                                <td>{{$row->cashier->name}}</td>
                                <td>{{$row->customer->name}}</td>
                                <td>{{$row->details->count()}}</td>
                                <td>{{$row->grand_total}}</td>
                                <td>
                                    <a href="{{ route('sellings.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <a href="{{ route('sellings.show', $row->id) }}" class="btn btn-sm btn-secondary">
                                        Print
                                    </a>
                                    <form action="{{ route('sellings.destroy',$row->id) }}" method="POST" style="display: inline" onsubmit="return confirm('Do you really want to delete {{ $row->code_trans }}?');">
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
        new DataTable('#sellings');
    </script>
    @endsection
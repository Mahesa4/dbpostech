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
                    <form action="{{ route('sellings-report') }}" method="GET">
                        <div class="modal-body row">
                            <div class="col-4">
                                <input type="date" name="startDate" class="form-control" placeholder="Start Date" value="{{request()->startDate}}">
                            </div>
                            <div class="col-4"> 
                                <input type="date" name="endDate" class="form-control" placeholder="End Date" value="{{request()->endDate}}">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Filter Data</button>
                                <a href="{{route('sellings-reportPdf', ['startDate'=> request()->startDate, 'endDate'=> request()->endDate])}}" class="btn btn-secondary">Export PDF</a>
                            </div>
                        </div>
                    </form>
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
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
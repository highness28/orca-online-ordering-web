@extends('layouts.app')

@section("css")
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="aside">
                <table id="inventory_datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">Tracking #</th>
                            <th>Delivery Address</th>
                            <th>Total</th>
                            <th>Delivery Date</th>
                            <th>Date Purchased</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice as $order)
                            <tr>
                                <td>{{ $order->tracking_number }}</td>
                                <td>{{ $order->deliveryAddress->delivery_address }}</td>
                                <td>{{ 'Php ' . number_format($order->total, 2) }}</td>
                                <td>{{ date('F d, Y', strtotime($order->delivery_date)) }}</td>
                                <td>{{ date('F d, Y', strtotime($order->created_at)) }}</td>
                                <td><a href="{{ url('/order/'.$order->id) }}"><i class="fa fa-search"></i> View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#inventory_datable').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : true
            });
        });
    </script>
@endsection
@extends('layout.master')
@section('main_content')
    <div class="container-fluid">
        @section('breadcrumb')
         <li class="breadcrumb-item active" aria-current="page">Customers</li>
        @endsection
        <h2>Customer List</h2>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td><a href="" class="btn btn-primary">Transaction Details</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js_plugins')
@endsection
@section('js')
@endsection
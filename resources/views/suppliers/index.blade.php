@extends('layout.master')
@section('main_content')
    <div class="container-fluid mt-2">
        @section('breadcrumb')
            <li class="breadcrumb-item active" aria-current="page">suppliers</li>
        @endsection
        <h2>Supplier List</h2>

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
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td><a href="" class="btn btn-info">Transaction Details</a></td>
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
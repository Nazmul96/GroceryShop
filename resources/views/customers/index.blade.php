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
                        <td>
                            <button class="btn btn-success customer_sell" data-id="{{$customer->id}}" data-toggle="modal" data-target="#sellModal">
                                Sell
                            </button>
                            <a href="" onclick="customerTransaction({{$customer->id}})" class="btn btn-primary" data-toggle="modal" data-target="#customerTransactionDetail">Transaction Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="sellModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Sell</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('sell.transaction')}}" method="post" id="">
                    @csrf
                    <input type="hidden" name="customer_id" id="customer_id">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Amount:</label>
                      <input type="text" class="form-control" id="recipient-name" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="transaction-details" class="col-form-label">Transaction Details:</label>
                        <textarea class="form-control" name="transaction_details" id="transaction-details" cols="30" rows="10"></textarea>
                      </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="customerTransactionDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <h6 class="friend_name"></h6>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Transaction Details</th>
                        </tr>
                    </thead>
                    <tbody class="table_data">

                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div> 
      
      
@endsection

@section('js_plugins')
@endsection
@section('js')
      <script>
         $(document).ready(function() {
            $('.customer_sell').click(function(e){
                 $('#customer_id').val($(this).data('id'));
            });
        }); 
        function customerTransaction(customerId) {
            $.ajax({
                url: '/customer/' + customerId + '/transactions/details',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var name_detail = 'Name: '+response.customer.name + ' Transaction Details';
                    var tableHtml = '';
                    $('.friend_name').text(name_detail)
                    $.each(response.transactions, function(index, transaction) {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + transaction.transaction_date + '</td>';
                        tableHtml += '<td class="badge badge-success">' + transaction.type + '</td>';
                        tableHtml += '<td>' + transaction.amount + '</td>';
                        tableHtml += '<td>' + transaction.transaction_details.substring(0, 30)+'...' + '</td>';
                        tableHtml += '</tr>';
                    });
                    $('.table_data').html(tableHtml);
                },
                error: function(error) {
                    console.error(error);
                }
            });
          }   
      </script>
@endsection
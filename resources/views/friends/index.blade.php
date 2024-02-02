@extends('layout.master')
@section('main_content')
    <div class="container-fluid mt-2">
        @section('breadcrumb')
          <li class="breadcrumb-item active" aria-current="page">Friends</li>
        @endsection
       
        <h2>Friend List</h2>

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
                @foreach ($friends as $friend)
                    <tr>
                        <td>{{ $friend->id }}</td>
                        <td>{{ $friend->name }}</td>
                        <td>{{ $friend->email }}</td>
                        <td>
                            <a type="button" class="btn btn-sm btn-primary lend_money" data-id="{{$friend->id}}" data-toggle="modal" data-target="#lendModal">Lend Money</a>
                            <a type="button" class="btn btn-sm btn-success receive_repayment" data-id="{{$friend->id}}" data-toggle="modal" data-target="#lendModal">Receive Repayment</a>
                            <a type="button" class="btn btn-sm btn-info" onclick="friendTransaction({{$friend->id}})" data-toggle="modal" data-target="#friendTransactionDetail">Transaction Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

      <div class="modal fade" id="lendModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="lendMoneyForm">
                    @csrf
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

      <div class="modal fade" id="friendTransactionDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
                            <th>Type</th>
                            <th>Amount</th>
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

              $('.lend_money').click(function(e){
                    var routeUrl = "{{ route('lend_money', ':friendId') }}";
                    routeUrl = routeUrl.replace(':friendId', $(this).data('id'));
                    $('#lendMoneyForm').attr('action', routeUrl);
                    $('.modal-title').text('Lend money');
              }); 

              $('.receive_repayment').click(function(e){
                    var routeUrl = "{{ route('receive_repayment', ':friendId') }}";
                    routeUrl = routeUrl.replace(':friendId', $(this).data('id'));
                    $('#lendMoneyForm').attr('action', routeUrl);
                    $('.modal-title').text('Receive Repayment');
              }); 
        });

        function friendTransaction(friendId) {

                $.ajax({
                    url: '/friend/' + friendId + '/transactions/details',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var name_detail = 'Name: '+response.friend.name + ' Transaction Details';
                        var tableHtml = '';
                        $('.friend_name').text(name_detail)
                        $.each(response.transactions, function(index, transaction) {
                            tableHtml += '<tr>';
                            tableHtml += '<td>' + transaction.type + '</td>';
                            tableHtml += '<td>' + transaction.amount + '</td>';
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
@extends('layout.master')
@section('main_content')
    <div class="container-fluid">
        @section('breadcrumb')
            <li class="breadcrumb-item active" aria-current="page">Report proft/loss</li>
        @endsection

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="message-div"></div>
                        <form class="form-horizontal form-label-left" method="GET" action="">
                            <div class="row">
                                <div class="form-group">
                                    <label>Date range:</label>
                  
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="far fa-calendar-alt"></i>
                                        </span>
                                      </div>
                                      <input type="text" class="form-control float-right" id="reservation" name="date_range" value="{{ $date_details['date_range'] }}" >
                                    </div>
                                    <!-- /.input group -->
                                  </div>
                                <div class="col-md-1">
                                    <label class="fw-bold col-md-12 col-sm-0 col-xs-0">&nbsp;</label>
                                    <button type="submit" class="btn bg-dark">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <h4>Profit/Loss</h4>
                        <h6>Income: {{$totalIncome}}</h6>
                        <h6>Expense: {{$totalExpenses}}</h6>
                        
                        @if($profitLoss > 0)
                            <h6 class="text-success">Profit: {{$profitLoss}}</h6>
                        @elseif($profitLoss < 0)
                            <h6 class="text-danger">Loss: {{abs($profitLoss)}}</h6>
                        @endif 
                    </div>  
                </div>  
                <table class="table table-bordered table-striped">
                      <thead class="bg-dark text-white">
                            <th>Date</th>
                            <th>type</th>
                            <th>amount</th>
                            <th>Transaction Details</th>
                      </thead>
                      <tbody>
                          @forelse ($totalReportData as $data)
                            <tr>
                                <td>{{ $data->transaction_date }}</td>
                                <td>{{ $data->type }}</td>
                                <td>{{ $data->amount }}</td>
                                <td>{{ $data->transaction_details }}</td>
                                <td>
                            </tr>
                          @empty
                                No data
                          @endforelse  
                      </tbody>
                </table>
            </div>   
       </div>    
@endsection

@section('js_plugins')
@endsection
@section('js')
      <script>
         $(document).ready(function() {
            $('#reservation').daterangepicker();
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
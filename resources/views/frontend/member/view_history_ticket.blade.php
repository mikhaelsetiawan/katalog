@extends('backend')

@section('popup')
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>History Ticket</h3>
        @if($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{{ $err }}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
	  @if(count($member->historyOrderTicket) > 0)
      @foreach($member->historyOrderTicket as $history)
      <div class="history-ticket-container">
        <div class="item">
          <p class="header">Order information</p>
          <div class="content">
            <table class="table-info">
              <tbody>
                <tr>
                  <td>Date</td>
                  <td>:</td>
                  <td>{!! date_format(new DateTime($history->created_at), 'd-M-Y H:i:s') !!}</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td>:</td>
                  <td>{!! $history->ticketH_total !!} coin</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="details">
            <p class="header">Details</p>
            <table class="table-detail">
              <thead>
                <th>No.</th>
                <th>Business</th>
                <th>Ticket</th>
                <th class="ri">Price</th>
                <th class="ri">Amount</th>
                <th class="ri">Subtotal</th>
              </thead>
              <tbody>
              <?php $count = 1; ?>
              @foreach($history->detail as $detail)
                <tr>
                  <td>{{ $count }}.</td>
                  <td>{{ $detail->business->business_name }}</td>
                  <td>{{ $detail->ticket->ticket_name }}</td>
                  <td class="ri">{{ $detail->ticketD_price }}</td>
                  <td class="ri">{{ $detail->ticketD_amount }}</td>
                  <td class="ri">{{ $detail->ticketD_subtotal }}</td>
                </tr>
              <?php $count++; ?>
              @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5" class="ri">Grand Total</td>
                  <td class="ri">{{ $history->ticketH_total }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
          <p id="show-more-" class="show-more">Show more detail.</p>
        </div>
      </div>
      @endforeach
    @else
      No history found.
    @endif
	</div>
</div>
@endsection
@section('page-script')

	{!! Html::style('css/frontend/historyTicket.css') !!}
	<style type="text/css" class="init">
        #dtcustom
        {
            display: inline-block;
        }
	</style>

	<script type="text/javascript">

		$(document).ready(function()
		{

		});
	</script>
@endsection
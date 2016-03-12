@extends('frontend/view_frontend_index')

@section('popup')
@endsection

@section('page-script')
  <style>
    .tr-detailTicket
    {
      display: none;
    }
  </style>

  <script>
  var countOrder = 1;
  var memberCoin = parseInt('{{ $model_member->member_coin }}');
  var countItem = 0;
  var ticketdata = '{{ $model_ticket }}';
  var ticket = $.parseJSON(ticketdata.replace(/&quot;/g,'"'));
  console.log(ticket);
    $(document).ready(function()
    {
      $("#add_ticket_id").change(function()
      {
        if($('#add_ticket_id').val() == 0)
        {
          $('.tr-detailTicket').hide();
        }else{
          var ticket_id = $('#add_ticket_id').val();
          $('.tr-detailTicket').show();
          $('#add_ticket_name').html(ticket[ticket_id]['ticket_name']);
          $('#add_ticket_price').html(ticket[ticket_id]['ticket_price']);
          $('#add_ticket_desc').html(ticket[ticket_id]['ticket_description']);

        }
      });

      $("#add_item").click(function()
      {
        var ticket_id = $('#add_ticket_id').val();
        var subtotal = (parseInt($("#add_bticket_amount").val()) * parseInt(ticket[ticket_id]['ticket_price']));
        if(subtotal > memberCoin)
        {
          alert('Coin anda tidak mencukupi');
        }else{
          var item = '<tr class="order" id="order-'+countOrder+'">'+
            '<td>'+
              '<button type="button" class="btn btn-danger btn-xs" onclick="deleteItem('+countOrder+')">'+
                '<span class="glyphicon glyphicon-trash"></span>'+
                '<span class="hidden-xs" style="margin-left: 5px;">Delete</span>'+
              '</button>'+
            '</td>'+
            '<td><input type="hidden" value="'+$("#add_business_id").val()+'" name="business_id[]" />'+$("#add_business_id option:selected").text()+'</td>'+
            '<td><input type="hidden" value="'+$("#add_ticket_id").val()+'" name="ticket_id[]" />'+$("#add_ticket_id option:selected").text()+'</td>'+
            '<td>'+ ticket[ticket_id]['ticket_price'] +'</td>'+
            '<td><input type="hidden" value="'+$("#add_bticket_amount").val()+'" name="bticket_amount[]" />'+$("#add_bticket_amount").val()+'</td>'+
            '<td class="subtotal ri">'+subtotal+'</td>'+
          '</tr>';
          $("#order-table").append(item);
          memberCoin -= subtotal;
          $("#member_coin").html(memberCoin);
          $("#order-total").html(parseInt($("#order-total").html()) + subtotal);
          if(countItem == 0)
          {
            $('.order-empty').hide();
          }
          countItem++;
          countOrder++;
        }
      });
		});

		function deleteItem(id)
		{
		  var subtotal = parseInt($('#order-'+id+' .subtotal').html());
		  memberCoin += subtotal;
      $("#member_coin").html(memberCoin);
		  $('#order-'+id).remove();
      $("#order-total").html(parseInt($("#order-total").html()) - subtotal);
		  countItem--;
		  if(countItem == 0)
		  {
          $('.order-empty').show();
		  }
		}
  </script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>Buy Ticket (Sisa coin: <span id='member_coin'>{{ $model_member->member_coin  }}</span>)</h3>
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
  {!! Form::open(array(
      'class'     => 'form-horizontal',
      'id'        => 'form-popup-edit',
      'method'    => 'POST',
      'action'    => 'controller_ticket@submitBuy'
      )) !!}
		<table id="table_buyticket" style="width:500px;" class="">
		  <colgroup>
		    <col style="width: 150px;"/>
		    <col style="width: 10px;"/>
		    <col style=""/>
		  </colgroup>
		  <tbody>
        <tr>
          <td>Business</td>
          <td>:</td>
          <td>
            {!! Form::select('', $model_business, null, ['style'=>'width:340px','class' => 'form-control pull-left','id'=>'add_business_id']) !!}
          </td>
        </tr>
        <tr>
          <td>Ticket</td>
          <td>:</td>
          <td>
            {!! Form::select('', [0=>'Choose Ticket..']+$model_select_ticket, null, ['style'=>'width:340px','class' => 'form-control pull-left','id'=>'add_ticket_id']) !!}
          </td>
        </tr>
        <tr class="tr-detailTicket">
          <td>Ticket Name</td>
          <td>:</td>
          <td id="add_ticket_name"></td>
        </tr>
        <tr class="tr-detailTicket">
          <td>Ticket Price</td>
          <td>:</td>
          <td id="add_ticket_price"></td>
        </tr>
        <tr class="tr-detailTicket">
          <td>Ticket Description</td>
          <td>:</td>
          <td id="add_ticket_desc"></td>
        </tr>
        <tr class="tr-detailTicket">
          <td>Ticket Amount</td>
          <td>:</td>
          <td>
            {!! Form::input('number','',null, [
                            'id'    => 'add_bticket_amount',
                            'class' => 'form-control',
                            ]) !!}
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <button type="button" id="add_item" class="btn btn-primary btn-sm pull-right">
              <span class="glyphicon glyphicon-plus"></span>
              <span class="hidden-sm" style="margin-left: 5px;">Add</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <table id="order-table" class="table" style="margin-top: 50px;">
      <colgroup>
        <col style="width: 10%;"/>
        <col style="width: 20%;"/>
        <col style="width: 20%;"/>
        <col style="width: 20%;"/>
        <col style="width: 10%;"/>
        <col style="width: 20%;"/>
      </colgroup>
      <thead>
        <th>Action</th>
        <th>Business</th>
        <th>Ticket</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Subtotal</th>
      </thead>
      <tbody>
        <tr class="order-empty">
          <td class="ce" colspan="6">No item.</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" class="ri"> Total</td>
          <td class="ri" id="order-total">0</td>
        </tr>
      </tfoot>
    </table>
    <button type="submit" class="btn btn-success btn-m">
      <span class="glyphicon glyphicon-ok"></span>
      <span class="hidden-m" style="margin-left: 5px;">Submit</span>
    </button>
  {!! Form::close() !!}
  </div>
</div>
@endsection
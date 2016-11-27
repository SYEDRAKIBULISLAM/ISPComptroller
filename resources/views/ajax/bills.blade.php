
@foreach($bills as $item)

    <option value="{{  $item->id }}" amount="{{  $item->amount }}" consumer_id="{{  $item->consumer->id }}" consumer_address="{{  $item->consumer->present_address }}">{{ $item->generateBill->name  }}</option>

@endforeach


<script type="text/javascript">
    var amount = $('#bill_id').find('option:selected').attr("amount");
    $('#amount').val(amount);
    var consumer_id = $('#bill_id').find('option:selected').attr("consumer_id");
    $('#consumer_id').val(consumer_id);
    var address = $('#bill_id').find('option:selected').attr("consumer_address");
    $('#address').val(address);
</script>
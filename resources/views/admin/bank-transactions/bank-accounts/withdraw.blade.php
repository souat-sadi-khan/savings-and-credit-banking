<form action="{{route('admin.bank-accounts.add-withdraw', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">

        
        {{-- In Hand --}}
        <div class="col-md-6 form-group">
            <label for="in_hand">{{_lang('In Hand')}}
            </label>
        <input type="text" name="in_hand" id="in_hand" readonly class="form-control" value="{{$in_hand}}">
        </div>

        {{-- New Withdraw Amt --}}
        <div class="col-md-6 form-group">
            <label for="new_withdraw_amt">{{_lang('New Withdraw Amt')}}
                <span class="text-danger">*</span>
            </label>
            <input type="number" min="0"   required name="new_withdraw_amt" id="new_withdraw_amt" placeholder="Enter New Withdraw Amt" class="form-control" >
        </div>

        {{-- grand total in hand  --}}
        <div class="col-md-6 form-group">
            <label for="grand_total_in_hand">{{_lang('Grand Total In Hand')}}
            </label>
            <input type="text" readonly name="grand_total_in_hand" id="grand_total_in_hand" placeholder="Grand Total In Hand Amount"  class="form-control" value="{{$in_hand}}" >
        </div>


        {{-- withdraw Date --}}
        <div class="col-md-6 form-group">
            <label for="withdraw_date">
                {{_lang('Withdraw Date')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required readonly name="withdraw_date" id="withdraw_date" placeholder="Enter Withdraw Date"
                class="form-control date" value="{{ date('d/m/Y') }}">
        </div>


        {{-- withdraw Reference No --}}
        <div class="col-md-6 form-group">
            <label for="reference_no">
                {{_lang('Reference No')}}
            </label>
            <input type="text"  name="reference_no" id="reference_no" placeholder="Enter withdraw Reference No"
                class="form-control">
        </div>

        {{-- withdraw Description --}}
        <div class="col-md-6 form-group">
            <label for="additional_note">
                {{_lang('Note')}}
            </label>
            <textarea name="additional_note" id="additional_note" class="form-control"></textarea>
        </div>


        
        <div class="form-group col-md-12" align="right">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                    class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
        </div>
    </div>
</form>

<script>
    $('.select').select2({  width: '100%' });
 _componentDatePicker();

 $(document).on('keyup blur change','#new_withdraw_amt',function(){
     var new_withdraw = check_null($(this).val());
     var in_hand = check_null($("#in_hand").val());

     var grand_total_in_hand =parseFloat(in_hand) - parseFloat(new_withdraw) ;
     if (parseFloat(grand_total_in_hand) < 0) {
         swal("Be Careful !", "Withdraw Amount Cannot Be Greater Than The Cash In Hand Amount", "error");
         $(this).val('');

         $('#grand_total_in_hand').val(in_hand);
     }else{

         $('#grand_total_in_hand').val(grand_total_in_hand);
     }
 });

 function check_null(value) {
    if (value == null || value == '' || isNaN(value)) {
        return 0;
    } else {
        return value;
    }
}
</script>
<form action="{{route('admin.bank-accounts.add-deposit', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">

        {{-- In Hand --}}
        <div class="col-md-6 form-group">
            <label for="in_hand">{{_lang('In Hand')}}
            </label>
        <input type="text" name="in_hand" id="in_hand" readonly class="form-control" value="{{$in_hand}}">
        </div>

        {{-- New Deposit Amt --}}
        <div class="col-md-6 form-group">
            <label for="new_deposit_amt">{{_lang('New Deposit Amt')}}
                <span class="text-danger">*</span>
            </label>
            <input type="number" min="0"   required name="new_deposit_amt" id="new_deposit_amt" placeholder="Enter New Deposit Amt" class="form-control" >
        </div>

        {{-- grand total in hand  --}}
        <div class="col-md-6 form-group">
            <label for="grand_total_in_hand">{{_lang('Grand Total In Hand')}}
            </label>
            <input type="text" readonly name="grand_total_in_hand" id="grand_total_in_hand" placeholder="Grand Total In Hand Amount"  class="form-control" value="{{$in_hand}}" >
        </div>


        {{-- Deposit Date --}}
        <div class="col-md-6 form-group">
            <label for="deposit_date">
                {{_lang('Deposit Date')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required readonly name="deposit_date" id="deposit_date" placeholder="Enter Deposit Date"
                class="form-control date" value="{{ date('d/m/Y') }}">
        </div>


        {{-- Deposit Reference No --}}
        <div class="col-md-6 form-group">
            <label for="reference_no">
                {{_lang('Reference No')}}
            </label>
            <input type="text"  name="reference_no" id="reference_no" placeholder="Enter Deposit Reference No"
                class="form-control">
        </div>

        {{-- Deposit Description --}}
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

 $(document).on('keyup blur change','#new_deposit_amt',function(){
     var new_depo = check_null($(this).val());
     var in_hand = check_null($("#in_hand").val());

     var grand_total_in_hand =parseFloat(new_depo) + parseFloat(in_hand) ;
     $('#grand_total_in_hand').val(grand_total_in_hand);
 });

 function check_null(value) {
    if (value == null || value == '' || isNaN(value)) {
        return 0;
    } else {
        return value;
    }
}
</script>
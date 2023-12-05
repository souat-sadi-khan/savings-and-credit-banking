<form action="{{route('admin.bank-withdraws.update', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">

        {{-- withdraw Amount --}}
        <div class="col-md-4 form-group">
            <label for="withdraw_amt">{{_lang('Withdraw Amount')}}
                 <span class="text-danger">*</span>
            </label>
        <input type="number" min="0" step="1" name="withdraw_amt" id="withdraw_amt" class="form-control" value="{{$model->grand_total_amt}}">
        </div>

        {{-- Reference No --}}
        <div class="col-md-4 form-group">
            <label for="reference_no">{{_lang('Reference No')}}
               
            </label>
        <input type="text"   name="reference_no" id="reference_no" placeholder="Enter Reference No" class="form-control" value="{{$model->reference_no}}">
        </div>

    


        {{-- withdraw Date --}}
        <div class="col-md-4 form-group">
            <label for="withdraw_date">
                {{_lang('Withdraw Date')}}
                <span class="text-danger">*</span>
            </label>
        <input type="text" required readonly name="withdraw_date" id="withdraw_date" placeholder="Enter Withdraw Date" class="form-control date" value="{{Carbon\Carbon::createFromFormat('Y-m-d', $model->tx_date)->format('d/m/Y')}}">
        </div>



        
        <div class="form-group col-md-12 text-right">
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

</script>
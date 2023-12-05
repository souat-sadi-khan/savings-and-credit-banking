<form action="{{route('admin.store_cash_in_hand')}}" method="post" id="content_form">
    @csrf
    <div class="row">

             <div class="col-md-12">
            <hr>
            <h3 class="text-center">Store Cash In Hand Amount</h3>
            <hr>
            <h4 class="text-success d-flex">Remember:</h4>
            <p class="text-danger"> You Can Store Cash In Hand One Time Only. It Cannot Be Modified Later. So Be Careful And Provide The Actual Amount Of Cash In Hand.</p>
        </div>
     
    
        {{-- Cash In Hand Amount --}}
        <div class="col-md-12 form-group">
            <label for="amount">{{_lang('Cash In Hand Amount')}}
                 <span class="text-danger">*</span>
            </label>
                <input type="number" required name="amount" placeholder="Enter Cash In Hand Amount" class="form-control">
        </div>

        {{-- Transaction Date --}}
        {{-- <div class="col-md-6 form-group">
            <label for="tx_date">{{_lang('Transaction Date')}}
                 <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                
                    <input type="text" readonly name="tx_date"  placeholder="Enter Transaction Date"
                                    class="form-control date">
            </div>
        </div> --}}



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
    $('.select').select2({
        width: '100%'
    });


        $(document).on('change','#member_id',function(){
            var member_id = $(this).val(); 
            var url  = $(this).data('url');
            $("#member_permanent_address").val('');
            $("#member_image").attr('src',"");
            
            $.ajax({
                    url: url,
                    data: {member_id:member_id},
                    type: 'Get',
                    dataType: 'json',
                    success:function(data){
                        $("#member_permanent_address").val('Father: '+data.member_info.father_name+', Address: '+data.member_info.present_address_line_1);
                        $("#member_image").attr('src',data.image);
                        // console.log(data.id);
                        
                    }
                }) 
        });
    

</script>

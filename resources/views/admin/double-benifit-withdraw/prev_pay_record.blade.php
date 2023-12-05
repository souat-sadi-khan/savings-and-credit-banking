 <ul class="nav nav-tabs" id="myTab" role="tablist">
     <li class="nav-item">
         <a class="nav-link active" id="double-benifit-info-tab" data-toggle="tab" href="#double-benifit-info" role="tab"
             aria-controls="double-benifit-info" aria-selected="true">Transaction History</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
             aria-selected="false">Profile</a>
     </li>
  
 </ul>
 <div class="tab-content" id="myTabContent">


     {{-- ::::::::::    Double Benifit Info Tab Content    ::::::::: --}}
     <div class="tab-pane fade show active" id="double-benifit-info" role="tabpanel" aria-labelledby="double-benifit-info-tab">
           <div class="row" style="margin-bottom:25px;margin-top:25px">
             <div class="col-md-6">
                 <h6>General Summery</h6>
                 <hr class="my-1">
                 <span>Total: {{ $due_and_payment_status['main_amount'] }} ৳</span><br>
                 <span>Interest: {{ $due_and_payment_status['interest_amt'] }} ৳</span><br>
                 <span>Sub Total: {{ $due_and_payment_status['with_interest'] }} ৳</span><br>
                 <span>Duration: {{ $double_benifit_info->double_benifit_duration }} {{ $double_benifit_info->double_benifit_duration_type }}</span><br>
                 <span>Issue: {{ carbonDate( $double_benifit_info->issue_date) }}</span><br>

             </div>
           
             <div class="col-md-6">
                 <h6>Withdraw Summery</h6>
                 <hr class="my-1">
                 <span>Per Month Withdrawable: {{ $due_and_payment_status['per_month_withdrawable'] }} ৳</span><br>
                 <span>Total Withdraw: {{ $due_and_payment_status['total_withdraw_amt'] }} ৳</span><br>
                 <span>Total Withdraw : {{ $due_and_payment_status['total_withdraw_times'] }} Times</span><br>
                 {{-- <span>Sub Total: {{ $due_and_payment_status['due_grand_total'] }} ৳</span><br> --}}
             </div>
         </div>

         <table id="example" class="table table-striped table-bordered" style="width:100%;">
             <thead>
                 <tr class="bg-success text-light">
                     <th>#</th>
                     <th>Date</th>
                     <th>Withdraw Amount</th>
                     
                 </tr>
             </thead>
             <tbody>
                 @if ($due_and_payment_status['total_withdraw_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
                 @foreach ($transaction_info as $transaction)
                    @php
                    $i++;
                    @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{carbonDate($transaction->tx_date)}}</td>
                        <td>{{$transaction->grand_total_amt}}</td>
                        
                    </tr>
                 @endforeach

                 @else
                 <tr>
                     <td colspan="3" align="center" class="text-danger">No Withdraw Found</td>
                 </tr>
                 @endif

             </tbody>

         </table>
     </div>


     {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
         <table class="table table-bordered mt-3">
             <thead>
                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="2" class="text-light" style="background:#099286;padding:15px">
                         Member Profile 
                    </th>
                 </tr>

                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="2" class="text-light"></th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>Name</td>
                     <td>{{$member_information->name_in_bangla}}</td>
                 </tr>

                 <tr>
                     <td>ID</td>
                     <td>
                         {{$member_information->prefix}}
                         {{numer_padding($member_information->code, get_option('digits_member_code'))}}
                    </td>
                 </tr>

                 <tr>
                     <td>Father</td>
                     <td>{{$member_information->father_name}}</td>
                 </tr>

                 @if ($member_information->husband_name)
                    <tr>
                        <td>Mother</td>
                        <td>{{$member_information->mother_name}}</td>
                    </tr>
                 @endif

                 <tr>
                     <td>Mobile</td>
                     <td>{{$member_information->contact_number}}</td>
                 </tr>

                 <tr>
                    <td>Address</td>
                    <td>
                        {{$member_information->present_address_line_1}},
                        {{$member_information->present_address_line_1}}, {{$member_information->present_city}},
                        {{$member_information->present_zipcode}}
                    </td>

                 </tr>

                 <tr>
                     <td>Image</td>
                     <td>
                         <a href="{{asset('storage/member/'.$member_information->photo)}}" target="_blank">
                             <img src="{{asset('storage/member/'.$member_information->photo)}}" width="30%"
                                 alt="Image Not Uploaded." class="rounded img-thumbnail">
                         </a>
                     </td>
                 </tr>

                 <tr>
                     <td>Signature</td>
                     <td>
                         <a href="{{asset('storage/member/'.$member_information->signature)}}" target="_blank">
                             <img src="{{asset('storage/member/'.$member_information->signature)}}" width="30%"
                                 alt="Image Not Uploaded." class="rounded img-thumbnail">
                         </a>
                     </td>
                 </tr>


             </tbody>
         </table>
     </div>

     {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
     {{-- <div class="tab-pane fade" id="installment" role="tabpanel" aria-labelledby="installment-tab">
         <table class="table table-striped table-bordered  mt-3" style="width:100%;">
             <thead>
                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="2" class="text-light" style="background:#099286;padding:15px">
                         Paid Installment Information
                     </th>
                 </tr>
             </thead>
         </table>
      
     </div> --}}
 </div>

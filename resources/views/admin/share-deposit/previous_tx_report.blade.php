 <ul class="nav nav-tabs" id="myTab" role="tablist">
     <li class="nav-item">

         <a class="nav-link active" id="deposit-info-tab" data-toggle="tab" href="#deposit-info" role="tab"
             aria-controls="deposit-info" aria-selected="true">Deposit Info</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab" aria-controls="withdraw"
             aria-selected="false">withdraw Info</a>
     </li>
     {{-- <li class="nav-item">
         <a class="nav-link" id="dps-tab" data-toggle="tab" href="#dps" role="tab" aria-controls="dps"
             aria-selected="false">DPS Info</a>
     </li> --}}
     <li class="nav-item">
         <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
             aria-selected="false">Profile</a>
     </li>

 </ul>
 <div class="tab-content" id="myTabContent">


     {{-- ::::::::::    Deposit Info Tab Content    ::::::::: --}}
     <div class="tab-pane fade show active" id="deposit-info" role="tabpanel" aria-labelledby="deposit-info-tab">
         <table class="table table-striped table-bordered  mt-3" style="width:100%;">
             <thead>
                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="2" class="text-light" style="background:#099286;padding:7px">
                         Deposit Information
                     </th>
                 </tr>
             </thead>
         </table>
         <div class="row" style="margin-bottom:25px">
             <div class="col-md-12 text-center">
                 <h6>Summery</h6>
                 <hr class="my-1">
             </div>

             <div class="col-md-4">
                 <span>Total Deposit: {{ $current_share_info['total_deposit'] }} ৳</span><br>
                
                 <span>Total Savings: {{ $current_share_info['in_hand'] }} ৳</span><br>
             </div>

             <div class="col-md-4">
                 <span>Interest Withdraw: {{ $current_share_info['interest_withdraw'] }} ৳</span><br>
                 <span>Savings Withdraw: {{ $current_share_info['savings_withdraw'] }} ৳</span><br>
                 <span>Total Withdraw : {{ $current_share_info['total_withdraw'] }} ৳</span><br>
             </div>

             <div class="col-md-4" align="right">
             
                 <span>Deposit: {{ $current_share_info['deposit_times'] }} (Times)</span><br>
                 <span>Withdraw: {{ $current_share_info['withdraw_times'] }} (Times)</span><br>
             </div>

         </div>
         <div class="col-md-12 text-center">
             <h6>Deposit In Detail</h6>
             <hr class="my-1">
         </div>
         <table id="deposit_data_table" class="table table-striped table-bordered" style="width:100%;">
             <thead>
                 <tr class="bg-success text-light">
                     <th>Sl No</th>
                     <th>Invoice No</th>
                     <th>Date</th>
                     <th>Deposit Amt</th>
                 </tr>
             </thead>
             <tbody>
                 @if ($current_share_info['deposit_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
                 @foreach ($current_share_info['deposit_info'] as $deposit)
                 @php
                 $i++;
                 @endphp
                 <tr>
                     <td>{{$i}}</td>
                     <td>{{$deposit->invoice_no}}</td>
                     <td>{{carbonDate($deposit->tx_date)}}</td>
                     <td>{{$deposit->grand_total_amt}}</td>
                 </tr>
                 @endforeach

                 @else
                 <tr>
                     <td colspan="5" align="center" class="text-danger">No Deposit Of Share Found</td>
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
                     <th colspan="2" class="text-light" style="background:#099286;padding:7px">
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
                     <td>{{$member->name_in_bangla}}</td>
                 </tr>

                 <tr>
                     <td>ID</td>
                     <td>
                         {{$member->prefix}}
                         {{numer_padding($member->code, get_option('digits_member_code'))}}
                     </td>
                 </tr>

                 <tr>
                     <td>Father</td>
                     <td>{{$member->father_name}}</td>
                 </tr>

                 @if ($member->husband_name)
                 <tr>
                     <td>Mother</td>
                     <td>{{$member->mother_name}}</td>
                 </tr>
                 @endif

                 <tr>
                     <td>Mobile</td>
                     <td>{{$member->contact_number}}</td>
                 </tr>

                 <tr>
                     <td>Address</td>
                     <td>
                         {{$member->present_address_line_1}},
                         {{$member->present_address_line_1}}, {{$member->present_city}},
                         {{$member->present_zipcode}}
                     </td>

                 </tr>

                 <tr>
                     <td>Image</td>
                     <td>
                         <a href="{{asset('storage/member/'.$member->photo)}}" target="_blank">
                             <img src="{{asset('storage/member/'.$member->photo)}}" width="30%"
                                 alt="Image Not Uploaded." class="rounded img-thumbnail">
                         </a>
                     </td>
                 </tr>

                 <tr>
                     <td>Signature</td>
                     <td>
                         <a href="{{asset('storage/member/'.$member->signature)}}" target="_blank">
                             <img src="{{asset('storage/member/'.$member->signature)}}" width="30%"
                                 alt="Image Not Uploaded." class="rounded img-thumbnail">
                         </a>
                     </td>
                 </tr>


             </tbody>
         </table>
     </div>

     {{-- ::::::::::    Withdraw tab content    ::::::::: --}}
     <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
         <table class="table table-striped table-bordered  mt-3" style="width:100%;">
             <thead>
                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="2" class="text-light" style="background:#099286;padding:7px">
                         Withdraw Information
                     </th>
                 </tr>
             </thead>
         </table>
         <div class="row" style="margin-bottom:25px">
             <div class="col-md-12 text-center">
                 <h6>Summery</h6>
                 <hr class="my-1">
             </div>
             <div class="col-md-4">
                 <span>Total Deposit: {{ $current_share_info['total_deposit'] }} ৳</span><br>
                
                 <span>Total Savings: {{ $current_share_info['in_hand'] }} ৳</span><br>
             </div>

             <div class="col-md-4">
                 <span>Interest Withdraw: {{ $current_share_info['interest_withdraw'] }} ৳</span><br>
                 <span>Savings Withdraw: {{ $current_share_info['savings_withdraw'] }} ৳</span><br>
                 <span>Total Withdraw : {{ $current_share_info['total_withdraw'] }} ৳</span><br>
             </div>

             <div class="col-md-4" align="right">
             
                 <span>Deposit: {{ $current_share_info['deposit_times'] }} (Times)</span><br>
                 <span>Withdraw: {{ $current_share_info['withdraw_times'] }} (Times)</span><br>
             </div>

         </div>
         <div class="col-md-12 text-center">
             <h6>Withdraw In Detail</h6>
             <hr class="my-1">
         </div>
         <table id="withdraw_data_table" class="table table-striped table-bordered" style="width:100%;">

             <thead>
                 <tr class="bg-success text-light">
                     <th>Sl No</th>
                     <th>Invoice No</th>
                     <th>Date</th>
                     <th>Interest</th>
                     <th>Savings</th>
                     <th>Total Withdraw</th>
                 </tr>
             </thead>
             <tbody>
                 @if ($current_share_info['withdraw_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
                 @foreach ($current_share_info['withdraw_info'] as $withdraw)
                 @php
                 $i++;
                 @endphp
                 <tr>
                     <td>{{$i}}</td>
                     <td>{{$withdraw->invoice_no}}</td>
                     <td>{{carbonDate($withdraw->tx_date)}}</td>
                     <td>{{$withdraw->total_interest_amt}}</td>
                     <td>{{$withdraw->total_amt}}</td>

                     <td>{{$withdraw->grand_total_amt}}</td>
                 </tr>
                 @endforeach

                 @else
                 <tr>
                     <td colspan="7" align="center" class="text-danger">No Withdraw Of Share Found</td>
                 </tr>
                 @endif

             </tbody>

         </table>


     </div>
     
 </div>

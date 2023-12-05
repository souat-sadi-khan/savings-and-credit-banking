 <ul class="nav nav-tabs" id="myTab" role="tablist">
     <li class="nav-item">
         <a class="nav-link active" id="deposit-info-tab" data-toggle="tab" href="#deposit-info" role="tab"
             aria-controls="deposit-info" aria-selected="true">Deposit Info</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab" aria-controls="withdraw"
             aria-selected="false">withdraw Info</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" id="dps-tab" data-toggle="tab" href="#dps" role="tab" aria-controls="dps"
             aria-selected="false">DPS Info</a>
     </li>
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

             <div class="col-md-6">
                 <span>Total Deposit Amt: {{ $payment_status['total_deposit'] }} (Taka)</span><br>
                 <span>Total Withdraw : {{ $payment_status['total_withdraw'] }} (Taka)</span><br>
                 {{-- <span>Total Savings: {{ $dps_acc_info->grand_total_dps - $payment_status['total_deposit'] }} (Taka)</span><br> --}}
             </div>

             <div class="col-md-6" align="right">
                 @php
                 $duration = $dps_acc_info->dps_duration;
                 $duration_type = $dps_acc_info->dps_duration_type;
                 if ($duration_type == 'Year') {
                 $total_dps = $duration * 12 ;
                 }else {
                 $total_dps = $duration;
                 }
                 $paid_dps = $payment_status['deposit_times'];
                 $due_dps = $total_dps - $paid_dps ;

                 @endphp
                 <span>Total DPS No: {{ $total_dps }}</span><br>
                 <span>Paid DPS : {{ $paid_dps }}</span><br>
                 <span>Due DPS : {{ $due_dps }}</span><br>
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
                 @if ($payment_status['deposit_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
                 @foreach ($deposit_info as $deposit)
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
                     <td colspan="5" align="center" class="text-danger">No Deposit Of DPS Found</td>
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

     {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
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
             <div class="col-md-6">
                 <span>Total Deposit : {{ $payment_status['total_deposit'] }} (Taka)</span><br>
                 <span>Total Withdraw : {{ $payment_status['total_withdraw'] }} (Taka)</span><br>
                 {{-- <span>Total Savings: {{ $payment_status['currntly_in_hand'] }} (Taka)</span><br> --}}
             </div>

             <div class="col-md-6" align="right">
                 <span>Deposit : {{ $payment_status['deposit_times'] }} (Times)</span><br>
                 <span>Withdraw : {{ $payment_status['withdraw_times'] }} (Times)</span><br>
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
                     <th>Withdraw Amt</th>
                 </tr>
             </thead>
             <tbody>
                 @if ($payment_status['withdraw_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
                 @foreach ($withdraw_info as $withdraw)
                 @php
                 $i++;
                 @endphp
                 <tr>
                     <td>{{$i}}</td>
                     <td>{{$withdraw->invoice_no}}</td>

                     <td>{{carbonDate($withdraw->tx_date)}}</td>
                     <td>{{$withdraw->grand_total_amt}}</td>
                 </tr>
                 @endforeach

                 @else
                 <tr>
                     <td colspan="5" align="center" class="text-danger">No Withdraw Of DPS Found</td>
                 </tr>
                 @endif

             </tbody>

         </table>


     </div>
     {{-- :::::::::::: DPS Infromation :::::::::::::: --}}
     <div class="tab-pane fade  " id="dps" role="tabpanel" aria-labelledby="dps-tab">
         <table class="table table-bordered mt-3">
             <thead>
                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="4" class="text-light" style="background:#099286;padding:15px">
                         Dps Information In Detail
                     </th>
                 </tr>
                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="4" class="text-light"></th>

                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>DPS Per Month Amt</td>
                     <td>{{$dps_acc_info->per_month_dps_amt}} Taka</td>
                     <td>Interest Rate</td>
                     <td>{{$dps_acc_info->interest_rate}} %</td>
                 </tr>

                 <tr>
                     <td>Interest Amt</td>
                     <td>{{$dps_acc_info->total_interest_amt}} Taka</td>
                     <td> Duration</td>
                     <td>{{$dps_acc_info->dps_duration}} {{$dps_acc_info->dps_duration_type}}</td>
                 </tr>

                 <tr>
                     <td>Total DPS</td>
                     <td>{{$dps_acc_info->total_dps_amt}} Taka</td>
                     <td>Total DPS No</td>
                     <td>{{$total_dps}}
                     </td>

                 </tr>

                 <tr>
                     <td>Grand Total</td>
                     <td>{{$dps_acc_info->grand_total_dps}} Taka</td>
                     <td>Paid DPS No</td>
                     <td>{{$paid_dps}}</td>


                 </tr>

                 <tr>
                     <td>Paid DPS</td>
                     <td>{{$payment_status['total_deposit']}} Taka</td>
                     <td>Due DPS No</td>
                     <td>{{$due_dps}}</td>

                 </tr>

                 <tr>
                     <td>Due DPS</td>
                     <td>{{$dps_acc_info->grand_total_dps - $payment_status['total_deposit']}} Taka</td>
                     



                 </tr>

             
             </tbody>
         </table>
     </div>
 </div>

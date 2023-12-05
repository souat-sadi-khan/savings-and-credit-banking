 <ul class="nav nav-tabs" id="myTab" role="tablist">
     <li class="nav-item">
         <a class="nav-link active" id="loan-info-tab" data-toggle="tab" href="#loan-info" role="tab"
             aria-controls="loan-info" aria-selected="true">Loan Info</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
             aria-selected="false">Profile</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" id="installment-tab" data-toggle="tab" href="#installment" role="tab"
             aria-controls="installment" aria-selected="false">Installment</a>
     </li>
 </ul>
 <div class="tab-content" id="myTabContent">


     {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
     <div class="tab-pane fade show active" id="loan-info" role="tabpanel" aria-labelledby="loan-info-tab">
         <table class="table table-bordered mt-3">
             <thead>
                 <tr class="text-center" class="bg-success text-light" style="">
                    <th colspan="4" class="text-light" style="background:#099286;padding:15px">
                        Loan Information
                    </th>
                 </tr>
                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="4" class="text-light"></th>

                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>Loan Amt</td>
                     <td>{{$due_and_payment_status['main_total']}} Taka</td>
                     <td>Interest Rate</td>
                     <td>{{$loan_information->interest_rate}} %</td>
                 </tr>

                 <tr>
                     <td>Interest Amt</td>
                     <td>{{$due_and_payment_status['main_interest']}} Taka</td>
                     <td>loan Duration</td>
                     <td>{{$loan_information->loan_duration}} {{$loan_information->loan_duration_type}}</td>
                 </tr>

                 <tr>
                     <td>Total Loan</td>
                     <td>{{$due_and_payment_status['main_grand_total']}} Taka</td>
                     <td>Install Duration</td>
                     <td>{{$loan_information->installment_duration}} {{$loan_information->installment_duration_type}}
                     </td>
                     
                 </tr>

                 <tr>
                     <td>Loan Installment</td>
                     <td>{{$loan_information->installment_amount}} Taka</td>
                     <td>Total Install No</td>
                     <td>{{$loan_information->installment_no}}</td>
                      
                     
                 </tr>

                 <tr>
                     <td>Interest Install</td>
                     <td>{{$loan_information->installment_interest}} Taka</td>
                        <td>Paid Install No</td>
                     <td>{{$due_and_payment_status['paid_installment_no']}}</td>
                     
                 </tr>

                 <tr><td>Total Install</td>
                     <td>{{$loan_information->installment_total}} Taka</td>
                     <td>Due Install No</td>
                     <td>{{$due_and_payment_status['due_installment_no']}}</td>

                    
                    
                     
                 </tr>

                 <tr>
                     <td>Install Start</td>
                     <td>{{carbonDate($loan_information->issue_date)}}</td>
                     <td>Install Paid</td>
                     <td>{{$due_and_payment_status['total_installment_times']}} Times</td>
                 </tr>

                 <tr class="text-center">
                     <td colspan="2">Total Paid Loan</td>
                     <td colspan="2">{{$due_and_payment_status['paid_total']}} Taka</td>
                 </tr>

                 <tr class="text-center">
                     <td colspan="2">Total Paid Interest</td>
                     <td colspan="2">{{$due_and_payment_status['paid_interest']}} Taka</td>
                 </tr>

                 <tr class="text-center">
                     <td colspan="2">Total Paid Amount</td>
                     <td colspan="2">{{$due_and_payment_status['paid_grand_total']}} Taka</td>
                 </tr>

                 <tr class="text-center">
                     <td colspan="2">Total Due Amount</td>
                     <td colspan="2">{{$due_and_payment_status['due_grand_total']}} Taka</td>
                 </tr>

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
     <div class="tab-pane fade" id="installment" role="tabpanel" aria-labelledby="installment-tab">
         <table class="table table-striped table-bordered  mt-3" style="width:100%;">
             <thead>
                 <tr class="text-center" class="bg-success text-light" style="">
                     <th colspan="2" class="text-light" style="background:#099286;padding:15px">
                         Paid Installment Information
                     </th>
                 </tr>
             </thead>
         </table>
         <div class="row" style="margin-bottom:25px">
             <div class="col-md-4">
                 <h6>Loan Info</h6>
                 <hr class="my-1">
                 <span>Loan: {{ $due_and_payment_status['main_total'] }} ৳</span><br>
                 <span>Interest: {{ $due_and_payment_status['main_interest'] }} ৳</span><br>
                 <span>Sub Total: {{ $due_and_payment_status['main_grand_total'] }} ৳</span><br>
             </div>
             <div class="col-md-4">
                 <h6>Loan Pay Info</h6>
                 <hr class="my-1">
                 <span>Loan: {{ $due_and_payment_status['paid_total'] }} ৳</span><br>
                 <span>Interest: {{ $due_and_payment_status['paid_interest'] }} ৳</span><br>
                 <span>Sub Total: {{ $due_and_payment_status['paid_grand_total'] }} ৳</span><br>
             </div>
             <div class="col-md-4">
                 <h6>Due Info</h6>
                 <hr class="my-1">
                 <span>Loan: {{ $due_and_payment_status['due_total'] }} ৳</span><br>
                 <span>Interest: {{ $due_and_payment_status['due_interest'] }} ৳</span><br>
                 <span>Sub Total: {{ $due_and_payment_status['due_grand_total'] }} ৳</span><br>
             </div>
         </div>

         <table id="example" class="table table-striped table-bordered" style="width:100%;">
             <thead>
                 <tr class="bg-success text-light">
                     <th>#</th>
                     <th>Date</th>
                     <th>Installment</th>
                     <th>Loan</th>
                     <th>Interest</th>
                     <th>Total</th>
                 </tr>
             </thead>
             <tbody>
                 @if ($due_and_payment_status['total_installment_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
                 @foreach ($transaction_info as $transaction)
                    @php
                    $i++;
                    @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{carbonDate($transaction->created_at)}}</td>
                        <td>{{$transaction->no_of_paying_installment}}</td>
                        <td>{{$transaction->total_amt}}</td>
                        <td>{{$transaction->total_interest_amt}}</td>
                        <td>{{$transaction->grand_total_amt}}</td>
                    </tr>
                 @endforeach

                 @else
                 <tr>
                     <td colspan="6" align="center" class="text-danger">No Previous Installment Payment Found</td>
                 </tr>
                 @endif

             </tbody>

         </table>
     </div>
 </div>

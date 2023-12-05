<div class="card">

    <div class="card-body">
        {{-- in the left side I Will show Nomeene information and in the righ side i will show identifiers information  --}}
        <div class="row">
        <div class="col-md-6">
            {{-- this section will be used for nomeene information  --}}
            <div class="col-md-12 m-3 text-primary">
                <h5 class="text-left">Sponsor Information (01)</h5>
                <hr>
            </div>
            <div><span class="font-weight-bold mr-3"> Name: </span>
                <span>{{$loan_confirmation->sponsonr_name1}}</span>
            </div>
            @if ( $loan_confirmation->sponsor_fathers_name1 )

            <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                <span>{{$loan_confirmation->sponsor_fathers_name1}}</span>
            </div>
            @endif

            @if ( $loan_confirmation->sponsor_husbands_name1 )

            <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                <span>{{$loan_confirmation->sponsor_husbands_name1}}</span>
            </div>
            @endif
            <div><span class="font-weight-bold mr-3"> Account No: </span>
                <span>{{$loan_confirmation->sponsor_account_no1 }}</span>
            </div>
            <div><span class="font-weight-bold mr-3"> Address: </span>
                <span>{{$loan_confirmation->sponsor_permanent_address1 }}</span>
            </div>
            <div><span class="font-weight-bold mr-3"> Relation : </span>
                <span class="badge badge-success">
                    {{$loan_confirmation->sponsor_relation_with_member1 }}</span>
            </div>
        </div>
        <div class="col-md-6">
            {{-- this section will be used for Identifiers  information  --}}
            <div class="col-md-12 m-3 text-primary">
                <h5 class="text-left">Sponsor Information (02)</h5>
                <hr>
            </div>
            <div><span class="font-weight-bold mr-3"> Name: </span>
                <span>{{$loan_confirmation->sponsonr_name2}}</span>
            </div>
            @if ( $loan_confirmation->sponsor_fathers_name2 )

            <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                <span>{{$loan_confirmation->sponsor_fathers_name2}}</span>
            </div>
            @endif
            @if ( $loan_confirmation->sponsor_husbands_name2 )

            <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                <span>{{$loan_confirmation->sponsor_husbands_name2}}</span>
            </div>
            @endif
            <div><span class="font-weight-bold mr-3"> Account No: </span>
                <span>{{$loan_confirmation->sponsor_account_no2 }}</span>
            </div>
            <div><span class="font-weight-bold mr-3"> Address: </span>
                <span>{{$loan_confirmation->sponsor_permanent_address2 }}</span>
            </div>
            <div><span class="font-weight-bold mr-3"> Relation : </span>
                <span class="badge badge-success">
                    {{$loan_confirmation->sponsor_relation_with_member2 }}</span>
            </div>

        </div>
        {{-- business information  --}}
        <div class="col-md-6">
            <div class="col-md-12 m-3 text-primary">
                <h5 class="text-left">Business Information</h5>
                <hr>
            </div>
            <div><span class="font-weight-bold mr-3"> Name: </span>
                <span>{{$loan_confirmation->business_name}}</span>
            </div>
            @if ( $loan_confirmation->business_duration )

            <div><span class="font-weight-bold mr-3"> Duration: </span>
                <span>{{$loan_confirmation->business_duration}}
                    {{$loan_confirmation->duration_indication}}</span>
            </div>
            @endif
            @if ( $loan_confirmation->business_address )
            <div><span class="font-weight-bold mr-3"> Address: </span>
                <span>{{$loan_confirmation->business_address}}</span>
            </div>
            @endif

            @if ( $loan_confirmation->Investment )
            <div><span class="font-weight-bold mr-3"> Investment: </span>
                <span>{{$loan_confirmation->Investment}} (Taka)</span>
            </div>
            @endif

            @if ( $loan_confirmation->business_stock )
            <div><span class="font-weight-bold mr-3"> Stock: </span>
                <span>{{$loan_confirmation->business_stock}} (Taka)</span>
            </div>
            @endif

            @if ( $loan_confirmation->business_average_sell )
            <div><span class="font-weight-bold mr-3"> Average Sell: </span>
                <span>{{$loan_confirmation->business_average_sell}} (Taka/Day)</span>
            </div>
            @endif

            @if ( $loan_confirmation->business_average_income )
            <div><span class="font-weight-bold mr-3"> Average Income: </span>
                <span>{{$loan_confirmation->business_average_income}} (Taka/Day)</span>
            </div>
            @endif

           

            @if ( $loan_confirmation->business_shop_owner )
            <div><span class="font-weight-bold mr-3"> Shop Owner: </span>
                <span>{{$loan_confirmation->business_shop_owner}} </span>
            </div>
            @endif

            @if ( $loan_confirmation->shop_previous_position_owner )
            <div><span class="font-weight-bold mr-3">Previous Shop Owner: </span>
                <span>{{$loan_confirmation->shop_previous_position_owner}} </span>
            </div>
            @endif

            @if ( $loan_confirmation->position_buy_date )
            <div><span class="font-weight-bold mr-3">Position Buy Date: </span>
                <span>{{$loan_confirmation->position_buy_date}} </span>
            </div>
            @endif

            @if ( $loan_confirmation->rent_start_date )
            <div><span class="font-weight-bold mr-3">Rent Start Date: </span>
                <span>{{$loan_confirmation->rent_start_date}} </span>
            </div>
            @endif

            @if ( $loan_confirmation->shop_rent_per_month )
            <div><span class="font-weight-bold mr-3">Shop Rent: </span>
                <span>{{$loan_confirmation->shop_rent_per_month}} (Taka/Month)</span>
            </div>
            @endif

            @if ( $loan_confirmation->shop_owner_name )
            <div><span class="font-weight-bold mr-3">Shop Owner Name: </span>
                <span>{{$loan_confirmation->shop_owner_name}}</span>
            </div>
            @endif

            @if ( $loan_confirmation->shop_booked_from )
            <div><span class="font-weight-bold mr-3">Shop Booked From: </span>
                <span>{{$loan_confirmation->shop_booked_from}}</span>
            </div>
            @endif

            @if ( $loan_confirmation->investment_sector )
            <div><span class="font-weight-bold mr-3">Investment Sector: </span>
                <span>{{$loan_confirmation->investment_sector}}</span>
            </div>
            @endif

        </div>

        {{-- main row --}}
       
        {{-- in the left side I Will show Nomeene information and in the righ side i will show identifiers information  --}}
         <div class="col-md-6">
            <div class="col-md-12 m-3 text-primary">
                <h5 class="text-left">Loan Information</h5>
                <hr>
            </div>
            <div><span class="font-weight-bold mr-3">A/C No:</span>
                <span>{{$loan_confirmation->prefix.'-'.numer_padding($loan_confirmation->code, get_option('digits_loan_account_code'))}}</span>
            </div>

            @if ($loan_confirmation->loan_amount)
            <div><span class="font-weight-bold mr-3">Loan Amount: </span>
                <span>{{$loan_confirmation->loan_amount}} (Taka)</span></div>
            @endif

            @if ($loan_confirmation->interest_rate)
            <div><span class="font-weight-bold mr-3">Interest Rate: </span>
                <span>{{$loan_confirmation->interest_rate}} (%)</span></div>
            @endif

            @if ($loan_confirmation->loan_duration)
            <div><span class="font-weight-bold mr-3">Loan Duration: </span>
                <span>{{$loan_confirmation->loan_duration}}
                    ({{ $loan_confirmation->loan_duration_type }})</span></div>
            @endif

            @if ($loan_confirmation->loan_reason)
            <div><span class="font-weight-bold mr-3">Loan Reason: </span>
                <span>{{$loan_confirmation->loan_reason}}</span></div>
            @endif



            <div><span class="font-weight-bold mr-3">Applied At : </span>
                <span>{{carbonDate($loan_confirmation->created_at)}}</span></div>

            <div><span class="font-weight-bold mr-3">Status : </span>
                @if ($loan_confirmation->status=='Active')
                <span class="badge badge-success">{{($loan_confirmation->status)}}</span>
                @else
                <span class="badge badge-danger">{{($loan_confirmation->status)}}</span>

                @endif
            </div>

             @if ( $loan_confirmation->installment_no )
            <div><span class="font-weight-bold mr-3"> No Of Installment: </span>
                <span>{{$loan_confirmation->installment_no}}</span>
            </div>
            @endif

            @if ( $loan_confirmation->installment_amount )
            <div><span class="font-weight-bold mr-3"> Installment Of Capital: </span>
                <span>{{$loan_confirmation->installment_amount}} (Taka/Installment)</span>
            </div>
            @endif

            @if ( $loan_confirmation->installment_interest )
            <div><span class="font-weight-bold mr-3"> Installment Of Interest: </span>
                <span>{{$loan_confirmation->installment_interest}} (Taka/Installment)</span>
            </div>
            @endif

            @if ( $loan_confirmation->installment_total )
            <div><span class="font-weight-bold mr-3"> Total Installment: </span>
                <span>{{$loan_confirmation->installment_total}} (Taka/Installment)</span>
            </div>
            @endif

            @if ( $loan_confirmation->installment_duration )
            <div><span class="font-weight-bold mr-3"> Installment Interval: </span>
                <span>{{$loan_confirmation->installment_duration}}
                    ({{ $loan_confirmation->installment_duration_type }})</span>
            </div>
            @endif

             @if (isset($loan_confirmation->user))
            <div><span class="font-weight-bold mr-3">Created By: </span>
                <span>{{$loan_confirmation->user?$loan_confirmation->user->name:''}}</span></div>
            @endif

            @if (isset($loan_confirmation->verified))
            <div><span class="font-weight-bold mr-3">Verified By: </span>
                <span>{{$loan_confirmation->verified?$loan_confirmation->verified->name:''}}</span></div>
            @endif

            @if (isset($loan_confirmation->approved))
            <div><span class="font-weight-bold mr-3">Approved By: </span>
                <span>{{$loan_confirmation->approved?$loan_confirmation->approved->name:''}}</span></div>
            @endif

        </div>
    
    </div>
</div>

/* ------------------------------------------------------------------------------
 *
 *  # Select extension for Datatables
 *
 *  Demo JS code for datatable_extension_select.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DatatableSelect = function () {


    //
    // Setup module components
    //

    // Basic Datatable examples
    var _componentDatatableSelect = function () {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                orderable: false,
                width: 100,
                targets: [2]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                }
            }
        });

        $('.content_managment_table').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copy',
                className: 'btn btn-primary glyphicon glyphicon-duplicate'
            }, {
                extend: 'csv',
                className: 'btn btn-primary glyphicon glyphicon-save-file'
            }, {
                extend: 'excel',
                className: 'btn btn-primary glyphicon glyphicon-list-alt'
            }, {
                extend: 'pdf',
                className: 'btn btn-primary glyphicon glyphicon-file'
            }, {
                extend: 'print',
                className: 'btn btn-primary glyphicon glyphicon-print'
            }],
            columnDefs: [{
                orderable: false,
                targets: [5]
            }],

            order: [0, 'desc'],
            processing: true,
            serverSide: true,

            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex',
                    name: 'id'
                }, {
                    data: 'member',
                    name: 'member'
                }, {
                    data: 'account_no',
                    name: 'account_no'
                }, {
                    data: 'withdraw_amt',
                    name: 'withdraw_amt'
                }, {
                    data: 'date',
                    name: 'date'
                }, {
                    data: 'action',
                    name: 'action'
                }
            ]

        });


    };

    var _componentRemoteModalLoad = function () {
        $(document).on('click', '#content_managment', function (e) {
            e.preventDefault();
            //open modal
            $('#modal_remote').modal('toggle');
            // it will get action url
            var url = $(this).data('url');
            // leave it blank before ajax call
            $('.modal-body').html('');
            // load ajax loader
            $('#modal-loader').show();
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'html'
                })
                .done(function (data) {
                    $('.modal-body').html(data).fadeIn(); // load response
                    $('#modal-loader').hide();
                    $('#branch_no').focus();
                    _modalFormValidation();
                })
                .fail(function (data) {
                    $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                    $('#modal-loader').hide();
                });
        });

        // ::::: Ajax Select2 For Getting Members By typing Name Mobile No Email ::::::::::
        $(function () {
            $("#member_id").select2({
                ajax: {
                    url: "/admin/loan/loan-repay/search-member",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data.items,
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a Member',
                minimumInputLength: 1,
                escapeMarkup: function (markup) {
                    return markup;
                },
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo(repo) {
                if (repo.loading) return repo.text;

                var markup = '<div class="select2-result-repository clearfix">' +
                    '<div class="select2-result-repository__title">' + repo.name + '</div></div>';

                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.name || repo.text;
            }

        });

        // :::::::::   Get Active Savings Account While Changing Member :::::::::::
        $(document).on('change', '#member_id', function () {
            var member_id = $(this).val();
            var url = $(this).data('url');

            // // making values empty
            $("#total_savings").val('');
            $("#grand_total_savings").val('');
            $("#savings_in_hand").val('');

            $("#previous_payment_records").html('');

            $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        member_id: member_id
                    },
                    dataType: 'json'
                })
                .done(function (data) {
                    $("#savings_acc_id").html(data.options);
                })
        });



        // :::  Show Hide Input fields According To Change Of Payment Method :::::
        $(document).on('change', '#payment_method', function () {
            var payment_method = $(this).val();
            if (payment_method == 'Cash') {
                $(".mobile_banking").hide(500);
                $(".bank_check").hide(500);
                $(".mobile_banking").val('');
                $(".bank_check").val('');
                $(".mobile_banking_required").attr('required', false);
                $(".bank_check_required").attr('required', false);

            } else if (payment_method == 'Bank Check') {
                $(".mobile_banking").hide(500);
                $(".bank_check").show(500);
                $(".mobile_banking").val('');
                $(".bank_check").val('');
                $(".mobile_banking_required").attr('required', false);
                $(".bank_check_required").attr('required', true);

            } else if (payment_method == 'Mobile Banking') {
                $(".mobile_banking").show(500);
                $(".bank_check").hide(500);
                $(".mobile_banking").val('');
                $(".mobile_banking_required").attr('required', true);
                $(".bank_check_required").attr('required', false);
                $(".bank_check").val('');

            }
        });

        // :::::::::     Get Savings information while changing savings account id  :::::::::::
        $(document).on('change', '#savings_acc_id', function () {
            var savings_acc_id = $(this).val();
            var url = $(this).data('url');
            $("#total_savings").val('');
            $("#grand_total_savings").val('');
            $("#savings_in_hand").val('');
            $("#interest_withdraw").val(0);
            $("#new_withdraw").val(0);

            $("#previous_payment_records").html('');
            $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        savings_acc_id: savings_acc_id
                    },
                    dataType: 'json'
                })
                .done(function (data) {
                    $("#total_savings").val(data.payment_status.currntly_in_hand);
                    $("#grand_total_savings").val(data.payment_status.currntly_in_hand);
                    $("#savings_in_hand").val(data.payment_status.currntly_in_hand);
                    $("#interest_withdraw").val(data.payment_status.withdrawable_interest);
                    $("#new_withdraw").val(0);
                    $("#interest_withdraw_calc").val(data.payment_status.withdrawable_interest);
                    $("#interest_withdraw").attr('placeholder', 'Maximum : ' + data.payment_status.withdrawable_interest + ' (Taka)');

                    $("#previous_payment_records").html(data.previous_payment_records);
                })
        });

        // calculating grand total while changing new withdraw amount
        $(document).on('change keyup', '#new_withdraw', function () {
            var new_withdraw = is_number($(this).val());
            var savings_in_hand = is_number($("#savings_in_hand").val());

            var grand_total = savings_in_hand * 1 - new_withdraw * 1;
            $("#grand_total_savings").val(grand_total);



        });
        $(document).on('change keyup', '#interest_withdraw', function () {
            var interest_withdraw = parseFloat($(this).val());
            var interest_withdraw_calc = parseFloat($('#interest_withdraw_calc').val());

            if (interest_withdraw > interest_withdraw_calc) {
                $(this).val(0);
                swal("Be Careful !", "Maximum Withdrawable Interest Amt : " + interest_withdraw_calc + ' (Taka) But You Are Going To Wihtdraw ' + interest_withdraw + ' (Taka).', "error");

            }

        })
        $(document).on('blur', '#new_withdraw', function () {
            var new_withdraw = is_number($(this).val());
            var savings_in_hand = is_number($("#savings_in_hand").val());

            var grand_total = savings_in_hand * 1 - new_withdraw * 1;


            if (parseInt(grand_total) < 200 && parseInt(grand_total) < 0) {
                $("#new_withdraw").val(0)
                var total_savings_till_now = is_number($("#total_savings").val());
                $("#grand_total_savings").val(total_savings_till_now)

                swal("Be Careful! ", "You Can Not Withdraw More Than The Savings Amount. Total Savings Amount Is: " + savings_in_hand, "error");
            } else if (parseInt(grand_total) < 200) {
                swal("Be Careful! ", "If Your Savings Is Less Than  200 Taka The Account Will be Deactivated", "error");
            }
        });
    };



    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _componentDatatableSelect();
            _componentRemoteModalLoad();
            _componentSelect2Normal();
            _componentDatePicker();
            _formValidation();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    DatatableSelect.init();
});

function is_number(value) {
    if (value == null || value == "" || isNaN(value)) {
        return 0;
    } else {
        return value;
    }
}

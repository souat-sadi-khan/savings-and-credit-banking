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
                targets: [-1]
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
                    data: 'loan_info',
                    name: 'loan_info'
                }, {
                    data: 'nomenee',
                    name: 'nomenee'
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


$(document).ready(function () {

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

            $("#transaction_date_div").show(500);
            $("#tx_date").val('');

        } else if (payment_method == 'Bank Check') {
            $(".mobile_banking").hide(500);
            $(".bank_check").show(500);
            $(".mobile_banking").val('');
            $(".bank_check").val('');
            $(".mobile_banking_required").attr('required', false);
            $(".bank_check_required").attr('required', true);

            $("#transaction_date_div").hide(500);
            $("#tx_date").val('');

        } else if (payment_method == 'Mobile Banking') {
            $(".mobile_banking").show(500);
            $(".bank_check").hide(500);
            $(".mobile_banking").val('');
            $(".mobile_banking_required").attr('required', true);
            $(".bank_check_required").attr('required', false);
            $(".bank_check").val('');

            $("#transaction_date_div").show(500);
            $("#tx_date").val('');

        }
    });

    // :::::::::   Get Loan Of a Member While Changing The Member :::::::::::
    $(document).on('change', '#member_id', function () {
        var member_id = $(this).val();
        var url = $(this).data('url');

        // making values empty
        $("#new_deposit_amount").val('');
        $("#in_hand").val('');
        $("#grand_total").val('');
        $("#share_in_hand").val('');
        $("#share_account").val('');
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
                $("#previous_payment_records").html(data.previous_transaction_information);
                $('#share_in_hand').val(data.in_hand)
                $('#in_hand').val(data.in_hand)
                $('#grand_total').val(data.in_hand)
                $('#share_account').val(data.share_id)
                // $('#share_account').val(data.share_id)
                // $('#interest_withdraw').val(data.share_withdrawable);
                // console.log(data.share_withdrawable);
                $("#new_withdraw").val(0);
                $("#interest_withdraw").val(data.share_withdrawable);
                $("#interest_withdraw_calc").val(data.share_withdrawable);
                $("#interest_withdraw").attr('placeholder', 'Maximum : ' + data.share_withdrawable + ' (Taka)');

            })
    });

    $(document).on('change keyup', '#interest_withdraw', function () {
        var interest_withdraw = parseFloat($(this).val());
        var interest_withdraw_calc = parseFloat($('#interest_withdraw_calc').val());

        if (interest_withdraw > interest_withdraw_calc) {
            $(this).val(0);
            swal("Be Careful !", "Maximum Withdrawable Interest Amt : " + interest_withdraw_calc + ' (Taka) But You Are Going To Wihtdraw ' + interest_withdraw + ' (Taka).', "error");

        }

    })

    // calculating grand total while changing new withdraw amount
    $(document).on('change keyup', '#new_withdraw', function () {
        var new_withdraw = parseFloat($(this).val());
        var savings_in_hand = parseFloat($("#share_in_hand").val());

        if (new_withdraw > savings_in_hand) {
            $(this).val(0);
            $("#grand_total").val(savings_in_hand);
            swal("Be Careful !", "Maximum Withdrawable Savings Amt : " + savings_in_hand + ' (Tk) But You Are Going To Wihtdraw ' + new_withdraw + ' (Tk).', "error");
        } else if (new_withdraw < 0) {
            $(this).val(0);
            $("#grand_total").val(savings_in_hand);
            swal("Be Careful !", 'Negative Value Not Allowed.', "error");
        } else {

            var grand_total = savings_in_hand * 1 - new_withdraw * 1;
            $("#grand_total").val(grand_total);
        }




    });

    // $(document).on('keyup blur change', '#new_deposit_amount', function () {
    //     var new_deposit_amount = is_number($(this).val());
    //     var in_hand = is_number($('#share_in_hand').val());
    //     var grand_total = new_deposit_amount * 1 + in_hand * 1;

    //     $('#grand_total').val(grand_total);
    // })

});


// ::::: Ajax Select2 For Getting Members By typing Name Mobile No Email ::::::::::
$(function () {
    $("#member_id").select2({
        ajax: {
            url: "/admin/share/share-deposit/search-member",
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


function is_number(value) {
    if (value == null || value == "" || isNaN(value)) {
        return 0;
    } else {
        return value;
    }
}

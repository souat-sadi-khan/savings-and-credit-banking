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

    // :::::::::   Get Loan Of a Member While Changing The Member :::::::::::
    $(document).on('change', '#member_id', function () {
        var member_id = $(this).val();
        var url = $(this).data('url');

        // making values empty
        $("#no_of_paying_installment").val('');
        $("#repay_loan").val('');
        $("#repay_interest").val('');
        $("#total_repay").val('');

        $("#loan_due").val('');
        $("#interest_due").val('');
        $("#total_due").val('');

        // now put the hidden field values
        $("#main_total").val('');
        $("#main_interest").val('');
        $("#main_grand_total").val('');

        $("#paid_total").val('');
        $("#paid_interest").val('');
        $("#paid_grand_total").val('');

        $("#loan_per_installment").val('');
        $("#interest_per_installment").val('');
        $("#grand_total_per_installment").val('');

        $("#installment_paid").val('');
        $.ajax({
                url: url,
                type: 'post',
                data: {
                    member_id: member_id
                },
                dataType: 'json'
            })
            .done(function (data) {
                $("#loan_id").html(data.options);
            })
    });

    // :::::::::     Get Loan Information while changing loan id  :::::::::::
    $(document).on('change', '#loan_id', function () {
        var loan_id = $(this).val();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'post',
                data: {
                    loan_id: loan_id
                },
                dataType: 'json'
            })
            .done(function (data) {
                $("#no_of_paying_installment").val('1');
                $("#repay_loan").val(data.loan_information.installment_amount.toFixed(2));
                $("#repay_interest").val(data.loan_information.installment_interest.toFixed(2));
                $("#total_repay").val(data.loan_information.installment_total.toFixed(2));

                // due calculation reducing one installment 
                var loan_due = data.due_and_payment_status.due_total - data.loan_information.installment_amount;
                var interest_due = data.due_and_payment_status.due_interest - data.loan_information.installment_interest;
                var total_due = data.due_and_payment_status.due_grand_total - data.loan_information.installment_total;

                $("#loan_due").val(loan_due.toFixed(2));
                $("#interest_due").val(interest_due.toFixed(2));
                $("#total_due").val(total_due.toFixed(2));

                // now put the hidden field values
                $("#main_total").val(data.due_and_payment_status.main_total.toFixed(2));
                $("#main_interest").val(data.due_and_payment_status.main_interest.toFixed(2));
                $("#main_grand_total").val(data.due_and_payment_status.main_grand_total.toFixed(2));

                $("#paid_total").val(data.due_and_payment_status.paid_total.toFixed(2));
                $("#paid_interest").val(data.due_and_payment_status.paid_interest.toFixed(2));
                $("#paid_grand_total").val(data.due_and_payment_status.paid_grand_total.toFixed(2));

                $("#loan_per_installment").val(data.loan_information.installment_amount.toFixed(2));
                $("#interest_per_installment").val(data.loan_information.installment_interest.toFixed(2));
                $("#grand_total_per_installment").val(data.loan_information.installment_total.toFixed(2));

                $("#installment_paid").val(data.due_and_payment_status.total_installment_times + ' Times');

                $("#previous_payment_records").html(data.previous_payment_records);

                $("#paid_installment").val(data.due_and_payment_status.paid_installment_no);
                $("#due_installment").val(data.due_and_payment_status.due_installment_no);
                // console.log(data.previous_payment_records);

            })
    });

    // Calculate Pay info if No of installment is changed
    $(document).on('keyup change', '#no_of_paying_installment', function () {
        var no_of_isntallment = $(this).val();
        var due_installment = $("#due_installment").val();

        var main_total = $("#main_total").val();
        var main_interest = $("#main_interest").val();
        var main_grand_total = $("#main_grand_total").val();

        var paid_total = $("#paid_total").val();
        var paid_interest = $("#paid_interest").val();
        var paid_grand_total = $("#paid_grand_total").val();

        if (parseInt(no_of_isntallment) > parseInt(due_installment)) {
            swal("Remember", "No Of Due Installment Is :" + due_installment, "error");
            $(this).val('');
            $("#total_repay").val('');
            $("#repay_interest").val('');
            $("#repay_loan").val('');

            var loan_due = main_total - paid_total;
            var interest_due = main_interest - paid_interest;
            var total_due = main_grand_total - paid_grand_total;

            $("#loan_due").val(loan_due.toFixed(2));
            $("#interest_due").val(interest_due.toFixed(2));
            $("#total_due").val(total_due.toFixed(2));
        } else if (parseInt(no_of_isntallment) < parseInt(due_installment)) {

            var installment_loan = $("#loan_per_installment").val();
            var installment_interest = $("#interest_per_installment").val();
            var installment_total = $("#grand_total_per_installment").val();

            var new_pay_loan = installment_loan * no_of_isntallment;
            var new_pay_interest = installment_interest * no_of_isntallment;
            var new_pay_total = installment_total * no_of_isntallment;

            var loan_due = main_total - paid_total - new_pay_loan;
            var interest_due = main_interest - paid_interest - new_pay_interest;
            var total_due = main_grand_total - paid_grand_total - new_pay_total;

            $("#total_repay").val(new_pay_total.toFixed(2));
            $("#repay_interest").val(new_pay_interest.toFixed(2));
            $("#repay_loan").val(new_pay_loan.toFixed(2));

            $("#loan_due").val(loan_due.toFixed(2));
            $("#interest_due").val(interest_due.toFixed(2));
            $("#total_due").val(total_due.toFixed(2));
        } else if (parseInt(no_of_isntallment) == parseInt(due_installment)) {

            var installment_loan = $("#loan_per_installment").val();
            var installment_interest = $("#interest_per_installment").val();
            var installment_total = $("#grand_total_per_installment").val();

            var loan = main_total - paid_total;
            var installment = main_interest - paid_interest;
            var grand_total = main_grand_total - paid_grand_total;

            var new_pay_loan = loan;
            var new_pay_interest = installment;
            var new_pay_total = grand_total;

            var loan_due = main_total - paid_total - new_pay_loan;
            var interest_due = main_interest - paid_interest - new_pay_interest;
            var total_due = main_grand_total - paid_grand_total - new_pay_total;

            $("#total_repay").val(new_pay_total.toFixed(2));
            $("#repay_interest").val(new_pay_interest.toFixed(2));
            $("#repay_loan").val(new_pay_loan.toFixed(2));

            $("#loan_due").val(loan_due.toFixed(2));
            $("#interest_due").val(interest_due.toFixed(2));
            $("#total_due").val(total_due.toFixed(2));
        }

    })
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

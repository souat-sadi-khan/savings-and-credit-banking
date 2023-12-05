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
                    data: 'image',
                    name: 'image'
                }, {
                    data: 'member',
                    name: 'member'
                }, {
                    data: 'business',
                    name: 'business'
                }, {
                    data: 'loan',
                    name: 'loan'
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

    $(document).on('change', '#member_id', function () {
        var member_id = $(this).val();
        var url = $(this).data('url');
        $("#member_permanent_address").val('');
        $("#member_image").attr('src', "");

        $.ajax({
            url: url,
            data: {
                member_id: member_id
            },
            type: 'Get',
            dataType: 'json',
            success: function (data) {
                $("#member_permanent_address").val('Father: ' + data.member_info
                    .father_name +
                    ', Address: ' + data.member_info.present_address_line_1);
                $("#member_image").attr('src', data.image);
                $("#member_sign").attr('src', data.sign);
                // console.log(data.id);

            }
        })
    });

    $(document).on('change', '#zone', function () {
        var zone_id = $(this).val();
        var url = $(this).data('url');
        $("#area").html('<option value="">Please Select One ..</option>');

        $.ajax({
            url: url,
            data: {
                zone_id: zone_id
            },
            type: 'Get',
            dataType: 'json',
            success: function (data) {
                $("#area").html(data);
            }
        })
    });

    $(document).on('change', '#loan_type', function () {
        var loan_type_id = $(this).val();
        var url = $(this).data('url');
        // $("#area").html('<option value="">Please Select One ..</option>');
        var loan_amt = $("#loan_amount").val();
        $("#installment_no").val("");
        $("#installment_amount").val("");
        $("#loan_duration").val("");
        $("#interest_rate").val("");
        $.ajax({
            url: url,
            data: {
                loan_type_id: loan_type_id
            },
            type: 'Get',
            dataType: 'json',
            success: function (data) {
                $("#loan_duration").val(data.duration);
                $("#interest_rate").val(data.rate);
                $("#loan_duration_type").val(data.duration_type).trigger('change');
                $("#installment_duration").val(data.installment_period);
                $("#installment_duration_type").val(data.installment_period_type)
                    .trigger('change');

                var loan_period = duration_into_days(data.duration_type, data.duration);
                var installment_period = duration_into_days(data.installment_period_type, data.installment_period);

                var installment_no = Math.floor(loan_period / installment_period);
                // console.log(install);

                var total_interest = (data.rate * loan_amt) / 100;
                var installment_amt = loan_amt / installment_no;
                var installment_amt_interest = total_interest / installment_no;
                var total_installment = installment_amt * 1 + installment_amt_interest * 1;

                $("#installment_no").val(installment_no);
                $("#installment_amount").val(installment_amt);
                $("#installment_interest").val(installment_amt_interest);
                $("#installment_total").val(total_installment);

                // installment_calc();
            }
        })
    });

    $(document).on('keyup blur change', '#installment_no', function () {
        installment_calc();
    });
    $(document).on('keyup blur change', '#loan_amount', function () {
        installment_calc();

    });

    $(document).on('keyup blur change', '#interest_rate', function () {
        installment_calc();
    });

    $(document).on('keyup blur change', '#loan_duration', function () {
        validate_duration();
    });

    $(document).on('change', '#loan_duration_type', function () {

        validate_duration();

    });

    $(document).on('keyup blur change', '#installment_duration', function () {
        validate_duration();
    });

    $(document).on('change', '#installment_duration_type', function () {
        validate_duration();
    });
    $(document).on('click', '#round', function () {
        installment_calc();
    });

    $(document).on('change', "#business_shop_owner", function () {
        var business_shop_owner = $(this).val();

        if (business_shop_owner == 'Rent') {
            $('.own_shop_input').val('');
            $('.rent_shop_input').val('');
            $('.rent_shop').show('500');
            $('.own_shop').hide('500');
        } else {
            $('.own_shop_input').val('');
            $('.rent_shop_input').val('');
            $('.rent_shop').hide('500');
            $('.own_shop').show('500');
        }

    });

    $(document).on('submit', '#approve_form', function (e) {
        e.preventDefault();
        $(".ajax_error").remove();
        var formData = new FormData($("#approve_form")[0]);
        var submit_url = $('#approve_form').attr('action');
        swal({
            title: "Are you sure to update?",
            // text: msg,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Change it!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $('#submit').hide();
                $('#submiting').show()
                $.ajax({
                    url: submit_url,
                    type: 'POST',
                    data: formData,
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    dataType: 'JSON',
                    success: function (data) {

                        toastr.success(data.message);
                        $('#submit').show();
                        $('#submiting').hide();
                        if (data.load) {
                            setTimeout(function () {
                                window.location.href = "";
                            }, 2500);
                        }
                    },
                    error: function (data) {
                        var jsonValue = $.parseJSON(data.responseText);
                        const errors = jsonValue.errors;
                        if (errors) {
                            var i = 0;
                            $.each(errors, function (key, value) {
                                const first_item = Object.keys(errors)[i]
                                const message = errors[first_item][0];
                                if ($('#' + first_item + '_error').length > 0) {
                                    $('#' + first_item + '_error').html('<span style="color:red" class="ajax_error">' + value + '</span>');
                                } else {
                                    $('#' + first_item).after('<span style="color:red" class="ajax_error">' + value + '</span>');
                                }

                                toastr.error(value);
                                i++;
                            });
                        } else {
                            toastr.error(jsonValue.message);

                        }
                        _componentSelect2Normal();
                        $('#submit').show();
                        $('#submiting').hide();
                    }
                });
            }
        })

    });

    $(document).on('change', '#issue_date', function () {

        var issue_date = $(this).val();
        var url = $(this).data('url');
        var duration = $('#loan_duration').val();
        var duration_type = $('#loan_duration_type').val();
        console.log(duration_type);
        $.ajax({
            url: url,
            data: {
                issue_date: issue_date,
                duration: duration,
                duration_type: duration_type
            },
            type: 'Get',
            dataType: 'json',
            success: function (data) {
                $("#completion_date").val(data.completation_date);
            }
        })
    });
});


function installment_calc() {
    var loan_amt = check_null_value($("#loan_amount").val());
    var interest_rate = check_null_value($("#interest_rate").val());
    var loan_duration = check_null_value($("#loan_duration").val());
    var duration_type = $("#loan_duration_type").val();

    var installment_duration = check_null_value($("#installment_duration").val());
    var installment_duration_type = $("#installment_duration_type").val();
    var total_interest = (interest_rate * loan_amt) / 100;

    var installment_no = check_null_value($("#installment_no").val());
    var installment_period = 0;
    var loan_period = 0;
    // converting loan duration and installment duration into date
    loan_period = duration_into_days(duration_type, loan_duration);
    installment_period = duration_into_days(installment_duration_type, installment_duration);
    // preventing not to devide by zero
    if (installment_period) {
        // installment_no = Math.floor(loan_period / installment_period);
        var installment_amt = loan_amt / installment_no;
        var installment_amt_interest = total_interest / installment_no;
        var total_installment = installment_amt * 1 + installment_amt_interest * 1;


        // if for rounding the check box is checked then the round funcition will be executed
        if ($("#round").prop("checked") == true) {
            installment_amt = Math.round(installment_amt);
            installment_amt_interest = Math.round(installment_amt_interest);
            total_installment = installment_amt * 1 + installment_amt_interest * 1;
        } else {
            total_installment = total_installment.toFixed(2);
            installment_amt = installment_amt.toFixed(2);
            installment_amt_interest = installment_amt_interest.toFixed(2);
        }

        // $("#installment_no").val(installment_no);
        $("#installment_amount").val(installment_amt);
        $("#installment_interest").val(installment_amt_interest);
        $("#installment_total").val(total_installment);

    } else {
        var installment_amt = 0;
        var installment_amt_interest = 0;
        var total_installment = 0;
    }

}
//  checking wheather a value is null or not
function check_null_value(check_value) {
    if (check_value == '' || isNaN(check_value) || check_value == null) {
        return 0;
    } else {
        return check_value;
    }
}

// converting loan duration and installment duration into days for further calculation
function duration_into_days(duration_type, duration) {
    var loan_period = 0;
    if (duration_type == 'Day') {
        loan_period = duration;
    } else if (duration_type == 'Week') {
        loan_period = duration * 7;
    } else if (duration_type == 'Month') {
        loan_period = duration * 30;
    } else if (duration_type == 'Year') {
        loan_period = duration * 365;
    }

    return loan_period;
}

// checking wheather laon duration is greter than the linstallment dureatio . if not so then giving a warning else calculation is performing
function validate_duration() {
    var loan_duration = check_null_value($("#loan_duration").val());
    var duration_type = $("#loan_duration_type").val();

    var installment_duration = check_null_value($("#installment_duration").val());
    var installment_duration_type = $("#installment_duration_type").val();

    var installment_no = 0;
    var installment_period = 0;
    var loan_period = 0;
    // converting loan duration and installment duration into date
    loan_period = duration_into_days(duration_type, loan_duration);
    installment_period = duration_into_days(installment_duration_type, installment_duration);
    if (loan_duration && duration_type && installment_duration && installment_duration_type) {
        if (parseInt(loan_period) < parseInt(installment_period)) {
            // giving alert and making values empty
            swal({
                title: "Be Careful,Installment Period Cannot Be Greater Than The Loan Period...",
                type: "warning",
                confirmButtonText: "Ok",
                closeOnConfirm: true,
            })
            console.log("Sohag");
            $("#installment_no").val("");
            $("#installment_amount").val("");
            $("#installment_interest").val("");
            $("#installment_total").val("");

            $("#loan_duration").val(0);
            $("#loan_duration_type").val('').trigger('change');

            $("#installment_duration").val(0);
            $("#installment_duration_type").val('').trigger('change');
        } else {
            installment_calc();
        }
    }
}

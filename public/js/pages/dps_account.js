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
                    data: 'dps',
                    name: 'dps'
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

    $(document).on('change', '#identity_provider_id', function () {
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
                $("#identity_provider_address").val('Father: ' + data.member_info
                    .father_name +
                    ', Address: ' + data.member_info.present_address_line_1);
                $("#identity_provider_photo").attr('src', data.image);
                $("#identity_provider_signature").attr('src', data.sign);
                // console.log(data.id);

            }
        })
    });



    $(document).on('change', '#dps_type', function () {
        var dps_type_id = $(this).val();
        var url = $(this).data('url');
        // $("#area").html('<option value="">Please Select One ..</option>');
        var dps_amt = $("#dps_amount").val();
        $("#installment_no").val("");
        $("#installment_amount").val("");
        $("#loan_duration").val("");
        $("#interest_rate").val("");
        $.ajax({
            url: url,
            data: {
                dps_type_id: dps_type_id
            },
            type: 'Get',
            dataType: 'json',
            success: function (data) {
                $("#loan_duration").val(data.duration);
                $("#interest_rate").val(data.rate);
                $("#dps_duration_type").val(data.duration_type).trigger('change');
                $("#dps_duration").val(data.duration);
                $("#installment_duration_type").val(data.installment_period_type)
                    .trigger('change');
                installment_calc();
            }
        })
    });

    $(document).on('keyup blur change', '#per_month_dps_amt', function () {
        installment_calc();

    });

    $(document).on('keyup blur change', '#interest_rate', function () {
        installment_calc();
    });

    $(document).on('keyup blur change', '#dps_duration', function () {
        installment_calc();
    });

    $(document).on('change', '#dps_duration_type', function () {
        installment_calc();
    });


    $(document).on('click', '#round', function () {
        installment_calc();
    });

    $(document).on('submit', '#approve_form', function (e) {
        e.preventDefault();;
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
        // console.log(duration_type);
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
    var per_month_dps_amt = check_null_value($("#per_month_dps_amt").val());
    var interest_rate = check_null_value($("#interest_rate").val());
    var dps_duration = check_null_value($("#dps_duration").val());
    var dps_duration_type = $("#dps_duration_type").val();


    // var total_interest = (interest_rate * loan_amt) / 100;

    if (dps_duration_type == 'Year') {
        dps_duration = dps_duration * 12;
    }


    interest = interest_rate / 100;
    per_month_interest = per_month_dps_amt * interest / 12;
    var total_interest_amt = 0;
    var i = 0;
    for (i = 1; i <= dps_duration; i++) {
        total_interest_amt += i * per_month_interest;
    }

    total_dps_amt = dps_duration * per_month_dps_amt;
    // total_interest_amt = total_dps_amt * interest_rate / 100;
    grand_total_dps = total_dps_amt * 1 + total_interest_amt * 1;


    // if for rounding the check box is checked then the round funcition will be executed
    if ($("#round").prop("checked") == true) {
        total_dps_amt = Math.round(total_dps_amt);
        total_interest_amt = Math.round(total_interest_amt);
        grand_total_dps = total_dps_amt * 1 + total_interest_amt * 1;
    } else {
        total_dps_amt = total_dps_amt.toFixed(2);
        total_interest_amt = total_interest_amt.toFixed(2);
        grand_total_dps = grand_total_dps.toFixed(2);
    }

    // alert(total_dps_amt);
    $("#total_dps_amt").val(total_dps_amt);
    $("#total_interest_amt").val(total_interest_amt);
    $("#grand_total_dps").val(grand_total_dps);


}
//  checking wheather a value is null or not
function check_null_value(check_value) {
    if (check_value == '' || isNaN(check_value)) {
        return 0;
    } else {
        return check_value;
    }
}

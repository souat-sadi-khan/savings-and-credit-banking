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
                    data: 'double_benifit',
                    name: 'double_benifit'
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



    $(document).on('change', '#double_benifit_type', function () {
        var double_benifit_type_id = $(this).val();
        var url = $(this).data('url');
        // $("#area").html('<option value="">Please Select One ..</option>');
        var double_benifit_amt = $("#double_benifit_amount").val();
        $("#installment_no").val("");
        $("#installment_amount").val("");
        $("#loan_duration").val("");
        $("#interest_rate").val("");
        $.ajax({
            url: url,
            data: {
                double_benifit_type_id: double_benifit_type_id
            },
            type: 'Get',
            dataType: 'json',
            success: function (data) {
                $("#double_benifit_duration_type").val(data.duration_type).trigger('change');
                $("#double_benifit_duration").val(data.duration);
                installment_calc();
            }
        })
    });

    $(document).on('keyup blur change', '#double_benifit_amt', function () {
        installment_calc();

    });

    $(document).on('keyup blur change', '#interest_rate', function () {
        installment_calc();
    });

    $(document).on('keyup blur change', '#double_benifit_duration', function () {
        installment_calc();
    });

    $(document).on('change', '#double_benifit_duration_type', function () {
        installment_calc();
    });


    $(document).on('click', '#round', function () {
        installment_calc();
    });

    $(document).on('submit', '#approve_form', function (e) {
        e.preventDefault();

        if ($('#approve_form').parsley().isValid()) {
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

        } else {
            $('#approve_form').parsley().validate();
        }
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
    var double_benifit_amt = check_null_value($("#double_benifit_amt").val());
    // var interest_rate = check_null_value($("#interest_rate").val());

    total_interest_amt = double_benifit_amt * 1;
    grand_total_double_benifit = double_benifit_amt * 1 + total_interest_amt * 1;

    // Now Its Time to Calculate Interest Rate

    var duration = $("#double_benifit_duration").val();
    var duration_type = $("#double_benifit_duration_type").val();

    var months = 0;
    if (duration_type == 'Year') {
        months = duration * 12;
    } else if (duration_type == 'Month') {
        months = duration
    }

    var interest_rate = 100 / months;

    // if for rounding the check box is checked then the round funcition will be executed
    if ($("#round").prop("checked") == true) {
        total_interest_amt = Math.round(total_interest_amt);
        grand_total_double_benifit = Math.round(grand_total_double_benifit);
    } else {
        total_interest_amt = total_interest_amt.toFixed(2);
        grand_total_double_benifit = grand_total_double_benifit.toFixed(2);
    }
    $('#interest_rate').val(interest_rate.toFixed(2));
    $("#total_interest_amt").val(total_interest_amt);
    $("#grand_total_double_benifit").val(grand_total_double_benifit);

}

//  checking wheather a value is null or not
function check_null_value(check_value) {
    if (check_value == '' || isNaN(check_value)) {
        return 0;
    } else {
        return check_value;
    }
}

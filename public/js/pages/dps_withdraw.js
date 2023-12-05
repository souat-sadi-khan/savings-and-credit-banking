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


    // :::::::::     Get Loan Information while changing loan id  :::::::::::
    $(document).on('change', '#dps_id', function () {
        // $("#withdraw_type").val('').trigger('change');
        $("#withdrawable_dps").val('');
        $("#withdrawable_interest").val('');
        $("#withdrawable").val('');
        $("#now_withdrable_total_calc").val('');
        $('#expiry_reminder').hide('5000');
        $('#incomplete_reminder').hide('5000');
        $("#previous_payment_records").html('');

        var dps_id = $(this).val();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'post',
                data: {
                    dps_id: dps_id
                },
                dataType: 'json'
            })
            .done(function (data) {

                $("#previous_payment_records").html(data.previous_payment_records);
                $("#now_withdrable_total_calc").val(data.due_and_payment_status.now_withdrable_dps);

                $("#withdrawable_dps").val(data.due_and_payment_status.now_withdrable_dps);
                $("#withdrawable_interest").val(data.due_and_payment_status.now_withdrable_interest);
                $("#withdrawable").val(data.due_and_payment_status.now_total_withdrawable);

                if (data.due_and_payment_status.expiry == 'No' && data.due_and_payment_status.dps_completation == 'No') {
                    $('#expiry_reminder').show('5000');
                    $('#incomplete_reminder').hide('5000');
                } else if (dps_completation == 'No' && expiry == 'yes') {
                    $('#incomplete_reminder').show('5000');
                    $('#expiry_reminder').hide('5000');
                } else {
                    $('#incomplete_reminder').hide('5000');
                    $('#expiry_reminder').hide('5000');
                }

            })
    });

    // :::::::::   Get Loan Of a Member While Changing The Member :::::::::::
    $(document).on('change', '#member_id', function () {
        var member_id = $(this).val();
        var url = $(this).data('url');

        // making values empty


        $("#withdrawable_dps").val('');
        $("#withdrawable_interest").val('');
        $("#withdrawable").val('');
        $("#now_withdrable_total_calc").val('');
        $('#expiry_reminder').hide('5000');
        $('#incomplete_reminder').hide('5000');
        $("#previous_payment_records").html('');

        $("#dps_id").html(' <option value="">Please Select Member First ...</option>');


        $.ajax({
                url: url,
                type: 'post',
                data: {
                    member_id: member_id
                },
                dataType: 'json'
            })
            .done(function (data) {
                $("#dps_id").html(data.options);
            })
    });

    // change withdrawable interest
    $(document).on('change keyup blur', '#withdrawable_interest', function () {
        var interest = $(this).val();
        var dps = $('#now_withdrable_total_calc').val();
        var dps_id = $('#dps_id').val();

        if (isNaN(dps) || dps == '' || dps == null) {
            dps = 0;
        }

        if (isNaN(interest) || interest == '' || interest == null) {
            interest = 0;
        }



        // alert(dps_id);

        if (dps_id == null || dps_id == '' || isNaN(dps_id)) {
            swal({
                title: "Please Select A DPS Account",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: true
            });
        } else {

            var total = parseFloat(interest) + parseFloat(dps);
            $('#withdrawable').val(total);

        }

    });
});


// ::::: Ajax Select2 For Getting Members By typing Name Mobile No Email ::::::::::
$(function () {
    $("#member_id").select2({
        ajax: {
            url: "/admin/double-benifit/double-benifit-withdraw/search-member",
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

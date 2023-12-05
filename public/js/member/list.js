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
                targets: [6]
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
                    data: 'code',
                    name: 'code'
                }, {
                    data: 'name_in_bangla',
                    name: 'name_in_bangla'
                }, {
                    data: 'father_name',
                    name: 'father_name'
                }, {
                    data: 'date_of_birth',
                    name: 'date_of_birth'
                }, {
                    data: 'contact_number',
                    name: 'contact_number'
                }, {
                    data: 'present_address_line_1',
                    name: 'present_address_line_1'
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
                    _componentDatefPicker();
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
            _componentDatePicker();
        }
    }

}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    DatatableSelect.init();
});


// member serch 

$('#referrer_id').select2({
    width: '100%',
    ajax: {
        url: "/admin/member-list/get_people",
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
    placeholder: 'Enter Name | Email | Contact Number for referance Member',
    minimumInputLength: 2,
    escapeMarkup: function (markup) {
        return markup;
    },
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});

function formatRepo(repo) {
    if (repo.loading) return repo.text;

    var markup = '<div class="select2-result-repository clearfix">' +
        '<div class="select2-result-repository__title">' + repo.name_in_bangla + '</div></div>';

    return markup;
}


function formatRepoSelection(repo) {
    return repo.name_in_bangla || repo.text;
}




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

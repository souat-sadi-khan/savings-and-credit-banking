var _componentSelect2Normal = function () {

    $('.select').select2({
        width: '100%'
    });
};
var _componentSelect2Modal = function () {

    $('.select').select2({
        width: '100%',
        modaldropdownParent: $("#modal_remote .modal-content")
    });
};

var _componentDatePicker = function () {
    $('.date').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
    });

};

// $('.date').attr('readonly', true);

var _componentDatefPicker = function () {
    $('.date').attr('readonly', true);
    $('.date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
    });

};

var _componentMonthPicker = function () {
    $('.month').datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months"
    });

};


var _componentYearPicker = function () {
    $('.year').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });

};

var _componenteditor = function () {
    $('.summernote').summernote({
        height: 200, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false // set focus to editable area after initializing summernote
    });
};


var _componentDropFile = function () {

    $('.dropify').dropify();

};


/*
 * Form Validation
 */

var _formValidation = function () {
    if ($('#content_form').length > 0) {
        $('#content_form').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }

    $('#content_form').on('submit', function (e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'danger') {
                    toastr.error(data.message);

                } else {
                    toastr.success(data.message);

                    if (typeof (emran) != "undefined" && emran !== null) {
                        emran.ajax.reload(null, false);
                    }

                    $('#submit').show();
                    $('#submiting').hide();
                    $('#content_form')[0].reset();
                    if (data.goto) {
                        setTimeout(function () {

                            window.location.href = data.goto;
                        }, 500);
                    }

                    if (data.window) {
                        $('#content_form')[0].reset();
                        window.open(data.window, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
                        setTimeout(function () {
                            window.location.href = '';
                        }, 1000);
                    }

                    if (data.load) {
                        setTimeout(function () {

                            window.location.href = "";
                        }, 2500);
                    }
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
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }
                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        toastr.error(value);
                        i++;
                    });
                } else {
                    toastr.warning(jsonValue.message);

                }
                _componentSelect2Normal();
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};

var _classformValidation = function () {
    if ($('.ajax_form').length > 0) {
        console.log('sohag1')
        $('.ajax_form').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }

    $('.ajax_form').on('submit', function (e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $(this).attr('action');
        console.log(submit_url);
        //Start Ajax
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'danger') {
                    toastr.error(data.message);

                } else {
                    toastr.success(data.message);
                    $('#submit').show();
                    $('#submiting').hide();
                    $('#modal_remote').modal('toggle');
                    if (data.goto) {
                        setTimeout(function () {

                            window.location.href = data.goto;
                        }, 2000);
                    }
                    if (data.load) {
                        setTimeout(function () {

                            window.location.href = "";
                        }, 2000);
                    }
                    if (data.window) {
                        window.open(data.window, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
                        setTimeout(function () {
                            window.location.href = '';
                        }, 1000);
                    }

                    if (data.windowup) {
                        window.open(data.windowup, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
                        setTimeout(function () {
                            window.location.href = data.back;
                        }, 1000);
                    }
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
    });
};






$(document).ready(function () {
    /*
     * For Logout
     */
    $(document).on('click', '#logout', function (e) {
        e.preventDefault();
        $("#loader").show('fade');
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'Post',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                toastr.success(data.message);

                setTimeout(function () {
                    window.location.href = data.goto;
                }, 2000);
            },
            error: function (data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors
                var i = 0;
                $.each(errors, function (key, value) {
                    toastr.success(value);
                    i++;
                });
            }
        });
    });
});


var _modalFormValidation = function () {
    if ($('#content_form').length > 0) {
        console.log('sohag1')
        $('#content_form').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }
    $('#content_form').on('submit', function (e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'danger') {
                    toastr.error(data.message);


                } else {
                    toastr.success(data.message);
                    $('#submit').show();
                    $('#submiting').hide();
                    $('#modal_remote').modal('toggle');
                    if (data.goto) {
                        setTimeout(function () {

                            window.location.href = data.goto;
                        }, 2500);
                    }

                    if (data.load) {
                        setTimeout(function () {

                            window.location.href = "";
                        }, 2500);
                    }

                }
            },
            error: function (data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function (key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        toastr.error(value);
                        i++;
                    });
                } else {
                    toastr.error(jsonValue.message);

                }
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};

/*
 * For Delete Item
 */
$(document).on('click', '#delete_item', function (e) {
    e.preventDefault();
    var row = $(this).data('id');
    var url = $(this).data('url');
    $('#action_menu_' + row).hide();
    $('#delete_loading_' + row).show();
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: url,
                method: 'Delete',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: 'JSON',
                success: function (data) {

                    if (data.status == "danger") {
                        toastr.warning(data.message);
                    } else {
                        toastr.success(data.message);
                        if (typeof (emran) != "undefined" && emran !== null) {
                            emran.ajax.reload(null, false);
                        }
                        if (data.goto) {
                            setTimeout(function () {

                                window.location.href = data.goto;
                            }, 2500);
                        }





                        if (data.load) {
                            setTimeout(function () {

                                window.location.href = "";
                            }, 2500);
                        }
                    }
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                },
                error: function (data) {
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors
                    var i = 0;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                        i++;
                    });
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                }
            });
        } else {
            $('#delete_loading_' + row).hide();
            $('#action_menu_' + row).show();
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
});

/*
 * For Restore Item
 */
$(document).on('click', '#restore_item', function (e) {
    e.preventDefault();
    var row = $(this).data('id');
    var url = $(this).data('url');
    $('#action_menu_' + row).hide();
    $('#delete_loading_' + row).show();
    swal({
        title: "Are you sure want to Restore this Data?",
        text: "It Will be go back in the main Folder!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: url,
                method: 'DELETE',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: 'JSON',
                success: function (data) {

                    if (data.status == "danger") {
                        toastr.warning(data.message);
                    } else {
                        toastr.success(data.message);
                        if (typeof (emran) != "undefined" && emran !== null) {
                            emran.ajax.reload(null, false);
                        }
                        if (data.goto) {
                            setTimeout(function () {

                                window.location.href = data.goto;
                            }, 2500);
                        }

                        if (data.load) {
                            setTimeout(function () {

                                window.location.href = "";
                            }, 2500);
                        }
                    }
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                },
                error: function (data) {
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors
                    var i = 0;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                        i++;
                    });
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                }
            });
        } else {
            $('#delete_loading_' + row).hide();
            $('#action_menu_' + row).show();
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
});




/*
 * For Status Change
 */
$(document).on('click', '#change_status', function (e) {
    e.preventDefault();
    var row = $(this).data('id');
    var url = $(this).data('url');
    var status = $(this).data('status');
    if (status == 1) {
        msg = 'Change Status Form Online To Offline';
    } else {
        msg = 'Change Status Form Offline To Online';
    }
    $('#status_' + row).hide();
    $('#status_loading_' + row).show();
    swal({
        title: "Are you sure?",
        text: msg,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Change it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: url,
                method: 'Put',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: 'JSON',
                success: function (data) {
                    toastr.success(data.message, data.color);
                    if (typeof (emran) != "undefined" && emran !== null) {
                        emran.ajax.reload(null, false);
                    }

                    if (data.load) {
                        setTimeout(function () {

                            window.location.href = "";
                        }, 500);
                    }

                },
                error: function (data) {
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors
                    if (errors) {
                        var i = 0;
                        $.each(errors, function (key, value) {
                            toastr.error(value);
                            i++;
                        });
                    } else {
                        toastr.error(data.message);
                    }
                    $('#status_loading_' + row).hide();
                    $('#status_' + row).show();
                }
            });
        } else {
            $('#status_loading_' + row).hide();
            $('#status_' + row).show();
        }
    });
});

var _componentRemoteModalLoadAfterAjax = function () {
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
                _componentSelect2Normal();
                _modalFormValidation();

            })
            .fail(function (data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
    });
};

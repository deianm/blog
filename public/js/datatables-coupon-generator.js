
var pauseCoupon;
var getUsageCount;
var resumeCoupon;
var deleteCoupon;

$(document).ready(function () {

    /*
     * Hides user div on load
     */
    $("#user_div").hide();

    var jsonIndices = {
        coupon_id: 0,
        coupon_code: 1,
        amount: 2,
        start_date: 3,
        end_date: 4,
        date_generated: 5,
        coupon_type: 6,
        status: 7
    };

    var table = $('#advertisers-coupon-table').DataTable({
        dom: 'lfrtip',
        processing: true,
        serverSide: true,
        language: {
            'processing': 'Loading... Please wait...'
        },
        ajax: { 'url': '/examples/coupon-system/get_all_coupons'
        },
        columnDefs: [
            {
                targets: 0,
                width: '20px',
                render: function (data, type, row) {
                    return row[jsonIndices.coupon_id];
                }
            },
            {
                targets: 1,
                width: '20px',
                render: function (data, type, row) {
                    return row[jsonIndices.coupon_code];
                }
            },
            {
                targets: 2,
                width: '20px',
                render: function (data, type, row) {
                    return row[jsonIndices.amount];
                }
            },
            {
                //These columns are disabled till later feature is developed
                targets: 3,
                visible: false,
                searchable: false,
                width: '20px',
                render: function (data, type, row) {
                    return row[jsonIndices.start_date];
                }
            },
            {
                //These columns are disabled till later feature is developed
                targets: 4,
                visible: false,
                searchable: false,
                width: '20px',
                render: function (data, type, row) {
                    return row[jsonIndices.end_date];
                }
            },
            {
                targets: 5,
                width: '20px',
                render: function (data, type, row) {
                    return row[jsonIndices.date_generated];
                }
            },
            {
                targets: 6,
                width: '20px',
                render: function (data, type, row) {
                    if (row[jsonIndices.coupon_type] == 0) {
                        return "<p style='color:red; font-weight: bold;'>Error</p>";
                    } else if (row[jsonIndices.coupon_type] == 1) {
                        return "<p style='color:green; font-weight: bold;'>Single Use Per User</p>";
                    } else if (row[jsonIndices.coupon_type] == 2) {
                        return "<p style='color:green; font-weight: bold;'>Unique Use For Unique User(s)</p>";
                    } else if (row[jsonIndices.coupon_type] == 3) {
                        return "<p style='color:green; font-weight: bold;'>Single Use Ever</p>";
                    } else {
                        return "<p style='color:red; font-weight: bold;'>Error</p>";
                    }
                }
            },
            {
                targets: 7,
                width: '20px',
                render: function (data, type, row) {
                    if (row[jsonIndices.status] == 0) {
                        return "<p style='color:red; font-weight: bold;'>Used</p>";
                    } else if (row[jsonIndices.status] == 1) {
                        return "<p style='color:green; font-weight: bold;'>Active</p>";
                    } else if (row[jsonIndices.status] == 2) {
                        return "<p style='color:green; font-weight: bold;'>Active</p>";
                    } else if (row[jsonIndices.status] == 3) {
                        return "<p style='color:green; font-weight: bold;'>Active</p>";
                    } else if (row[jsonIndices.status] == 9) {
                        return "<p style='color:red; font-weight: bold;'>Stopped | Expired</p>";
                    }else {
                        return "<p style='color:red; font-weight: bold;'>Used/Expired</p>";
                    }
                }
            },
            {
                targets: 8,
                width: '20px',
                render: function (data, type, row) {
                    if (row[jsonIndices.status] == 0) {
                        return "<button type='button' style='margin-top:7px; margin-right:5px; border:none;' title='Copy Coupon Code' class='cbtn btn btn-info' data-clipboard-text='" + row[jsonIndices.coupon_code] + "'><i class='fa fa-files-o' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; margin-right:5px; border:none;' title='This coupon cannot be re-activated!' class='btn btn-success' onclick='resumeCoupon(" + row[jsonIndices.coupon_id] + ")' disabled/><i class='fa fa-play' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; border:none;' title='View coupon usage' class='btn btn-primary' onclick='getUsageCount(" + row[jsonIndices.coupon_id] + ")'><i class='fa fa-eye' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; margin-left:5px; border:none;' title='Delete coupon' class='btn btn-danger' onclick='deleteCoupon(" + row[jsonIndices.coupon_id] + ")'><i class='fa fa-times' aria-hidden='true'></i></button>";
                    }
                    else if (row[jsonIndices.status] == 9) {
                        return "<button type='button' style='margin-top:7px; margin-right:5px; border:none;' title='Copy Coupon Code' class='cbtn btn btn-info' data-clipboard-text='" + row[jsonIndices.coupon_code] + "'><i class='fa fa-files-o' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; margin-right:5px; border:none;' title='Undo expire' class='btn btn-success' onclick='resumeCoupon(" + row[jsonIndices.coupon_id] + ")'><i class='fa fa-play' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; border:none;' title='View coupon usage' class='btn btn-primary' onclick='getUsageCount(" + row[jsonIndices.coupon_id] + ")'><i class='fa fa-eye' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; margin-left:5px; border:none;' title='Delete coupon' class='btn btn-danger' onclick='deleteCoupon(" + row[jsonIndices.coupon_id] + ")'><i class='fa fa-times' aria-hidden='true'></i></button>";

                    } else {
                        return  "<button type='button' style='margin-top:7px; margin-right:5px; border:none;' title='Copy Coupon Code' class='cbtn btn btn-info' data-clipboard-text='" + row[jsonIndices.coupon_code] + "'><i class='fa fa-files-o' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; margin-right:5px; border:none;' title='Expire the coupon' class='btn btn-warning' onclick='pauseCoupon(" + row[jsonIndices.coupon_id] + ")'><i class='fa fa-stop' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; border:none;' title='View coupon usage' class='btn btn-primary' onclick='getUsageCount(" + row[jsonIndices.coupon_id] + ")'><i class='fa fa-eye' aria-hidden='true'></i></button>"+
                            "<button type='button' style='margin-top:7px; margin-left:5px; border:none;' title='Delete coupon' class='btn btn-danger' onclick='deleteCoupon(" + row[jsonIndices.coupon_id] + ")'><i class='fa fa-times' aria-hidden='true'></i></button>";

                    }
                }
            }
        ]
    });

    //Soft deletes/expires the coupon
    pauseCoupon = function pauseCoupon(id) {

        var data = {
            coupon_id: id
        };

        $.ajax({
            url: '/examples/coupon-system/pause_coupon',
            data: data,
            success: function (data) {
                table.draw();
            }
        });

    };
    //Check Coupon Usage
    resumeCoupon = function resumeCoupon(id) {

        var data = {
            coupon_id: id
        };

        $.ajax({
            url: '/examples/coupon-system/reverse_coupon',
            data: data,
            success: function (data) {
                table.draw();
            }
        });

    };

    //Delete coupon permanently
    deleteCoupon = function deleteCoupon(id) {

        var data = {
            coupon_id: id
        };

        $.ajax({
            url: '/examples/coupon-system/delete_coupon',
            data: data,
            success: function (data) {
                table.draw();
            }
        });

    };

    //Check Coupon Usage
    getUsageCount = function getUsageCount(id) {

        var data = {
            coupon_id: id
        };

        $.ajax({
            url: '/examples/coupon-system/coupon_usage',
            data: data,
            success: function (data) {

                $("#advertiser_usage_display").empty();

                var obj_info = (data.user_information);
                var obj_count = (data.usage_count[0].raw_count);
                //The coupon usage count
                if  (obj_count == 0) {
                    $("#coupon_usage_count").val("0")
                } else {
                    $("#coupon_usage_count").val(data.usage_count[0].raw_count)
                }

                //Advertisers who have used the coupon
                if (obj_info == null){
                    $("#advertiser_usage_display").append("<li>"+"No one used this coupon yet."+"</li>");
                } else {
                    $.each(obj_info, function (key, value) {
                        $("#advertiser_usage_display").append("<li>" + "(" + value.id + ")" + " " + value.first_name + " " + value.last_name + "</li>");
                    });
                }
                $("#check_coupon_usage").modal('show');
            }
        });

    };


    //Clears data from coupon usage modal
    $("#close_coupon_info").click(function() {
        $("#advertiser_usage_display").empty();
    });


    //Submits confirmed data
    $('#confirmed_coupon_form').submit(function (e) {
        e.preventDefault();

        var data = {

            confirmed_coupon_type: $('input[name="confirmed_coupon_type"]').val(),
            confirmed_amount: $('input[name="confirmed_amount"]').val(),
            confirmed_coupon: $('input[name="confirmed_coupon"]').val(),
            confirmed_start_date: $('input[name="confirmed_start_date"]').val(),
            confirmed_end_date: $('input[name="confirmed_end_date"]').val(),
            confirmed_coupon_limit: $('input[name="confirmed_coupon_limit"]').val(),
            confirmed_advertiser_id: $('input[name="confirmed_advertiser_id[]"]').serializeArray()
        };

        console.log(data);

        $.ajax({
            url: '/examples/coupon-system/confirmed_ajax_coupon',
            data: data,
            success: function (data) {
                table.draw();
                $("#confirmation_form").empty();
                $("#confirmation_coupon_modal").modal('hide');
            }
        });

    });

});


//Submits data to generate coupon
$('#coupon_form').submit(function (e) {
    e.preventDefault();


    if ($('#user_id').val() !== null) {

        users_check = $('#user_id').val()

    } else {

        users_check = [];

    }

    var data = {
        coupon_type: $('input[name="coupon_type"]:checked').val(),
        amount: $('input[name="amount"]').val(),
        numbers: $('select[name="numbers"]').val(),
        letters: $('select[name="letters"]').val(),
        start_date: $('input[name="start_date"]').val(),
        end_date: $('input[name="end_date"]').val(),
        mask: $('input[name="mask"]').val(),
        users: users_check,
        coupon_limit: $('input[name="coupon_limit"]').val()
    };

    console.log(data);

    $.ajax({
        url: '/examples/coupon-system/generate_ajax_coupon',
        data: data,
        success: function (data) {

            //Coupon Errors seperated into multiple else ifs because js can seem to only hold up to three || operators
            if (data.error == 'empty_user' || data.error == 'amount') {
                $("#error_coupon_message").val(data.message);
                $("#error_coupon_modal").modal('show');
            } else if (data.error == 'try_again' || data.error == 'qty_coupon') {
                $("#error_coupon_message").val(data.message);
                $("#error_coupon_modal").modal('show');
            } else {
                //coupon Amount
                var obj = (data.confirmation_advertiser);
                if ((data.confirmation_coupon_limit == -1) && (data.confirmation_coupon_type == 2)) {
                    $("#confirmation_coupon_limit").val(data.confirmation_coupon_limit);
                    $("#confirmation_limit_display").val("Single Use Per User(s)");
                }
                else if (data.confirmation_coupon_limit == -1) {
                    $("#confirmation_coupon_limit").val(data.confirmation_coupon_limit);
                    $("#confirmation_limit_display").val("Unlimited Coupons");
                } else {
                    $("#confirmation_coupon_limit").val(data.confirmation_coupon_limit);
                    $("#confirmation_limit_display").val(data.confirmation_coupon_limit + " " + "Coupon Use Limit");
                }

                //Coupon Confirmation Type
                if (data.confirmation_coupon_type == 1) {
                    $("#confirmation_coupon_type").val(data.confirmation_coupon_type);
                    $("#confirmation_type_display").val("Single Use Per User");
                } else if (data.confirmation_coupon_type == 2) {
                    $("#confirmation_coupon_type").val(data.confirmation_coupon_type);
                    $("#confirmation_type_display").val("Single Use For Unique User");
                } else if (data.confirmation_coupon_type == 3) {
                    $("#confirmation_coupon_type").val(data.confirmation_coupon_type);
                    $("#confirmation_type_display").val("Single Use Ever");
                }

                //Coupon Amount
                if ($(this).val(data.confirmation_amount)) {
                    $("#confirmation_amount").val(parseFloat(data.confirmation_amount).toFixed(2));
                    $("#confirmation_amount_display").val("$" + " " + parseFloat(data.confirmation_amount).toFixed(2));
                }
                $("#confirmation_coupon").val(data.confirmation_coupon);
                $("#confirmation_start_date").val(data.confirmation_start_date);
                $("#confirmation_end_date").val(data.confirmation_end_date);
                if (obj !== undefined) {
                    $.each(obj, function (key, value) {
                        $("#confirmation_form").append('<input type="hidden" name="confirmed_advertiser_id[]" value="' + value.id + '" /> ');
                    });
                } else {

                }

                //Load modal after data has been appended
                $("#confirmation_coupon_modal").modal('show');
            }
        }
    });

});

//Date Time Picker JS
$(function () {
    $('#datetimepicker_start').datetimepicker();

    $('#datetimepicker_end').datetimepicker();
});

$("#user_id").select2({
    placeholder: "Select an Advertiser",
    allowClear: true,
    multiple: true,
    tags: true,
    ajax: {
        url: "/examples/coupon-system/get_advertiser_list",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                search: params.term // search term
            };
        },
        processResults: function (data) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
});


$('#advertisers_selected').click(function () {
    if ($(this).is(':checked')) {
        $("#limit_div").hide("slow");
        $("#note_message").hide("slow");
        $("#user_div").show("slow");
        $("#user_id").prop("disabled", false);
        $("#coupon_limit").prop("disabled", true);
        $("#coupon_limit").val("-1");
    } else {
        $("#user_id").prop("disabled", true);
    }
});

$('#single_use_selected').click(function () {
    if ($(this).is(':checked')) {
        $("#user_div").hide("slow");
        $("#limit_div").hide("slow");
        $("#note_message").hide("slow");
        $("#user_id").val(null).trigger("change");
        $("#user_id").prop("disabled", true);
        $("#coupon_limit").prop("disabled", true);
        $("#coupon_limit").val("-1");
    } else {
        $("#user_id").prop("disabled", false);
    }
});

$('#per_use_selected').click(function () {
    if ($(this).is(':checked')) {
        $("#limit_div").show("slow");
        $("#note_message").show("slow");
        $("#user_div").hide("slow");
        $("#user_id").val(null).trigger("change");
        $("#user_id").prop("disabled", true);
        $("#coupon_limit").prop("disabled", false);
    } else {
        $("#user_id").prop("disabled", false);
    }
});

@extends('layouts.app')
@section('title','Coupon System')
@section('content')

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.0.2/css/responsive.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/select/1.1.0/css/select.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css"/>
    <link rel="stylesheet" href="../css/coupon-style.css" >

    <script src="../js/clipboard.js"></script>

    <script>
        window.onload=function() {
            new Clipboard('.cbtn');
        }
    </script>

    <!--COUPON FORM -->
    <div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="block-web">
                <h2>Coupon Code Generator</h2>
                <form id="coupon_form" name="coupon_form">
                    <div>
                        <label>Single Use Per User <input checked id="per_use_selected" name="coupon_type" style="margin-left:10px; top:4px; opacity:1; position:relative;" type="radio" value="1"></label>
                    </div>
                    <div>
                        <label>Single Use For Unique User(s) <input id="advertisers_selected" name="coupon_type" style="margin-left:10px; top:4px; opacity:1; position:relative;" type="radio" value="2"></label>
                    </div>
                    <div>
                        <label>Single Use Ever <input id="single_use_selected"  name="coupon_type" style="margin-left:10px; top:4px; opacity:1; position:relative;" type="radio" value="3"></label>
                    </div>
                    <div id="user_div" style="margin-top: 15px;">
                        <label>User(s)</label> <select class="form-control" disabled id="user_id" multiple="multiple" name="user_id">
                        </select>
                    </div>
                    <div id="amount_div" style="margin-top: 15px;">
                        <label>$ Amount</label> <input class="form-control" name="amount" value="0">
                    </div>
                    <div id="limit_div" style="margin-top: 15px;">
                        <label>Number of Coupons</label>
                        <input class="form-control" id="coupon_limit" name="coupon_limit" value="-1">
                    </div>
                    <div id="note_message">
                        <p style="color:red; margin-top:5px;">Note:</p>
                        <p>Number of Coupons "-1" is unlimited uses for the coupon. Does not apply to "Single Use for Unique User(s)" and "Single Use Ever" options.</p>
                    </div>
                    <div style="display:none;">
                        <select class="form-control" name="numbers">
                            <option value="false">
                                False
                            </option>
                            <option selected value="true">
                                True
                            </option>
                        </select><select class="form-control" name="letters">
                            <option value="false">
                                False
                            </option>
                            <option selected value="true">
                                True
                            </option>
                        </select>
                        <input class="form-control" id="datetimepicker_start" name="start_date" type="text">
                        <input class="form-control" id="datetimepicker_end" name="end_date" type="text">
                        <input class="form-control" name="mask" type="text" value="XXXXXXXXXX">
                        <hr>
                        <br>
                        <table style="font-size:12px;">
                            <tr>
                                <th>Numbers</th>
                                <th>Letters</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Mask(Default 10 Characters)</th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-offset-5 col-md-3" style="margin-left: 38.333333% !important; padding-top:15px;">
                        <button class="btn btn-primary pull-right" style="border:none;" type="submit">Generate</button>
                    </div>
                </form>
            </div>
        </div>

        <!--COUPON TABLE -->

        <div class="col-md-8">
            <div class="block-web">
                <h3 class="content-header">Generated Coupons</h3>
                <table id="advertisers-coupon-table" class="table table-striped table-hover table-bordered responsive dataTable dtr-inline" width="100%" role="grid" aria-describedby="coupontable">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Coupon Code">
                            ID
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Coupon Code">
                            Coupon Code
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Amount">
                            Amount
                        </th>
                        <th class="never" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Redeemed by">
                            Start Date
                        </th>
                        <th class="never" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Redeemed Yes or No">
                            End Date
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Date Coupon was generated">
                            Date Generated
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Date Coupon was generated">
                            Coupon Type
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Date Coupon was generated">
                            Status
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Date Coupon was generated">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Error Modal -->
    <div class="modal fade" id="error_coupon_modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form id="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="text-align:center;">Coupon Error</h4>
                    </div>
                    <div class="modal-body">
                        <div id="confirmation_form">
                        </div>
                        <div style="padding-bottom:145px; text-align:center;">
                            <div class="col-sm-12">
                                <input class="remove-input-css" id="error_coupon_message" value="" style="font-weight: bold; color:red; font-size:18px; width:100%"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmation_coupon_modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form id="confirmed_coupon_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="text-align:center;">Coupon Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <div id="confirmation_form">

                        </div>
                        <input type="hidden" name="confirmed_start_date" id="confirmation_start_date">
                        <input type="hidden" name="confirmed_end_date" id="confirmation_end_date">
                        <div style="padding-bottom:145px; text-align:center;">
                            <div class="col-sm-6">
                                <h3>Coupon Type</h3>
                                <input type="hidden" class="remove-input-css" style="font-weight: bold; color:green; font-size:15px;" name="confirmed_coupon_type" id="confirmation_coupon_type" disabled>
                                <input class="remove-input-css" style="font-weight: bold; color:green; font-size:15px;" name="confirmed_coupon_type" id="confirmation_type_display" disabled>
                            </div>
                            <div class="col-sm-6">
                                <h3>Coupon Amount</h3>
                                <input type="hidden" class="remove-input-css" style="font-weight: bold; color:green; font-size:15px;" name="confirmed_amount" id="confirmation_amount" disabled>
                                <input class="remove-input-css" style="font-weight: bold; color:green; font-size:15px;" name="confirmed_amount" id="confirmation_amount_display" disabled>
                            </div>
                            <div class="col-sm-12">
                                <input class="remove-input-css" style="font-weight: bold; color:green; font-size:35px;" name="confirmed_coupon" id="confirmation_coupon" disabled>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" class="remove-input-css" style="font-weight: bold; color:green; font-size:15px;" name="confirmed_coupon_limit" id="confirmation_coupon_limit" disabled>
                                <input class="remove-input-css" style="font-weight: bold; color:green; font-size:25px;" name="confirmed_limit_display" id="confirmation_limit_display" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Usage Modal -->
    <div class="modal fade" id="check_coupon_usage" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form id="confirmed_coupon_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="text-align:center;">Coupon Usage Info</h4>
                    </div>
                    <div class="modal-body">
                        <div id="confirmation_form">

                        </div>
                        <input type="hidden" name="confirmed_start_date" id="confirmation_start_date">
                        <input type="hidden" name="confirmed_end_date" id="confirmation_end_date">
                        <div style="padding-bottom:210px; text-align:center;">
                            <div class="col-sm-4">
                                <h3>Coupon Usage Count</h3>
                                <input class="remove-input-css" style="font-weight: bold; color:green; font-size:15px;" name="coupon_usage_count" id="coupon_usage_count" disabled>
                            </div>
                            <div class="col-sm-8">
                                <h3>Advertisers who have used the coupon</h3>
                                <div class="remove-input-css" style="overflow:auto; height:150px; width:343px; font-weight: bold; color:green; font-size:15px;" name="advertiser_usage_display" id="advertiser_usage_display" disabled></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="close_coupon_info" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@stop

@section('dt-js')


    {{--
        @include('shared.datatables-js-links')
    --}}
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/select/1.1.0/js/dataTables.select.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/featherlight/1.5.0/featherlight.min.js"></script>
    <script src="../js/datatables-coupon-generator.js"></script>
    <script src="../js/bootstrap-datetimepicker.js"></script>

@stop

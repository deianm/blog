@extends('layouts.app')
@section('title','Basic DT SSP')
@section('content')

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.0.2/css/responsive.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/select/1.1.0/css/select.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css"/>
    <link rel="stylesheet" href="../../css/demo.css">
    <link rel="canonical" href="http://jquerycreditcardvalidator.com/">
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <link rel="stylesheet" href="../../css/reset-form.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="../../css/style-form.css"> <!-- Resource style -->
    <script src="../../js/modernizr.js"></script> <!-- Modernizr -->

    <script type="text/javascript">
        Stripe.setPublishableKey('pk_test_xBmPIe9HuWX1FWhInyrVKCle');
    </script>

    <title>jQuery Credit Card Validator</title>

    <div class="container">
        <div id="payment-form-style">
        <ul class="cd-pricing">
            <li>
                <header class="cd-pricing-header">
                    <h2>Basic</h2>

                    <div class="cd-price">
                        <span>$9.99</span>
                        <span>month</span>
                    </div>
                </header> <!-- .cd-pricing-header -->

                <div class="cd-pricing-features">
                    <ul>
                        <li class="available"><em>Feature 1</em></li>
                        <li><em>Feature 2</em></li>
                        <li><em>Feature 3</em></li>
                        <li><em>Feature 4</em></li>
                    </ul>
                </div> <!-- .cd-pricing-features -->

                <footer class="cd-pricing-footer">
                    <a href="#0">Select</a>
                </footer> <!-- .cd-pricing-footer -->
            </li>

            <li>
                <header class="cd-pricing-header">
                    <h2>Popular</h2>

                    <div class="cd-price">
                        <span>$19.99</span>
                        <span>month</span>
                    </div>
                </header> <!-- .cd-pricing-header -->

                <div class="cd-pricing-features">
                    <ul>
                        <li class="available"><em>Feature 1</em></li>
                        <li class="available"><em>Feature 2</em></li>
                        <li><em>Feature 3</em></li>
                        <li><em>Feature 4</em></li>
                    </ul>
                </div> <!-- .cd-pricing-features -->

                <footer class="cd-pricing-footer">
                    <a href="#0">Select</a>
                </footer> <!-- .cd-pricing-footer -->
            </li>

            <li>
                <header class="cd-pricing-header">
                    <h2>Premier</h2>

                    <div class="cd-price">
                        <span>$29.99</span>
                        <span>month</span>
                    </div>
                </header> <!-- .cd-pricing-header -->

                <div class="cd-pricing-features">
                    <ul>
                        <li class="available"><em>Feature 1</em></li>
                        <li class="available"><em>Feature 2</em></li>
                        <li class="available"><em>Feature 3</em></li>
                        <li class="available"><em>Feature 4</em></li>
                    </ul>
                </div> <!-- .cd-pricing-features -->

                <footer class="cd-pricing-footer">
                    <a href="#0">Select</a>
                </footer> <!-- .cd-pricing-footer -->
            </li>
        </ul> <!-- .cd-pricing -->
        <div class="cd-form">
            <div class="cd-plan-info">
                <!-- content will be loaded using jQuery - according to the selected plan -->
            </div>
            <div class="cd-more-info">
                <h3>Need help?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>


            <fieldset style="display:none;">
                    <legend>Account Info</legend>

                    <div class="half-width">
                        <label for="userName">Name</label>
                        <input type="text" id="userName" name="userName">
                    </div>

                    <div class="half-width">
                        <label for="userEmail">Email</label>
                        <input type="email" id="userEmail" name="userEmail">
                    </div>

                    <div class="half-width">
                        <label for="userPassword">Password</label>
                        <input type="password" id="userPassword" name="userPassword">
                    </div>

                    <div class="half-width">
                        <label for="userPasswordRepeat">Repeat Password</label>
                        <input type="password" id="userPasswordRepeat" name="userPasswordRepeat">
                    </div>
                </fieldset>

            <form method="POST" id="payment-form">
                <fieldset>
                    <legend>Payment Method</legend>

                    <div>
                        <ul class="cd-payment-gateways">
                            <li>
                                <input type="radio" name="payment-method" id="paypal" value="paypal">
                                <label for="paypal">Paypal</label>
                            </li>

                            <li>
                                <input type="radio" name="payment-method" id="card" value="card" checked>
                                <label for="card">Card</label>
                            </li>
                        </ul> <!-- .cd-payment-gateways -->
                    </div>

                    <div class="cd-credit-card">
                        <span style="color:#df4f71;" class="payment-errors"></span>
                        <div>
                            <p class="half-width">
                                <label for="cardNumber">Card Number</label>
                                <input type="text" id="card_number" data-stripe="number">
                            </p>

                            <p class="half-width">
                                <label>Expiration date</label>
                                <b>
								<span class="cd-select">
									<select  data-stripe="exp_month" id="card-expiry-month">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								</span>
                                    <span class="cd-select">
									<select  data-stripe="exp_year" id="card-expiry-year">
										<option value="2018">2018</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
                                        <option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
									</select>
								</span>
                                </b>
                            </p>
                            <p class="half-width">
                                <label for="cardCvc">Card CVC</label>
                                <input type="text" id="cardCvc" data-stripe="cvc">
                            </p>
                        </div>
                    </div> <!-- .cd-credit-card -->
                </fieldset>

                <fieldset>
                    <div>
                        <input type="submit" value="Get started">
                    </div>
                </fieldset>
            </form>

            <a href="#0" class="cd-close"></a>
        </div> <!-- .cd-form -->
        <div class="cd-overlay"></div> <!-- shadow layer -->

    </div>
        <div class="col-md-12">
            <div class="block-web">
                <h3 class="content-header">Payments Made</h3>
                <table id="stripe-table" class="table table-striped table-hover table-bordered responsive dataTable dtr-inline" width="100%" role="grid" aria-describedby="coupontable">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" s aria-sort="ascending" aria-label="Coupon Code">
                            ID
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Coupon Code">
                            Payment ID
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Amount">
                            Status
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Redeemed by">
                            Amount
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="coupontable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Redeemed Yes or No">
                            Payment Date
                        </th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('dt-js')

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="../../js/demo.js"></script>
    <script src="../../js/velocity.min.js"></script>
    <script src="../../js/main.js"></script> <!-- Resource jQuery -->
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
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


    <script>

        $(document).ready(function () {

            var jsonIndices = {
                id: 0,
                payment_id: 1,
                status: 2,
                amount: 3,
                created_at: 4
            };

            var table = $('#stripe-table').DataTable({
                dom: 'lfrtip',
                processing: true,
                serverSide: true,
                language: {
                    'processing': 'Loading... Please wait...'
                },
                ajax: { 'url': '/examples/payments/show-payment'
                },
                columnDefs: [
                    {
                        targets: 0,
                        width: '20px',
                        render: function (data, type, row) {
                            return row[jsonIndices.id];
                        }
                    },
                    {
                        targets: 1,
                        width: '20px',
                        render: function (data, type, row) {
                            return row[jsonIndices.payment_id];
                        }
                    },
                    {
                        targets: 2,
                        width: '20px',
                        render: function (data, type, row) {
                            return row[jsonIndices.status];
                        }
                    },

                    {
                        targets: 3,
                        width: '20px',
                        render: function (data, type, row) {
                            return row[jsonIndices.amount];
                        }
                    },
                    {
                        targets: 4,
                        width: '20px',
                        render: function (data, type, row) {
                            return row[jsonIndices.created_at];
                        }
                    }
                ]
            });


            $(function () {
                var $form = $('#payment-form');
                $form.submit(function (event) {
                    // Disable the submit button to prevent repeated clicks:
                    $form.find('.submit').prop('disabled', true);

                    // Request a token from Stripe:
                    Stripe.card.createToken($form, stripeResponseHandler);

                    // Prevent the form from being submitted:
                    return false;
                });
            });

            function stripeResponseHandler(status, response) {

                // Grab the form:
                var $form = $('#payment-form');

                if (response.error) { // Problem!

                    // Show the errors on the form:
                    $form.find('.payment-errors').text(response.error.message);
                    $form.find('.submit').prop('disabled', false); // Re-enable submission

                } else { // Token was created!

                    var data = {
                        token: response.id
                    };

                    $.ajax({
                        url: '/examples/payments/make-payment',
                        data: data,
                        success: function (data) {
                            console.log(data);
                            table.draw();
                        }
                    });

                    /*
                     // Get the token ID:
                     var token = response.id;

                     // Insert the token ID into the form so it gets submitted to the server:
                     $form.append($('<input type="hidden" name="stripeToken">').val(token));

                     // Submit the form:
                     $form.get(0).submit();
                     */
                }
            }


        });

    </script>

@endsection


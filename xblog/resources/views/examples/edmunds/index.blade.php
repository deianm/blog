@extends('layouts.app')
@section('title','Edmunds')
@section('content')

    <link href="../css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <style>

        .caption {
            color: white !important;
            text-align: center;
        }

        .thumbnail {
            border-radius: 0;
            background-color: #52768e;
        }

        .thumbnail a:hover {
            color: #FF6E40;
            border: 1px solid #FF6E40 !important;
        }

        .navbar-nav > li > a {
            background: #52768e !important;
            min-width: 100px;
            cursor: pointer;
            text-decoration: none;
        }

        .portfolio > li > a > div:hover {
            color: #FF6E40;
            border: 1px solid #FF6E40 !important;
            background: #FF6E40;
            text-decoration: none;
        }

        .portfolio > li > a {
            text-decoration: none;
        }

        .code-overflow {
            /* */
        }

        .code-padding {
            padding-right: 15px;
        }

        .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .highlight, pre {
            margin-top: -20px !important;
        }

    </style>

    <body id="portfolio">
    <div class="container wrapper">
    </div>

    <div class="row">
        <center>
            <div><a href="http://www.edmunds.com/?id=apis"> <img
                            src="https://open-api.edmunds.com/api/openapi/v1/logo?size=300&format=horizontal&retina=false&color=blue&api_key=qbbpc2dbpjsvj23nchcbqfc2">
                </a>
            </div>
        </center>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="post-detail-content code-overflow">
                <div>

                    <h4>Select Endpoint</h4>
                    <select class="endpoint-name form-control" name="endpoint-name"></select>
                </div>

            </div>
            </br>
            <div>
                <div id="form-div"></div>
            </div>

            <!--
            <p>Select is in development to test run a call please use the "Test Run" button.</p>
            <p>This button is just a call to the API plx don't press it a million times.</p>
            <button type="submit" id="edmunds-test">Test Run</button>
            -->

        </div>
        <div class="col-md-6">
            <div class="post-detail-content code-overflow">
                <h4>Edmunds Data</h4>
                <pre>
                    <code class="json hljs" id="edmunds-response">
                    </code>
                </pre>
            </div>
        </div>
    </div>

    </body>

    <script src="../js/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../js/bootstrap-portfilter.min.js"></script>

    <script>

        /*
         * Ajax call to endpoint build
         * params:id
         * response:json edmunds data
         */
        $('#edmunds-test').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '/edmunds/get-all-vehicles',
                data: [],
                success: function (data) {
                    var my_obj = JSON.stringify(data, null, 2);
                    $("#edmunds-response").empty();
                    $("#edmunds-response").append("<div>" + my_obj + "</div>");
                    after_ajax();
                }
            });
        });

        /*
         * Select2 Drop-down and Search
         */
        $('.endpoint-name').select2({
            ajax: {
                url: '/edmunds/fetch-endpoints',
                dataType: 'json',
                quietMillis: 100,
                data: function (params) {
                    return {
                        search: params.term || 'GET'
                    };
                },
                processResults: function (data) {
                    console.log(data);
                    var results = [];
                    $.each(data, function (index, item) {
                        results.push({
                            id: item.id,
                            text: item.endpoint
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });

        /*
         * Sends endpoint_id to the form builder
         */
        $('.endpoint-name').on('select2:select', function (evt) {

            var item = $(".endpoint-name option:selected").text();
            var endpoint_id = item.replace(/[^0-9.]/g, "");

            var data = {
                endpoint_id: endpoint_id
            };

            $.ajax({
                url: '/edmunds/build-payload',
                data: data,
                success: function (data) {
                    $("#form-div").empty();
                    $("#form-div").append(data);
                }
            });

        });
    </script>

@endsection
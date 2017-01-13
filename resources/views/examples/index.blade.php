@extends('layouts.app')
@section('title','Examples')
@section('content')

    <link href="../css/bootstrap-combined.no-icons.min.css" rel="stylesheet">

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

    </style>

<body id="portfolio">
<div class="container wrapper">
    <br/>
    <hr>
    <div style="text-align: center;">
    <h3>Ongoing project examples will be added soon, for now only cats will be displayed!</h3>
    </div>
    <center>
        <div style="margin-left: 29%;">
            <ul class="nav navbar-nav">
                <li><a data-toggle="portfilter" data-target="all">All</a></li>
                <li><a data-toggle="portfilter" data-target="art">Filtering</a></li>
                <li><a data-toggle="portfilter" data-target="media">Server Side</a></li>
                <li><a data-toggle="portfilter" data-target="brand">CSS</a></li>
            </ul>
        </div>
    </center>

    <div class="clearfix"></div>

    <br/>

    <ul class="thumbnails gallery portfolio" style="margin-left:85px;">
        <li class="span3 clearfix" data-tag='brand'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="/storage/images/79b4f604ceb67efa804d5b32f20f8c13.jpeg"/>
                    <div class="caption">
                        <h4>Basic CSS</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='art'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="/storage/images/496a39cc7cb02b72e89e124363dd2f7b.jpeg"/>
                    <div class="caption">
                        <h4>Basic Filtering</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='media'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="/storage/images/ac275fc6f5adb7e2a702323c5bbccc23.jpeg"/>
                    <div class="caption">
                        <h4>Basic Server Side</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='brand'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="/storage/images/79b4f604ceb67efa804d5b32f20f8c13.jpeg"/>
                    <div class="caption">
                        <h4>Advanced CSS</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='art'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="/storage/images/496a39cc7cb02b72e89e124363dd2f7b.jpeg"/>
                    <div class="caption">
                        <h4>Advanced Filtering</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='media'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="/storage/images/ac275fc6f5adb7e2a702323c5bbccc23.jpeg"/>
                    <div class="caption">
                        <h4>Advanced Server Side</h4>
                    </div>
                </div>
            </a>
        </li>
    </ul>
    <div class="push"></div>
</div>

</body>

<script src="../js/jquery-1.9.1.min.js"></script>
<script src="../js/bootstrap-portfilter.min.js"></script>

@endsection
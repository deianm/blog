@extends('layouts.app')
@section('title','博客')
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

    <center>
        <div style="margin-left: 29%;">
            <ul class="nav navbar-nav">
                <li><a data-toggle="portfilter" data-target="all">All</a></li>
                <li><a data-toggle="portfilter" data-target="art">Art</a></li>
                <li><a data-toggle="portfilter" data-target="media">Media</a></li>
                <li><a data-toggle="portfilter" data-target="brand">Brand</a></li>
            </ul>
        </div>
    </center>

    <div class="clearfix"></div>

    <br/>

    <ul class="thumbnails gallery portfolio" style="margin-left:85px;">
        <li class="span3 clearfix" data-tag='brand'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Brand Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='art'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Art Project</h4>

                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='media'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Media Project</h4>

                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='brand'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Brand Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='art'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Art Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='media'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Media Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3 clearfix" data-tag='brand'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Brand Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='art'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Art Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='art'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Art Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='brand'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Brand Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='brand'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Brand Project</h4>
                    </div>
                </div>
            </a>
        </li>
        <li class="span3" data-tag='brand'>
            <a href="#">
                <div class="thumbnail">
                    <img alt="270x170" src="http://placehold.it/270x170"/>
                    <div class="caption">
                        <h4>Brand Project</h4>
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
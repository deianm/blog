@extends('layouts.app')
@section('title','Basic DT SSP')
@section('content')

    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block-web">
                    <div class="porlets-content">
                        <div class="adv-table editable-table ">
                            <table id="basic-ssp-table" class="table table-striped table-hover table-bordered responsive" width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Note</th>
                                    <th>Link</th>
                                </tr>
                                </thead>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dt-js')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#basic-ssp-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/examples/datatables/basic-ssp-data"

            });

        });
    </script>
@endsection
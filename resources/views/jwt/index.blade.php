@extends('layouts.app')
@section('title','Deian Mosolov')
@section('content')


    <button id="btnGetResource">Test</button>


    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script>
        $("#btnGetResource").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                dataType: 'jsonp',
                url: 'https://reapon.com/auth/register',
                data: {
                    username: 'deian.mosolov@gmail.com',
                    password: 'silver'
                },
                headers: { 'Access-Control-Allow-Headers': 'Origin' },
                success: function (data) {
                    console.log('success');
                    // Decode and show the returned data nicely.
                },
                error: function () {
                    alert('error');
                }
            });
        });
    </script>

@endsection


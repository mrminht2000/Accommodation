@extends('layout.master')
@section('content')

<html>
<style>
    .left-sidebar .right-sidebar {
        background-color: #fff;
        min-height: 600px;
    }
</style>
<div class="container">
    <div class="col-md-12">
        <div class="col-md-3 left-sidebar" style="background-color: #fff;">
            <h3 align="center">Left Sidebar </h3>
            <hr>
        </div>

        <div class="col-md-7 left-sidebar" style="background-color: #fff;">
            <h3 align="center">Left Sidebar </h3>
            <hr>
        </div>

        <div class="col-md-2 left-sidebar" style="background-color: #fff;">
            <h3 align="center">Left Sidebar </h3>
            <hr>
        </div>
    </div>
</div>

</html>

@endsection
@extends('Dashboard.layouts.base')
@section('title','dashboard_apis')
@section('page_id','api')

@section('style')

@endsection

@section('content')
    <h3 style="color: white">
        List of Api GET:
    </h3>
    <hr>
    <ul>
        <li><a href="/sales">Information About sales</a></li>
        <li><a href="/countries">Information About countries and sales</a></li>
        <li><a href="/country_data">Information About countries </a></li>
        <li><a href="/admin/order_date_region">Information About regions and orders - Date </a></li>
        <li><a href="/season_data">Information About regions and sales - Date </a></li>
        <li><a href="/admin/get_post_chart_data">Information About cost - profit - date </a></li>

    </ul>
@endsection

@section('script')



@endsection

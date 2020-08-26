@extends('Dashboard.layouts.base')
@section('title','manage_sales')
@section('page_id','mange_sales')

@section('content')

    <div style="float: right">
    <form action="/admin/select_region" method="post">


                <select name="region">
            @foreach($regions as $region)
                        <option name="region" value="{{ $region['region']}}"> {{ $region['region'] }}</option>
            @endforeach
                </select>

            @csrf
                <input type="submit" class="button" value="Search">

    </form>
</div>

    @if(count($target) == 0)

        <h4 style="color: white"> Select a region :</h4>

        @else

        <h4 style="color: white"> Result: {{ count($target) }} sales</h4>
    <table class="hover table-striped">
        <thead>
        <tr>
            <td>country</td>
            <td>order_date</td>
            <td>ship_date</td>
            <td>units_sold$</td>
            <td>unit_price$</td>
            <td>unit_cost$</td>
            <td>total_cost$</td>
            <td>total_profit$<td>
        </tr>
        </thead>
        <tbody>
        @foreach($target  as $t)
        <tr>
            <td>{{$t->country}}</td>
            <td> {!! \App\Helper::getFromDateAttribute($t->order_date) !!}</td>
            <td>{!! \App\Helper::getFromDateAttribute($t->ship_date) !!}</td>
            <td>{{$t->units_sold}}</td>
            <td>{{$t->unit_price}}</td>
            <td>{{$t->unit_cost}}</td>
            <td>{{$t->total_cost}}</td>
            <td>{{$t->total_profit}}<td>
        </tr>
            @endforeach
        </tbody>
    </table>
@endif

    @endsection

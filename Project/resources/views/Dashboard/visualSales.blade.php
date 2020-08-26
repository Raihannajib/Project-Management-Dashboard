@extends('Dashboard.layouts.base')
@section('title','visual_sales')
@section('page_id','visual_sales')

@section('content')

<h2 style="margin-top: 0.5rem;color: white"> Hello Mr:
        {!! \Illuminate\Support\Facades\Auth::user()->name !!}
    </h2>
<div class="container">
    <div class="row">
        <div class="col">
        <h3 style="color:green">Annual cost comparison</h3>
        </div>
    </div>
<div class="row">
<div class="col-6">
<canvas id="myChart" style="background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>
</div>
<div class="col-6"><canvas id="myChartLine" style="background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas></div>

</div>


</div>
<div class="container">
    <div class="row">
        <div class="col">
        <h3 style="color:green">Annual revenue comparison</h3>
        </div>
    </div>
<div class="row">
<div class="col-6">
<canvas id="myChartRevenue" style="background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>
</div>
<div class="col-6"><canvas id="myChartLineRevenue" style="background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas></div>

</div>


</div>
<div class="container">
    <div class="row">
        <div class="col">
        <h3 style="color:green">Annual profit comparison</h3>
        </div>
    </div>
<div class="row">
<div class="col-6">
<canvas id="myChartProfit" style="background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>
</div>
<div class="col-6"><canvas id="myChartLineProfit" style="background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas></div>

</div>


</div>

@endsection

@section('script')


<script src="{{ asset('js/visual.js') }}"></script>


@endsection

@extends('Dashboard.layouts.base')
@section('title','dashboard')
@section('page_id','dashboard')

@section('content')
    <h2 style="margin-top: 0.5rem;color: white"> Hello Mr:
        {!! \Illuminate\Support\Facades\Auth::user()->name !!}
    </h2>
    <div class="dashboard" style="padding-top: 0.2rem ; display: table" >

        <div class="row expanded" style="background: #222;width: 50%; height: 100%; float:left;display: table-cell">
            <div class="small-12 medium-11 column " style="width: 100%; height: 50%;display: table-cell ; float: top">
                <div  class="card" style="background: #222">
                    <div class="card-section" >
                        <h6 style="color: white"> Monthly Order</h6>
                        <canvas  id="orderChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="small-12 medium-11 column " style="background: #222;width: 100%; height: 50%;display: table-cell;float: bottom">


        <div class="card-section">
            <h6><a href="/admin/manage_sales">Regions</a></h6>
            <canvas  id="regionChart"></canvas>
        </div>


    </div>
</div>


        <div class="row " style=" width: 50%; height: 100%; float:right ; display: table-cell" >

            {{--    unit price summary--}}
            <div class="small-12 medium-6 column summary">
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-product-hunt" style="color: blue"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Unit Price: </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column" >
                            <ul>
                                <li>Min: <span>${{ $min['unit_price'] }}</span></li>
                                <li>Max: <span>${{ $max['unit_price'] }}</span></li>
                                <li>Average: <span>${{ number_format($mean['unit_price'],2) }}</span></li>
                                <li>Standard deviation <span>${{ number_format($stddev['unit_price'],2) }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            {{--    revenue summary--}}
            <div class="small-12 medium-6 column summary">
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-money" style="color: green"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Revenue: </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <ul>
                                <li>Min: <span>${{ $min['total_revenue'] }}</span></li>
                                <li>Max: <span>${{ $max['total_revenue'] }}</span></li>
                                <li>Average: <span>${{ number_format($mean['total_revenue'],2) }}</span></li>
                                <li>Standard deviation: <span>${{ number_format($stddev['total_revenue'],2) }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            {{--    cost summary--}}
            <div class="small-12 medium-6 column summary">
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-dollar" style="color: red"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Cost:</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <ul>
                                <li>Min: <span>${{ $min['total_cost'] }}</span></li>
                                <li>Max: <span>${{ $max['total_cost'] }}</span></li>
                                <li>Average: <span>${{ number_format($mean['total_cost'],2) }}</span></li>
                                <li>Standard deviation: <span>${{ number_format($stddev['total_cost'],2) }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            {{--    profit summary--}}
            <div class="small-12 medium-6 column summary">
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-shopping-cart" style="color: coral"></i>
                            </div>
                            <div class="small-9 column">
                                <p>profit:</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <ul>
                                <li>Min: <span>${{ $min['total_profit'] }}</span></li>
                                <li>Max: <span>${{ $max['total_profit'] }}</span></li>
                                <li>Average: <span>${{number_format($mean['total_profit'],2) }}</span></li>
                                <li>Standard deviation: <span>${{number_format($stddev['total_profit'],2) }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection

@section('script')

    <script src="{{ asset('js/orderChart.js') }}"></script>

@endsection

@extends('Dashboard.layouts.base')
@section('title','dashboard_chart_season')
@section('page_id','dashboard_chart_season')



@section('content')



        <div class="tab-content medium-4" style=" float: left">
            <div id="predict">
                <h1>Expected sales: <span id="result"></span></h1>

                    <div class="field-wrap">
                       <h5 style="color: white"> select a year:</h5>
                        <select id="years">
                            @foreach( $d as $year )
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field-wrap">
                        <h5 style="color: white"> Select a quarter :</h5>
                        <select id="quarters">
                            <option value="1">January, February, and March (Q1)</option>
                            <option value="2">April, May, and June (Q2)</option>
                            <option value="3">July, August, and September (Q3)</option>
                            <option value="4"> October, November, and December (Q4)</option>
                        </select>
                    </div>

                    <button  class="button button-block" onclick="predict()"> Predict </button>


            </div>


            <div id="" >

            </div>



    </div>

        <div class="tab-content medium-8" style=" float: left; padding-top:5rem ;padding-left: 2rem">
            <div class="small-12 medium-11 column " style="background: #222;width: 100%; height: 100%;display: table-cell ; float: top">
                <div class="card" style="background: #222">
                    <div class="card-section" >
                        <h6 style="color: white">Future sales changes curve</h6>
                        <canvas  id="ctxA"></canvas>
                    </div>
                </div>
            </div>

        </div>

@endsection

@section('script')

    <script src="{{ asset('js/forecasting.js') }}"></script>

@endsection

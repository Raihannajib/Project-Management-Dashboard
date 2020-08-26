<?php

namespace App\Http\Controllers;

use App\Sale;
use App\helpers\Database;
use App\statisticSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Capsule\Manager as Capsule;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class SaleController extends Controller
{
    // Dashboard page
    public function getStatistic(){

      //  $this->pysparkService();

        $count = Sale::all()->count();
        $min =statisticSale::where('summary',"min")->first();
        $max = statisticSale::where('summary',"max")->first();
        $stddev = statisticSale::where('summary',"stddev")->first();
        $mean = statisticSale::where('summary',"mean")->first();

       return view('Dashboard.index',compact('count','min','max','stddev','mean'));
    }

    // search sales based on region name
    public function manageSales(){
        $target = [];
        $regions = Sale::distinct()->get(['region']);
        return view('Dashboard.sales',compact('regions','target'));
    }
    public function regionSales(Request $request){
        $target = Sale::where('region',$request->region)->get();
        return $this->manageSales()->with(
            [
                'target' => $target
            ]
        );

    }

    //tracking orders page
    public function getMap(){
        return view('Dashboard/map');
    }

    //forecasting page
    public function seasonChart(){
        new Database();

        $Dates = Capsule::table('sales')->select(
            Capsule::raw("YEAR(order_date) year")
        )->groupBy('year')->get();

        $dates = [];
        foreach ($Dates as $key=>$value){
            array_push($dates,$value->year);
        }
        $date = max($dates);


        $d =[];
        for ($i = $date+1 ; $i < $date+20;$i++){
            array_push($d,$i);
        };
        return view('Dashboard/seasonChart',compact('d'));
    }

    //api list page
    public function allApiAdmin(){
        return view('Dashboard/api');
    }

///////////////APIs
    //sales
    public function get() {
        $sales = Sale::all();
        echo json_encode($sales);
    }
    //mapping
    public function getCountries(){

        new Database();
        $countries = Capsule::table('sales')->select(
            Capsule::raw('country '),
            Capsule::raw('count(order_id) as `orders`')
        )->groupBy('country')->get();

        echo json_encode(
            [
                "countries" => $countries
            ]
        );

    }
    public function getOrdersDateAndRegion(){
        new Database();
        $orders = Capsule::table('sales')->select(
            Capsule::raw("count(order_id) as `count`"),
            Capsule::raw("DATE_FORMAT(order_date,'%m-%y') date"),
            Capsule::raw("YEAR(order_date) year, Month(order_date) month")
        )->groupBy('year','month')->get();

        $regions = Capsule::table('sales')->select(
            Capsule::raw("region"),
            Capsule::raw("count(order_id) as `countO`")
        )->groupBy("region")->get();
        echo json_encode([
            "orders" => $orders,
            "regions" => $regions
        ]);
    }
    //sale-time
    public function seasonData(){
        new Database();
        $orders = Capsule::table('sales')->select(
            Capsule::raw("count(order_id) as `count`"),
            Capsule::raw("YEAR(order_date) year, Month(order_date) month")
        )->groupBy('year','month')->get();

        echo json_encode([
            'forcastingData' => $orders
        ]);
    }

    public function GainLostVariation(){
        return view('Dashboard/visualSales');
    }

    public function getChartData(){
        new Database();
        $orders = Capsule::table('sales')->select(
            Capsule::raw("SUM(total_cost) as `totalCost`"),
            Capsule::raw("SUM(total_revenue) as `totalRevenue`"),
            Capsule::raw("SUM(total_profit) as `totalProfit`"),
            Capsule::raw("YEAR(order_date) year")
        )->groupBy('year')->get();
        echo json_encode([
            "chartData" => $orders
        ]);
    }


    //Logout
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    // test run pyspark code
    public function pysparkService(){
        return shell_exec("python ../../../../pyspark_script/statistics.py");
    }
}

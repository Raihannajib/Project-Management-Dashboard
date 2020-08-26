<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['region','country','item_type','sales_channel','order_priority',
            'order_date','Order_id','ship_date','units_sold,','unit_price','unit_cost','total_revenue',
          'total_cost','total_profit'];
}

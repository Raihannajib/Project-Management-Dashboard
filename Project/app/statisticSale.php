<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statisticSale extends Model
{
    public $timestamps = true;
    protected $fillable = ['summary','units_sold,','unit_price','unit_cost','total_revenue',
        'total_cost','total_profit'];
}

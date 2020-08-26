<?php


namespace App;


class Helper
{

    public  static function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');

}}

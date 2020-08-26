<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    // api_get data about countries
    public function countriesData() {
        $myfile = fopen("../storage/app/countries.json", "r") or die("Unable to open file!");
        $data = fread($myfile,filesize("../storage/app/countries.json"));
        echo $data;
    }
}

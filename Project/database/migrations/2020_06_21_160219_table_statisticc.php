<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableStatisticc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_sales', function (Blueprint $table) {
            $table->id();
            $table->string('summary');
            $table->Integer('units_sold');
            $table->decimal('unit_price');
            $table->decimal('unit_cost');
            $table->bigInteger('total_revenue');
            $table->bigInteger('total_cost');
            $table->bigInteger('total_profit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistic_sales');
    }
}

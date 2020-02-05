<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ingredients', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->unsignedBigInteger('ingredient_id');
						$table->foreign('ingredient_id')->references('id')->on('ingredients');
						$table->double('first_stock');
						$table->double('stock_in');
						$table->double('stock_out');
						$table->double('stock_adjustment');
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
        Schema::dropIfExists('stock_ingredients');
    }
}

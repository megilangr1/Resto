<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->unsignedBigInteger('menu_id');
						$table->unsignedBigInteger('ingredient_id');
						$table->unsignedBigInteger('unit_id');
						$table->double('qty');
						$table->foreign('menu_id')->references('id')->on('menus');
						$table->foreign('ingredient_id')->references('id')->on('ingredients');
						$table->foreign('unit_id')->references('id')->on('units');
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
        Schema::dropIfExists('recipes');
    }
}

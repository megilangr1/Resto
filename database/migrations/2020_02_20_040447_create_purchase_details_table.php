<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->unsignedBigInteger('purchase_header_id');
						$table->foreign('purchase_header_id')->references('id')->on('purchase_headers');
						$table->unsignedBigInteger('ingredient_id');
						$table->foreign('ingredient_id')->references('id')->on('ingredients');
						$table->double('qty');
						$table->double('price');
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
        Schema::dropIfExists('purchase_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_headers', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->date('purchase_date');
						$table->unsignedBigInteger('supplier_id');
						$table->foreign('supplier_id')->references('id')->on('suppliers');
						$table->string('purchase_status');
						$table->double('total');
						$table->unsignedBigInteger('user_id');
						$table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('purchase_headers');
    }
}

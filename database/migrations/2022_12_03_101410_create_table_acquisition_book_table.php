<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAcquisitionBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisition_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_users_id');
            $table->unsignedBigInteger('purchase_requests_id');
            $table->unsignedBigInteger('status_id')->default(0);
            $table->unsignedBigInteger('deleted_flag')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('acquisition_books');
    }
}

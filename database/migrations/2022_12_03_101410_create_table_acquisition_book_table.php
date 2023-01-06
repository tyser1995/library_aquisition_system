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
            $table->string('date_received')->nullable();
            $table->unsignedBigInteger('accession_no')->nullable();
            $table->string('author')->nullable();
            $table->longText('title')->nullable();
            $table->string('edition')->nullable();
            $table->string('volume')->nullable();
            $table->string('pages')->nullable();
            $table->string('dealers')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('publisher')->nullable();
            $table->string('publication')->nullable();
            $table->string('copyright_date')->nullable();
            $table->longText('ISBN')->nullable();
            $table->string('recommended_by')->nullable();
            $table->string('department_name')->nullable();
            $table->string('section_name')->nullable();
            $table->string('acct_name')->nullable();
            $table->string('acct_no')->nullable();
            $table->decimal('actual_price', 8, 2)->nullable();
            $table->string('less_percentage')->nullable();
            $table->decimal('price_discounted', 8, 2)->nullable();
            $table->decimal('discount', 8, 2)->nullable();
            $table->string('dr_no')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('status_id')->default(11);
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

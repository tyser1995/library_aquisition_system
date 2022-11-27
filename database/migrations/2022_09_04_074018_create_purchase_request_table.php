<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_users_id');
            $table->string('rush_type'); //0 - not rush 1 - rush
            $table->string('author_name');
            $table->longText('title');
            $table->string('edition')->nullable();
            $table->string('copies_vol')->nullable();
            $table->string('publication_date')->nullable();
            $table->longText('publisher_name')->nullable();
            $table->longText('publisher_address')->nullable();
            $table->unsignedBigInteger('recommended_user_id');
            $table->unsignedBigInteger('approver_user_id');
            $table->string('charge_to')->nullable();
            $table->unsignedBigInteger('department_names_id');
            $table->string('subject')->nullable();
            $table->string('existing_no_of_titles')->nullable();
            $table->longText('note')->nullable();
            $table->decimal('amount', 8, 2)->default(0);
            $table->string('book_price')->nullable();
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
        Schema::dropIfExists('purchase_requests');
    }
}

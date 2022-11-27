<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBudgetBorroweds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_borroweds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_users_id');
            $table->unsignedBigInteger('dept_names_id');
            $table->unsignedBigInteger('dept_budgets_id');
            $table->decimal('amount', 8, 2)->default(0);
            $table->longText('remarks');
            $table->unsignedBigInteger('deleted_flag')->default(0);
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
        Schema::dropIfExists('budget_borroweds');
    }
}

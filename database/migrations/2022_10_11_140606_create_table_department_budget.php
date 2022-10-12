<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDepartmentBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_users_id')->nullable();
            $table->unsignedBigInteger('department_name_id')->nullable();
            $table->unsignedBigInteger('no_of_students')->default(0);
            $table->decimal('amount', 8, 2)->default(0);
            $table->unsignedBigInteger('total')->default(0);
            $table->unsignedBigInteger('semester')->default(1);
            $table->string('school_year')->nullable();
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
        Schema::dropIfExists('department_budgets');
    }
}

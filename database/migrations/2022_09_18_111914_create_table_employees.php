<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_users_id')->nullable();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->unsignedBigInteger('roles_id')->nullable();
            $table->unsignedBigInteger('department_names_id')->nullable();
            $table->string('emp_idnum')->nullable();
            $table->string('emp_lastname')->nullable();
            $table->string('emp_firstname')->nullable();
            $table->string('emp_middlename')->nullable();
            $table->string('emp_sex');
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
        // Schema::table('employees', function(Blueprint $table){
        //     $table->dropForeign('department_names_id');
        //     $table->dropForeign('users_id');
        //     $table->foreign('department_names_id')->references('id')->on('department_names');
        //     $table->foreign('users_id')->references('id')->on('users');
        // });

         Schema::dropIfExists('employees');
    }
}

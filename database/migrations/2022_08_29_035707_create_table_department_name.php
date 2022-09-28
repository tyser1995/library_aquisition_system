<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDepartmentName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_names', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_users_id')->nullable();
            $table->unsignedBigInteger('department_types_id')->unsigned();
            $table->string('department_code')->nullable();
            $table->string('department_name')->nullable();
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
        // Schema::table('department_names', function(Blueprint $table){
        //     $table->dropForeign('department_types_id');
        //     $table->foreign('department_types_id')->references('id')->on('department_types');
        // });
        Schema::dropIfExists('department_names');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrarySectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_users_id');
            $table->string('section_name')->nullable();
            $table->string('section_code')->nullable();
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
        Schema::dropIfExists('library_sections');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // Primary key
            $table->string('category_name');
            $table->string('category_image'); // Path or filename
            $table->text('category_description')->nullable();
            $table->unsignedBigInteger('admin_id'); // Foreign key
            $table->timestamps();

            $table->foreign('admin_id')
                  ->references('admin_id')->on('admins')
                  ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};

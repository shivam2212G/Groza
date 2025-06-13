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
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id'); // Primary key
            $table->string('shop_name');
            $table->string('email')->unique();
            $table->string('owner_name');
            $table->string('password');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('shop_image'); // Image path or URL
            $table->string('location');   // Shop address or city
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};

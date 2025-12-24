<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_notifications', function (Blueprint $table) {
            $table->id();
            $table->integer("fk_user_id");
            $table->string("type");
            $table->string("header");
            $table->string("body");
            $table->tinyInteger("hidden")->default(0);
            $table->timestamps();
            $table->tinyInteger("active")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_notifications');
    }
};

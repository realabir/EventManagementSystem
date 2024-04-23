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
        Schema::create('veranstaltungens', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->date('date')->nullable(false);
            $table->string('location')->nullable(false);
            $table->unsignedInteger('available_slots')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veranstaltungens');
    }
};

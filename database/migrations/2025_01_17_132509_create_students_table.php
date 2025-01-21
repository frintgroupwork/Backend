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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('birthday');
            $table->enum('gender', ['male', 'female', 'rather_not_to_say'])->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('phonenumber')->nullable();
    
            $table->string('university')->nullable();
            $table->string('degree')->nullable();
            $table->string('year')->nullable();
            $table->string('major')->nullable();
    
            $table->string('experience_name')->nullable();
            $table->string('position')->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

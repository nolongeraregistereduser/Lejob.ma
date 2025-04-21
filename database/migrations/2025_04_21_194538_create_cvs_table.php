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
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to link to the user
            $table->string('name');
            $table->string('titre');
            $table->string('email');
            $table->string('phone');
            $table->text('education');
            $table->text('experience');
            $table->text('skills');
            $table->text('certifications');
            $table->text('languages');
            $table->text('projects');
            $table->string('cv_file')->nullable(); // Optional field for CV file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};

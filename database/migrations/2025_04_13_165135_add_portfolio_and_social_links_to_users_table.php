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
        Schema::table('users', function (Blueprint $table) {
            $table->text('portfolio')->nullable()->after('available_for_hire'); // portfolio projects
            $table->string('linkedin')->nullable()->after('portfolio'); // LinkedIn profile
            $table->string('github')->nullable()->after('linkedin'); // GitHub profile
            $table->string('twitter')->nullable()->after('github'); // Twitter/X profile
            $table->string('website')->nullable()->after('twitter'); // Personal website
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'portfolio', 
                'linkedin', 
                'github', 
                'twitter', 
                'website'
            ]);
        });
    }
};

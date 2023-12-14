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
            $table->char('type', 1)->default('U');
            $table->integer('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users', 'type')) {
                $table->dropColumn('type');
            }
            if(Schema::hasColumn('users', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};

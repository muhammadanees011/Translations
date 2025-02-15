<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->index('key');
            $table->index('locale');
            $table->index('content');
            $table->index('context');
        });
    }

    public function down(): void
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->dropIndex(['key']);
            $table->dropIndex(['locale']);
            $table->dropIndex(['context']);
        });
    }
};

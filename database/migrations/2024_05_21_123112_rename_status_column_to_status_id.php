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
        Schema::table('petitions', function (Blueprint $table) {
            //
            $table->dropColumn("status");
            $table->unsignedBigInteger("status_id")->default(1);
            $table->foreign("status_id")->references("id")->on("petition_statuses");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('petitions', function (Blueprint $table) {
            //
        });
    }
};

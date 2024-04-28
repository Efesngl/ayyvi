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
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('petition_header');
            $table->text('petition_content');
            $table->text('petition_banner');
            $table->integer('creator')->index('creator');
            $table->integer('target_sign');
            $table->integer("status")->default("1");
            $table->foreign("status")->references("id")->on("petition_statuses");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petitions');
    }
};

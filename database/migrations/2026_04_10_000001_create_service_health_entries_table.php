<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_health_entries', function (Blueprint $table) {
            $table->string('service_key', 32)->primary();
            $table->string('name', 64);
            $table->string('group_label', 64);
            $table->string('check_type', 16);
            $table->string('target', 512);
            $table->string('status', 16);
            $table->unsignedInteger('latency_ms')->nullable();
            $table->text('detail')->nullable();
            $table->string('raw_status', 128)->nullable();
            $table->timestamp('checked_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_health_entries');
    }
};

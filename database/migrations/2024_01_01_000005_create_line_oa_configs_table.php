<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('line_oa_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('channel_id')->nullable();
            $table->string('channel_secret')->nullable();
            $table->string('access_token')->nullable();
            $table->boolean('webhook_verified')->default(false);
            $table->string('rich_menu_id')->nullable();
            $table->text('greeting_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('line_oa_configs');
    }
};

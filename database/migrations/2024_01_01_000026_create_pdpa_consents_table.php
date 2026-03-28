<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdpa_consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('consent_type');
            $table->timestamp('consented_at');
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->string('version')->default('1.0');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdpa_consents');
    }
};

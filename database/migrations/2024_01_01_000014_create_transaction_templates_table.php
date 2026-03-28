<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('account_set_id')->constrained('account_sets')->cascadeOnDelete();
            $table->string('name');
            $table->string('type'); // income, expense
            $table->string('payment_method'); // cash, bank
            $table->string('category');
            $table->string('sub_category')->nullable();
            $table->decimal('default_amount', 15, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_templates');
    }
};

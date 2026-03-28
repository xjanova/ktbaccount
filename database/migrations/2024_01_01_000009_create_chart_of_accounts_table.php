<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('account_set_id')->nullable()->constrained('account_sets')->nullOnDelete();
            $table->string('code', 5);
            $table->string('name');
            $table->string('category'); // asset, liability, equity, revenue, expense
            $table->string('parent_code', 5)->nullable();
            $table->boolean('is_control_account')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('normal_balance'); // debit, credit
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['tenant_id', 'account_set_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chart_of_accounts');
    }
};

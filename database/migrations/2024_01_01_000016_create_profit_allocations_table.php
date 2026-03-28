<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profit_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('account_set_id')->constrained('account_sets')->cascadeOnDelete();
            $table->integer('fiscal_year');
            $table->decimal('total_amount', 15, 2);
            $table->date('meeting_date')->nullable();
            $table->text('meeting_resolution')->nullable();
            $table->string('status')->default('draft');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('profit_allocation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profit_allocation_id')->constrained('profit_allocations')->cascadeOnDelete();
            $table->string('category');
            $table->decimal('percentage', 5, 2);
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profit_allocation_items');
        Schema::dropIfExists('profit_allocations');
    }
};

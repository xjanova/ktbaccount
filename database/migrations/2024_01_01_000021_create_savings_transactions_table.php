<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('savings_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('savings_account_id')->constrained('savings_accounts');
            $table->string('type');
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_after', 15, 2);
            $table->date('transaction_date');
            $table->text('description')->nullable();
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries');
            $table->foreignId('processed_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('savings_transactions');
    }
};

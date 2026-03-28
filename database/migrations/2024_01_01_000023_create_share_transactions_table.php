<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('share_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('share_id')->constrained('shares');
            $table->string('type');
            $table->integer('shares');
            $table->decimal('amount', 15, 2);
            $table->date('transaction_date');
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries');
            $table->foreignId('processed_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('share_transactions');
    }
};

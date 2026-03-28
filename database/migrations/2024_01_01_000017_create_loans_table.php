<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('account_set_id')->constrained();
            $table->foreignId('member_id')->constrained();
            $table->string('loan_code');
            $table->string('loan_type')->default('regular');
            $table->decimal('principal', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('term_months');
            $table->date('approved_date')->nullable();
            $table->date('disbursed_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('guarantor_1_id')->nullable()->constrained('members');
            $table->foreignId('guarantor_2_id')->nullable()->constrained('members');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->decimal('outstanding_balance', 15, 2)->default(0);
            $table->foreignId('journal_entry_id')->nullable()->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['tenant_id', 'loan_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};

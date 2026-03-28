<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('account_set_id')->nullable()->constrained('account_sets');
            $table->foreignId('member_id')->constrained('members');
            $table->integer('total_shares')->default(0);
            $table->decimal('total_value', 15, 2)->default(0);
            $table->decimal('share_price', 10, 2)->default(10);
            $table->timestamps();

            $table->unique(['tenant_id', 'member_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};

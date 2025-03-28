<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Add new columns (except description which was already added)
            $table->string('website')->nullable()->after('amount');
            $table->string('logo')->nullable()->after('website');

            // Rename and modify existing columns
            $table->renameColumn('currency', 'currency_id');
            $table->renameColumn('frequency', 'billing_cycle');
            $table->renameColumn('active', 'inactive');
            $table->renameColumn('household_id', 'payer_user_id');
            
            // Change column types
            $table->foreignId('currency_id')->change()->constrained('currencies');
            $table->boolean('inactive')->default(false)->change();
            $table->foreignId('payer_user_id')->change()->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Remove added columns
            $table->dropColumn(['website', 'logo']);

            // Revert column changes
            $table->renameColumn('currency_id', 'currency');
            $table->renameColumn('billing_cycle', 'frequency');
            $table->renameColumn('inactive', 'active');
            $table->renameColumn('payer_user_id', 'household_id');
            
            // Revert column types
            $table->string('currency', 3)->change();
            $table->boolean('active')->default(true)->change();
            $table->foreignId('household_id')->change()->constrained();
        });
    }
};

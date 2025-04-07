<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id', 10)->unique();
            $table->timestamp('service_submission_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_country')->nullable();
            $table->string('electronic_account_name')->nullable();
            $table->string('type')->nullable();
            $table->text('agreed_to_terms')->nullable();
            $table->string('phone_number')->nullable();
            $table->decimal('amount_previously_paid', 10, 2)->nullable();
            $table->string('electronic_signature')->nullable();
            $table->text('comments')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};

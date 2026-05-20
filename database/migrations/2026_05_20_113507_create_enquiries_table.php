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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('associate_id')->nullable()->constrained('associates')->cascadeOnDelete();
            $table->foreignId('source_id')->nullable()->constrained('sources')->cascadeOnDelete();
            $table->foreignId('enquiry_types_id')->nullable()->constrained('enquiry_types')->cascadeOnDelete();
            $table->string('customer_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('plot_size')->nullable()->comment('In Sqft');
            $table->string('budget')->nullable();
            $table->string('location')->nullable();
            $table->date('followup_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};

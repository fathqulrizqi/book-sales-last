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
        Schema::create('shipments', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('order_id');
          $table->string('tracking_number');
          $table->text('shipping_address');
          $table->enum('status', ['pending', 'shipped', 'delivered']);
          $table->unsignedBigInteger('staff_shipped_by')->nullable();
          $table->timestamp('staff_shipped_at')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->date('purchase_date');
            $table->string('reference_no')->nullable();
            $table->string('total_quantity');
            $table->decimal('sub_amount',10,2)->default(0);
            $table->decimal('tax',10,2)->default(0)->nullable();
            $table->integer('discount_type')->comment('0 amount, 1 percent')->default(0)->nullable();
            $table->decimal('discount',10,2)->default(0)->nullable();
            $table->decimal('other_charge',10,2)->default(0)->nullable();
            $table->decimal('round_of',10,2)->default(0)->nullable();
            $table->decimal('grand_total',10,2)->default(0);
            $table->string('note')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->integer('payment_status')->comment('0 unpaid, 1 paid, 2 partial_paid')->default(0)->nullable();
            $table->integer('status')->comment('1 parches, 2 return, 3 partial_return, 4 cancel')->default(1);
            $table->string('status_note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};

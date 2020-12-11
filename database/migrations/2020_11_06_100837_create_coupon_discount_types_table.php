<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponDiscountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_discount_types', function (Blueprint $table) {
            $table->id();
            $table->integer('coupon_id');
            $table->integer('amount_off_total')->nullable();
            $table->integer('percent_off_total')->nullable();
            $table->integer('percent_or_amount_off_total')->nullable();
            $table->integer('percent_and_amount_off_total')->nullable();
            $table->timestamps();
        });

        DB::table('coupon_discount_types')->insert([
            /** Available DISCOUNT TYPES */
            [
                'coupon_id' => 1,
                'amount_off_total' => 10,
                'percent_off_total' => null,
                'percent_or_amount_off_total' => null,
                'percent_and_amount_off_total' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_id' => 2,
                'amount_off_total' => null,
                'percent_off_total' => 10,
                'percent_or_amount_off_total' => null,
                'percent_and_amount_off_total' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_id' => 3,
                'amount_off_total' => 10,
                'percent_off_total' => 10,
                'percent_or_amount_off_total' => 1,
                'percent_and_amount_off_total' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_id' => 4,
                'amount_off_total' => 10,
                'percent_off_total' => 10,
                'percent_or_amount_off_total' => null,
                'percent_and_amount_off_total' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_discount_types');
    }
}

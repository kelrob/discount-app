<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('coupon_id');
            $table->integer('total_before_discount');
            $table->integer('minimum_items');
            $table->timestamps();
        });

        DB::table('coupon_rules')->insert([
            /** Available COUPON RULES */
            [
                'coupon_id' => 1,
                'total_before_discount' => 50,
                'minimum_items' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_id' => 2,
                'total_before_discount' => 100,
                'minimum_items' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_id' => 3,
                'total_before_discount' => 200,
                'minimum_items' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_id' => 4,
                'total_before_discount' => 1000,
                'minimum_items' => 0,
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
        Schema::dropIfExists('coupon_rules');
    }
}

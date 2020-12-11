<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code');
            $table->timestamps();
        });

        DB::table('coupons')->insert([
            /** Available COUPON CODES */
            [
                'coupon_code' => 'FIXED10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_code' => 'PERCENT10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_code' => 'MIXED10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'coupon_code' => 'REJECTED10',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}

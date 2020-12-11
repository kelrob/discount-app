<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->timestamps();
        });

        DB::table('products')->insert([
            /** Available COUPON CODES */
            [
                'name' => 'PRODUCT NAME 1',
                'price' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 2',
                'price' => 2000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 3',
                'price' => 300,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 4',
                'price' => 400,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 5',
                'price' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 6',
                'price' => 600,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 7',
                'price' => 70,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 8',
                'price' => 80,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 9',
                'price' => 90,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PRODUCT NAME 10',
                'price' => 100,
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
        Schema::dropIfExists('products');
    }
}

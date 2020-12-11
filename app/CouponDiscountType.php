<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponDiscountType extends Model
{
    protected $guarded = ['id'];

    public function coupon() {
        return $this->belongTo('App\Coupon');
    }
}

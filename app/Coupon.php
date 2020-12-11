<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = ['id'];

    public function coupon_rule() {
        return $this->hasOne('App\CouponRule');
    }

    public function coupon_discount_type() {
        return $this->hasOne('App\CouponDiscountType');
    }
}

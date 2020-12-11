<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponRule extends Model
{
    protected $guarded = ['id'];

    public function coupon() {
        return $this->belongTo('App\Coupon');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
    public function validateCouponCode($couponCode, $total, $productCount) {

        $newTotal = $total;
        $rulePassed = false;

        // Check Coupon Code Exist
        $couponCount = Coupon::where('coupon_code', $couponCode)->count(); 

        if ($couponCount > 0) {
            
            // Fetch Coupon and with rules and discount type
            $coupon = Coupon::with('coupon_rule', 'coupon_discount_type')->where('coupon_code', $couponCode)->first();

            // Check rules
            if ($total > $coupon->coupon_rule->total_before_discount && $productCount >= $coupon->coupon_rule->minimum_items) {
                $rulePassed = true;
            }

            // Check Discount Type and Apply
            if ($rulePassed) {

                // Discount of Amount off alone
                if ($coupon->coupon_discount_type->percent_off_total == null) {
                    if ($coupon->coupon_discount_type->percent_or_amount_off_total == null) {
                        if ($coupon->coupon_discount_type->percent_and_amount_off_total == null) {
                            if ($coupon->coupon_discount_type->amount_off_total != null) {
                                $newTotal = $total - $coupon->coupon_discount_type->amount_off_total;
                            }
                        }
                    }
                }

                // Discount of Percentage off alone
                if ($coupon->coupon_discount_type->amount_off_total == null) {
                    if ($coupon->coupon_discount_type->percent_or_amount_off_total == null) {
                        if ($coupon->coupon_discount_type->percent_and_amount_off_total == null) {
                            if ($coupon->coupon_discount_type->percent_off_total != null) {
                                $newTotal = $total - ($total * ($coupon->coupon_discount_type->percent_off_total / 100));
                            }
                        }
                    }
                }

                // Discount of Either Amount off or percent off (Deends on which is greater)
                if ($coupon->coupon_discount_type->amount_off_total != null) {
                    if ($coupon->coupon_discount_type->percent_or_amount_off_total != null) {
                        if ($coupon->coupon_discount_type->percent_and_amount_off_total == null) {
                            if ($coupon->coupon_discount_type->percent_off_total != null) {

                                $newTotal1 = $total - ($total * ($coupon->coupon_discount_type->percent_off_total / 100));
                                $newTotal2 = $total - $coupon->coupon_discount_type->amount_off_total;
                                
                                $newTotal = $newTotal1 >= $newTotal2 ? $newTotal2 : $newTotal1;
                            }
                        }
                    }
                }

                // Discount of Both percent off and amount off
                if ($coupon->coupon_discount_type->amount_off_total != null) {
                    if ($coupon->coupon_discount_type->percent_or_amount_off_total == null) {
                        if ($coupon->coupon_discount_type->percent_and_amount_off_total != null) {
                            if ($coupon->coupon_discount_type->percent_off_total != null) {

                                $percentTotal = $total - ($total * ($coupon->coupon_discount_type->percent_off_total / 100));
                                $newTotal = $percentTotal - $coupon->coupon_discount_type->amount_off_total;
                                
                            }
                        }
                    }
                }

            }


            return response()->json([
                'status' => true, 
                'message' => 'Validated',
                'amount' => $newTotal
            ]);

        } else {
            return response()->json([
                'status' => false, 
                'message' => 'Invalid Coupon Code'
            ]);
        }
    }
}

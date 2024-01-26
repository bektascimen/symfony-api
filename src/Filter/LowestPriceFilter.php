<?php

namespace App\Filter;

use App\Dto\Contracts\PromotionEnquiryInterface;
use App\Filter\Contracts\PromotionsFilterInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{
    public function apply(PromotionEnquiryInterface $enquiry): PromotionEnquiryInterface
    {
        $enquiry->setPrice(200);
        $enquiry->setDiscountedPrice(100);
        $enquiry->setPromotionId(3);
        $enquiry->setPromotionName("Black friday");

        return $enquiry;
    }
}
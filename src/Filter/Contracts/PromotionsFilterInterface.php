<?php

namespace App\Filter\Contracts;

use App\Dto\Contracts\PromotionEnquiryInterface;

interface PromotionsFilterInterface
{
    public function apply(PromotionEnquiryInterface $enquiry): PromotionEnquiryInterface;
}
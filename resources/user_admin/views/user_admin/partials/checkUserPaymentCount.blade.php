@php

    $checkUserPaymentCountObj = new App\Http\Controllers\user_admin\userBusinessListingController();
    $checkUserFranchiseListingCountObj = new App\Http\Controllers\user_admin\userFranchiseController();
    $checkUserCouponAndOfferCountObj = new App\Http\Controllers\user_admin\userCouponAndOfferController();
    $checkUserProductAndServiceCountObj = new App\Http\Controllers\user_admin\userProductAndServiceController();

    $checkBusinesListingPaymentCount = $checkUserPaymentCountObj->checkBusinesListingPaymentCount();
    $checkFranchisePaymentCount = $checkUserPaymentCountObj->checkFranchisePaymentCount();
    $checkCouponAndOfferPaymentCount = $checkUserPaymentCountObj->checkCouponAndOfferPaymentCount();
    $checkProductAndServicePaymentCount = $checkUserPaymentCountObj->checkProductAndServicePaymentCount();

    $checkBusinessListingCount = $checkUserPaymentCountObj->checkBusinessListingCount();
    $checkFranchiseListingCount = $checkUserFranchiseListingCountObj->checkFranchiseListingCount();
    $checkCouponAndOfferCount = $checkUserCouponAndOfferCountObj->checkCouponAndOfferCount();
    $checkProductServiceCount = $checkUserProductAndServiceCountObj->checkProductServiceCount();

    if ($checkBusinesListingPaymentCount == 0) {
        $businessListingUrl = '../business-listing';
    } else {
        if ($checkBusinessListingCount == $checkBusinesListingPaymentCount) {
            $businessListingUrl = '../business-listing';
        } else {
            $businessListingUrl = '../add-business-details';
        }
    }

    if ($checkFranchisePaymentCount == 0) {
        $franchiseListingUrl = '../business-listing';
    } else {
        if ($checkFranchiseListingCount == $checkFranchisePaymentCount) {
            $franchiseListingUrl = '../business-listing';
        } else {
            $franchiseListingUrl = USER_ADMIN_URL . 'franchiseAdd';
        }
    }

    if ($checkCouponAndOfferPaymentCount == 0) {
        $couponOfferUrl = '../business-listing';
    } else {
        if ($checkCouponAndOfferCount == $checkCouponAndOfferPaymentCount) {
            $couponOfferUrl = '../business-listing';
        } else {
            $couponOfferUrl = USER_ADMIN_URL . 'couponOfferAdd';
        }
    }

    if ($checkProductAndServicePaymentCount == 0) {
        $productServiceUrl = '../business-listing';
    } else {
        if ($checkProductServiceCount == $checkProductAndServicePaymentCount) {
            $productServiceUrl = '../business-listing';
        } else {
            $productServiceUrl = USER_ADMIN_URL . 'productServiceAdd';
        }
    }
    return $listingUrls = compact(
        'businessListingUrl',
        'franchiseListingUrl',
        'couponOfferUrl',
        'productServiceUrl'
    );
@endphp

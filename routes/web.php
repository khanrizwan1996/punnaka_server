
<?php

// ******* Front End

use App\Exports\businessListingExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\dashboardController;
use App\Http\Controllers\frontend\authController;
use App\Http\Controllers\frontend\homeController;
use App\Http\Controllers\frontend\aboutUsController;
use App\Http\Controllers\frontend\contactUsController;
use App\Http\Controllers\frontend\shoppingBlogController;
use App\Http\Controllers\frontend\businessListingController;
use App\Http\Controllers\frontend\blogsCategoryController;
use App\Http\Controllers\frontend\writeForUsController;
use App\Http\Controllers\frontend\ourServicesController;
use App\Http\Controllers\frontend\mallController;
use App\Http\Controllers\frontend\brandController;
use App\Http\Controllers\frontend\userController;
use App\Http\Controllers\frontend\websiteContentController;
use App\Http\Controllers\frontend\searchController;
use App\Http\Controllers\frontend\couponController;
use App\Http\Controllers\frontend\couponAndOfferController;
use App\Http\Controllers\frontend\franchiseController;
use App\Http\Controllers\frontend\offersController;
use App\Http\Controllers\frontend\productAndServiceController;
use App\Http\Controllers\frontend\pressReleaseController;


// ******* Admin
//use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\loginController;
use App\Http\Controllers\admin\adminBannerController;
use App\Http\Controllers\admin\adminAboutUsController;
use App\Http\Controllers\admin\blogController;
use App\Http\Controllers\admin\categoryMainController;
use App\Http\Controllers\admin\categorySubController;
use App\Http\Controllers\admin\blogCategoryController;
use App\Http\Controllers\admin\adminBusinessListingController;
use App\Http\Controllers\admin\adminWriteForUsController;
use App\Http\Controllers\admin\adminOurServicesController;
use App\Http\Controllers\admin\adminMallController;
use App\Http\Controllers\admin\adminBrandsController;
use App\Http\Controllers\admin\adminDashboardController;
use App\Http\Controllers\admin\adminCouponController;
use App\Http\Controllers\admin\adminOffersController;
use App\Http\Controllers\admin\adminFranchiseController;
use App\Http\Controllers\admin\adminProductAndServiceController;
use App\Http\Controllers\admin\adminUserController;
use App\Http\Controllers\admin\adminCouponAndOfferController;
use App\Http\Controllers\admin\adminWebsiteContentController;
use App\Http\Controllers\admin\adminPressReleaseController;


// ******* User Admin
use App\Http\Controllers\user_admin\userAuthController;
use App\Http\Controllers\user_admin\userBusinessListingController;
use App\Http\Controllers\user_admin\userCouponController;
use App\Http\Controllers\user_admin\userDashboardController;
use App\Http\Controllers\user_admin\userFranchiseController;
use App\Http\Controllers\user_admin\userOfferController;
use App\Http\Controllers\user_admin\userProductAndServiceController;
use App\Http\Controllers\user_admin\userCouponAndOfferController;

use Illuminate\Support\Facades\Artisan;
// ************************ User Admin Routes ************************

Route::get('auth/google/callback',[userAuthController::class,'googleHandel']);
Route::get('auth/facebook/callback', [userAuthController::class,'loginWithFacebook']);

Route::prefix('user-admin')->group(function () {
    
    // ----------- Dashboard Route -----------
    Route::get('googleLogin',[userAuthController::class,'googleLogin']);
    Route::get('facebookLogin', [userAuthController::class,'facebookRedirect']);
    Route::get('dashboard',[userDashboardController::class,'dashboardView']);
    Route::get('register',[userAuthController::class,'registerView']);
    Route::post('register',[userAuthController::class,'register']);
    Route::get('login',[userAuthController::class,'loginView']);
    Route::post('login',[userAuthController::class,'login']);

    Route::get('profileEdit',[userAuthController::class,'profileEditView']);
    Route::post('passwordUpdate',[userAuthController::class,'passwordUpdate']);
    Route::post('profileUpdate',[userAuthController::class,'profileUpdate']);

    // ----------- Offer Route -----------
    Route::get('offerAdd',[userOfferController::class,'OfferAddView']);
    Route::post('offerStore',[userOfferController::class,'offerStore']);
    Route::get('offerList',[userOfferController::class,'offerListView']);
    Route::get('offerEdit/{id}',[userOfferController::class,'OfferEditView']);
    Route::post('offerUpdate/{id}',[userOfferController::class,'offerUpdate']);


    // ----------- Coupon Route -----------
    Route::get('couponAdd',[userCouponController::class,'couponAddView']);
    Route::post('couponStore',[userCouponController::class,'couponStore']);
    Route::get('couponList',[userCouponController::class,'couponListView']);
    Route::get('couponEdit/{id}',[userCouponController::class,'couponEditView']);
    Route::post('couponUpdate/{id}',[userCouponController::class,'couponUpdate']);


    Route::get('paymentHistory',[userBusinessListingController::class,'paymentHistoryListView']);
    Route::get('checkPlanPurchaseStatus/{planType}',[userBusinessListingController::class,'checkPlanPurchaseStatus']);
    Route::get('businessListing',[userBusinessListingController::class,'businessListingView']);


    // ----------- Franchise Route -----------

    Route::get('franchiseAdd',[userFranchiseController::class,'franchiseAddView']);
    Route::post('getFranchiseSubCategory',[userFranchiseController::class,'getFranchiseSubCategory']);
    Route::post('franchiseStore',[userFranchiseController::class,'franchiseStore']);
    Route::get('franchiseList',[userFranchiseController::class,'franchiseListView']);
    Route::get('franchiseEdit/{id}',[userFranchiseController::class,'franchiseEditView']);
    Route::post('franchiseUpdate/{id}',[userFranchiseController::class,'franchiseUpdate']);
    Route::get('franchiseOtherDetailList/{id}',[userFranchiseController::class,'franchiseOtherDetailListView']);
    Route::post('franchiseImageStore',[userFranchiseController::class,'franchiseImageStore']);
    Route::get('franchiseImageRemove/{id}/{franchiseId}/{path}',[userFranchiseController::class,'franchiseImageRemove']);
    Route::post('franchiseLocationDetailStore',[userFranchiseController::class,'franchiseLocationDetailStore']);
    Route::get('franchiseLocationDetailRemove/{id}/{franchiseId}',[userFranchiseController::class,'franchiseLocationDetailRemove']);


    /*
    Old Backup
    Route::post('user-admin/getFranchiseSubCategory',[userFranchiseController::class,'getFranchiseSubCategory']);
    Route::post('user-admin/getFranchiseChildCategory',[userFranchiseController::class,'getFranchiseChildCategory']);
    Route::get('user-admin/franchiseAdd',[userFranchiseController::class,'franchiseAddView']);
    Route::post('user-admin/franchiseStore',[userFranchiseController::class,'franchiseStore']);

    Route::get('user-admin/franchiseEdit/{id}',[userFranchiseController::class,'franchiseEditView']);
    Route::post('user-admin/franchiseUpdate/{id}',[userFranchiseController::class,'franchiseUpdate']);
    Route::get('user-admin/franchiseImageList/{id}',[userFranchiseController::class,'franchiseImagesListView']);
    Route::post('user-admin/franchiseImageStore',[userFranchiseController::class,'franchiseImageStore']);
    Route::get('user-admin/franchiseImageRemove/{id}/{franchiseId}/{path}',[userFranchiseController::class,'franchiseImageRemove']);
    */


    // ----------- Product And Service Route -----------
    Route::get('productServiceAdd',[userProductAndServiceController::class,'productServiceAddView']);
    Route::get('productServiceList',[userProductAndServiceController::class,'productServiceListView']);
    Route::post('productServiceStore',[userProductAndServiceController::class,'productServiceStore']);
    Route::get('productServiceEdit/{id}',[userProductAndServiceController::class,'productServiceEdit']);
    Route::post('productServiceUpdate/{id}',[userProductAndServiceController::class,'productServiceUpdate']);


    // ----------- Coupon And Offer Route -----------
    Route::get('couponOfferAdd',[userCouponAndOfferController::class,'couponOfferAddView']);
    Route::post('couponOfferStore',[userCouponAndOfferController::class,'couponOfferStore']);
    Route::get('couponOfferList',[userCouponAndOfferController::class,'couponOfferListView']);
    Route::get('couponOfferEdit/{id}',[userCouponAndOfferController::class,'couponOfferEditView']);
    Route::post('couponOfferUpdate/{id}',[userCouponAndOfferController::class,'couponOfferUpdate']);

});


// ************************ Front End Routes ************************

// ----------- Auth Route -----------
// Route::get('register',[authController::class,'register_view']);
// Route::post('register',[authController::class,'register']);
// Route::get('login',[authController::class,'login_view']);
// Route::post('login',[authController::class,'login']);
Route::get('userLogout',[authController::class,'userLogout']);

// ----------- Common Route -----------
Route::get('/',[homeController::class,'indexView']);
Route::get('home',[homeController::class,'indexView']);
Route::get('about-us',[aboutUsController::class,'aboutUsView']);
Route::get('contact-us',[contactUsController::class,'contactUsView']);
Route::get('write-for-us',[writeForUsController::class,'writeForUsView']);
Route::post('writeForUsStore',[writeForUsController::class,'writeForUsStore']);
Route::get('our-services',[ourServicesController::class,'ourServicesView']);
Route::post('ourServiceStore',[ourServicesController::class,'ourServiceStore']);
Route::get('search',[searchController::class,'searchView']);
Route::post('newsLetterStore',[homeController::class,'newsLetterStore']);

// ----------- User Route -----------
Route::get('dashboard',[dashboardController::class,'dashboardView']);
//Route::get('paymentHistory',[userController::class,'paymentHistoryListView']);
Route::get('profile',[userController::class,'profileView']);
Route::post('profileUpdate',[userController::class,'profileUpdate']);
Route::get('userPasswordChange',[userController::class,'userPasswordView']);
Route::post('userPasswordUpdate',[userController::class,'userPasswordUpdate']);


//Route::get('businessListing/{status}',[businessListingController::class,'businessListingView']);
Route::get('businessListingEdit/{id}',[businessListingController::class,'businessListingEditView']);
Route::post('businessListingDetailUpdate/{id}',[businessListingController::class,'businessListingDetailUpdate']);
Route::get('businessListingTimingEdit/{id}',[businessListingController::class,'businessListingTimingEditView']);
Route::post('businessListingTimingUpdate/{id}',[businessListingController::class,'businessListingTimingUpdate']);
Route::get('businessListingImageEdit/{id}',[businessListingController::class,'businessListingImageEditView']);
Route::post('userBusinessListingImagesLogoStore/{id}',[businessListingController::class,'userBusinessListingImagesLogoStore']);
Route::post('userBusinessListingImagesIDProodStore/{id}',[businessListingController::class,'userBusinessListingImagesIDProodStore']);
Route::get('userBusinessListingImagesDelete/{id}/{business_id}/{type}/{path}',[businessListingController::class,'userBusinessListingImagesDelete']);


//Route::get('offerList/{status}',[offersController::class,'offerListView']);
// Route::get('offerAdd',[offersController::class,'OfferAddView']);
// Route::post('offerStore',[offersController::class,'offerStore']);
//Route::get('offerEdit/{id}',[offersController::class,'OfferEditView']);
//Route::post('offerUpdate/{id}',[offersController::class,'offerUpdate']);


Route::get('couponList/{status}',[couponController::class,'couponListView']);
Route::get('couponAdd',[couponController::class,'couponAddView']);
Route::post('couponStore',[couponController::class,'couponStore']);
Route::get('couponEdit/{id}',[couponController::class,'couponEditView']);
Route::post('couponUpdate/{id}',[couponController::class,'couponUpdate']);


// ----------- Website Content Route -----------
Route::get('privacy-policy',[websiteContentController::class,'privacyPoliciyView']);
Route::get('term-conditions',[websiteContentController::class,'termsConditionsView']);


// ----------- Shopping Blogs Route -----------
Route::get('blogs',[shoppingBlogController::class,'shoppingBlogView']);
Route::get('detail-blog/{title}',[shoppingBlogController::class,'shoppingBlogDetailView']);
Route::post('blogCommentStore',[shoppingBlogController::class,'blogCommentStore']);


// ----------- Blog Categroy Route -----------
Route::get('blog-list/{title}/{title1}',[blogsCategoryController::class,'blogCategoryListView']);
Route::get('blog-info/{title}/{title1}',[blogsCategoryController::class,'blogCategoryDetailView']);
Route::post('blogCatCommentStore',[blogsCategoryController::class,'blogCatCommentStore']);



// ----------- Franchise Listing Route -----------

Route::get('franchise-list/{country}',[franchiseController::class,'franchiseLisitngView']);
Route::get('franchise-city/{city}',[franchiseController::class,'franchiseLisitngCityView']);
Route::get('franchise-category/{city}/{category}',[franchiseController::class,'franchiseCategoryListView']);
Route::get('franchise/{city}/{category}/{title}',[franchiseController::class,'franchiseDetailView']);
Route::post('franchiseEnquiryStore',[franchiseController::class,'franchiseEnquiryStore']);



// Route::get('franchise-list/{country}',[franchiseController::class,'franchiseLisitngView']);
// Route::get('franchise-city/{city}',[franchiseController::class,'franchiseLisitngCityView']);
// Route::get('franchise-category/{city}/{category}',[franchiseController::class,'franchiseCategoryListView']);
// Route::get('franchise-detail/{city}/{category}/{title}',[franchiseController::class,'franchiseDetailView']);
// Route::get('franchiseAdd',[franchiseController::class,'franchiseAddView']);
// Route::post('getFranchiseSubCategory',[franchiseController::class,'getFranchiseSubCategory']);
// Route::post('getFranchiseChildCategory',[franchiseController::class,'getFranchiseChildCategory']);
// Route::post('franchiseStore',[franchiseController::class,'franchiseStore']);
// Route::get('franchiseList/{status}',[franchiseController::class,'franchiseListView']);


// ----------- Business Listing Route -----------
Route::get('business-list/{country}',[businessListingController::class,'businessLisitngView']);
Route::get('city/{city}',[businessListingController::class,'businessLisitngCityView']);
Route::get('category/{city}/{category}',[businessListingController::class,'businessLisitngCategoryView']);
Route::get('detail/{city}/{category}/{title}',[businessListingController::class,'businessLisitngDetailView']);
Route::get('add-business-details',[businessListingController::class,'businessLisitngAddView']);
Route::post('getBusinessSubCategory',[businessListingController::class,'getBusinessSubCategory']);
Route::post('businessDetailStore',[businessListingController::class,'businessDetailStore']);
Route::get('business-listing',[businessListingController::class,'businessLisitngPlanView']);
Route::post('choose-plan/{plan_type}',[businessListingController::class,'businessLisitngPlanSessionSet']);
Route::get('pay',[businessListingController::class,'businessListingPaymentView']);
Route::post('businessListingPaymentProcess',[businessListingController::class,'businessListingPaymentProcess']);
Route::post('businessListingPaymentProcessTemp',[businessListingController::class,'businessListingPaymentProcessTemp']);
Route::post('/razorpay/success', [businessListingController::class, 'paymentSuccess'])->name('razorpay.success');

Route::post('businessListingReviewStore', [businessListingController::class, 'businessListingReviewStore']);

//Route::get('checkPlanPurchaseStatus/{planType}',[businessListingController::class,'checkPlanPurchaseStatus']);
//Route::post('/razorpay/payment', [businessListingController::class, 'payment'])->name('razorpay.payment');


// ----------- Mall Route -----------
Route::get('detail-mall/{city}/{name}',[mallController::class,'mallDetailView']);

// ----------- Brand Route -----------
Route::get('detail-brand/{city}/{mall_name}/{brand_name}',[brandController::class,'brandDetailView']);

// ----------- Coupon Route -----------

/* Old Coupon Routs
Route::get('coupon-list/{country}',[couponController::class,'couponListingView']);
Route::get('coupon-city/{city}',[couponController::class,'couponCityView']);
Route::get('coupon-category/{city}/{category}',[couponController::class,'couponCategoryView']);
Route::get('coupon-detail/{city}/{category}/{title}',[couponController::class,'couponDetailView']);
*/


Route::get('coupon-list/{type}',[couponAndOfferController::class,'couponTypeListingView']);
// Route::get('coupon-city/{city}',[couponController::class,'couponCityView']);
// Route::get('coupon-category/{city}/{category}',[couponController::class,'couponCategoryView']);
Route::get('coupon/{city}/{category}/{title}',[couponAndOfferController::class,'couponDetailView']);

// ----------- Offer Route -----------
Route::get('offer-list/{city}/{mall_name}',[offersController::class,'offerListingView']);
Route::get('offer-detail/{city}/{mall_name}/{title}',[offersController::class,'offerDetailView']);




// ----------- Shopping Blogs Route -----------
Route::get('product-service',[productAndServiceController::class,'productAndServiceView']);
Route::get('product-service/{title}',[productAndServiceController::class,'productAndServiceDetailView']);


// ----------- Press Release Route -----------
Route::get('press-release-category/{category}',[pressReleaseController::class,'pressReleaseCategoryListingView']);
Route::get('press-release/{title}',[pressReleaseController::class,'pressReleaseDetailView']);
Route::get('submit-press-release',[pressReleaseController::class,'pressReleaseFlowView']);


// ************************ Admin Routes ************************

Route::get('/clear-all', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return 'Cache, route, config, and view cleared!';
})->name('clear.all');

Route::prefix('admin')->group(function () {
    

    // ----------- Admin Routes -----------
    Route::get('login',[loginController::class,'adminLoginView']);
    Route::post('adminLogin',[loginController::class,'adminLogin']);
    Route::get('adminLogout',[loginController::class,'adminLogout']);
    Route::get('dashboard',[adminDashboardController::class,'adminDashboardView'])->middleware('adminLoginMiddleware');
    Route::get('imageFolder',[adminDashboardController::class,'imageFolderView'])->middleware('adminLoginMiddleware');
    Route::get('imageFolderByYear/{year}',[adminDashboardController::class,'imageFolderByYearView'])->middleware('adminLoginMiddleware');
    Route::post('storeImages',[adminDashboardController::class,'storeImages']);
    
    // ----------- About Us Routes -----------
    Route::get('aboutUsEdit',[adminAboutUsController::class,'aboutUsView'])->middleware('adminLoginMiddleware');
    Route::post('aboutUsUpdate',[adminAboutUsController::class,'aboutUsUpdate']);

    // ----------- Write For Us Routes -----------
    Route::get('writeForUsList',[adminWriteForUsController::class,'writeForUsListView'])->middleware('adminLoginMiddleware');
    Route::get('writeForUsDelete/{id}',[adminWriteForUsController::class,'writeForUsDelete']);
    
    // ----------- Our Services Routes -----------
    Route::get('ourServicesList',[adminOurServicesController::class,'ourServicesListView'])->middleware('adminLoginMiddleware');
    Route::get('OurServiceDelete/{id}',[adminOurServicesController::class,'OurServiceDelete']);
    
    // ----------- News Letter Routes -----------
    Route::get('newsLetterList',[homeController::class,'newsLetterListView'])->middleware('adminLoginMiddleware');
    Route::get('newsLetterDelete/{id}',[homeController::class,'newsLetterDelete']);


    // ----------- Banner Routes -----------
    // Route::get('bannerList',[adminBannerController::class,'bannerListView']);
    // Route::post('bannerStore',[adminBannerController::class,'bannerStore']);
    // Route::get('bannerEdit/{id}',[adminBannerController::class,'bannerEditView']);
    // Route::post('bannerUpdate/{id}',[adminBannerController::class,'bannerUpdate']);

    
    // // ----------- Banner Routes -----------
    // Route::get('bannerList',[adminBannerController::class,'bannerListView']);
    // Route::get('bannerAdd',[adminBannerController::class,'bannerAddView']);
    // Route::post('bannerStore',[adminBannerController::class,'bannerStore']);
    // Route::get('bannerEdit/{id}',[adminBannerController::class,'bannerEditView']);
    // Route::post('bannerUpdate/{id}',[adminBannerController::class,'bannerUpdate']);


    // ----------- Blog Main Category Routes -----------
    Route::get('blogCategoryMainList',[categoryMainController::class,'blogCategoryMainListView'])->middleware('adminLoginMiddleware');
    Route::get('blogCategoryMainEdit/{id}',[categoryMainController::class,'blogCategoryMainEditView'])->middleware('adminLoginMiddleware');
    Route::post('blogMainCategoryStore',[categoryMainController::class,'blogMainCategoryStore']);
    Route::post('blogMainCategoryUpdate/{id}',[categoryMainController::class,'blogMainCategoryUpdate']);


    // ----------- Blog Sub Category Routes -----------
    Route::get('blogCategorySubList',[categorySubController::class,'blogCategorySubListView'])->middleware('adminLoginMiddleware');
    Route::get('blogCategorySubEdit/{id}',[categorySubController::class,'blogCategorySubEditView'])->middleware('adminLoginMiddleware');
    Route::post('blogSubCategoryStore',[categorySubController::class,'blogSubCategoryStore']);
    Route::post('blogSubCategoryUpdate/{id}',[categorySubController::class,'blogSubCategoryUpdate']);


    // ----------- Blog Category Routes -----------
    Route::get('blogCategoryList',[blogCategoryController::class,'blogCategoryListView'])->middleware('adminLoginMiddleware');
    Route::get('blogCategoryAdd',[blogCategoryController::class,'blogCategoryAddView'])->middleware('adminLoginMiddleware');
    Route::get('blogCategoryEdit/{id}',[blogCategoryController::class,'blogCategoryEditView'])->middleware('adminLoginMiddleware');
    Route::get('blogCategory/data',[blogCategoryController::class,'blogCategoryData']);
    Route::post('getBlogSubCategory',[blogCategoryController::class,'getBlogSubCategory']);
    Route::post('blogCategoryStore',[blogCategoryController::class,'blogCategoryStore']);
    Route::post('blogCategoryUpdate/{id}',[blogCategoryController::class,'blogCategoryUpdate']);


    // ----------- Shopping Blog Routes -----------
    Route::get('blogList',[blogController::class,'index'])->middleware('adminLoginMiddleware');
    Route::get('blogAdd',[blogController::class,'blogAddView'])->middleware('adminLoginMiddleware');
    Route::get('blogEdit/{id}',[blogController::class,'blogEditView'])->middleware('adminLoginMiddleware');
    Route::post('blogStore',[blogController::class,'blogStore']);
    Route::post('blogUpdate/{id}',[blogController::class,'blogUpdate']);


    // ----------- Business Listing Routes -----------
    Route::get('businessListing',[adminBusinessListingController::class,'businessListingListView'])->middleware('adminLoginMiddleware');

    Route::get('businessListingReview/{id}',[adminBusinessListingController::class,'businessListingReviewView'])->middleware('adminLoginMiddleware');
    
    Route::get('businessListingAdd',[adminBusinessListingController::class,'businessListingAddView'])->middleware('adminLoginMiddleware');

    Route::post('businessListingStore',[adminBusinessListingController::class,'businessListingStore'])->middleware('adminLoginMiddleware');
    
    Route::get('businessListingEdit/{id}',[adminBusinessListingController::class,'businessListingEditView'])->middleware('adminLoginMiddleware');

    Route::get('businessListingTimingEdit/{id}',[adminBusinessListingController::class,'businessListingTimingEditView'])->middleware('adminLoginMiddleware');
    Route::post('businessListingUpdate/{id}',[adminBusinessListingController::class,'businessListingUpdate']);
    Route::post('businessListingTimingUpdate/{id}',[adminBusinessListingController::class,'businessListingTimingUpdate']);
    Route::post('businessListingTimingAdd',[adminBusinessListingController::class,'businessListingTimingAdd']);

    Route::get('businessListingImagesEdit/{id}',[adminBusinessListingController::class,'businessListingImagesEditView'])->middleware('adminLoginMiddleware');
    Route::post('businessListingImagesLogoStore/{id}',[adminBusinessListingController::class,'businessListingImagesLogoStore']);
    Route::post('businessListingImagesIDProodStore/{id}',[adminBusinessListingController::class,'businessListingImagesIDProodStore']);

    Route::get('businessListingImagesDelete/{id}/{business_id}/{type}/{path}',[adminBusinessListingController::class,'businessListingImagesDelete']);

    Route::get('businessListingPaid',[adminBusinessListingController::class,'businessListingPaidView'])->middleware('adminLoginMiddleware');
    Route::get('businessListingUnPaid',[adminBusinessListingController::class,'businessListingUnPaidView'])->middleware('adminLoginMiddleware');

    Route::get('exportBusinessListingExcel',[adminBusinessListingController::class,'exportBusinessListingExcel']);
    Route::post('importBusinessListingExcel',[adminBusinessListingController::class,'importBusinessListingExcel']);



    // ----------- Business Listing Main Category Routes -----------
    Route::get('businessListingCategoryMainList',[categoryMainController::class,'businessListingCategoryMainListView'])->middleware('adminLoginMiddleware');
    Route::get('businessListCategoryMainEdit/{id}',[categoryMainController::class,'businessListCategoryMainEditView'])->middleware('adminLoginMiddleware');
    Route::post('businessListingMainCategoryStore',[categoryMainController::class,'businessListingMainCategoryStore']);
    Route::post('businessListingMainCategoryUpdate/{id}',[categoryMainController::class,'businessListingMainCategoryUpdate']);


    // ----------- Business Listing Sub Category Routes -----------
    Route::get('businessListingCategorySubList',[categorySubController::class,'businessListingCategorySubView'])->middleware('adminLoginMiddleware');
    Route::get('businessListingCategorySubEdit/{id}',[categorySubController::class,'businessListingCategorySubEditView'])->middleware('adminLoginMiddleware');
    Route::post('businessListingCategorySubStore',[categorySubController::class,'businessListingCategorySubStore']);
    Route::post('businessListingCategorySubUpdate/{id}',[categorySubController::class,'businessListingCategorySubUpdate']);


    // ----------- Mall Routes -----------
    Route::get('mallList',[adminMallController::class,'mallList'])->middleware('adminLoginMiddleware');
    Route::get('mallAdd',[adminMallController::class,'mallAddView'])->middleware('adminLoginMiddleware');
    Route::post('mallStore',[adminMallController::class,'mallStore']);
    Route::get('mallEdit/{id}',[adminMallController::class,'mallEditView'])->middleware('adminLoginMiddleware');
    Route::post('mallUpdate/{id}',[adminMallController::class,'mallUpdate'])->middleware('adminLoginMiddleware');
    Route::post('mallImagesStore/{id}',[adminMallController::class,'mallImagesStore']);
    Route::get('mallImagesDelete/{id}/{mall_id}/{path}',[adminMallController::class,'mallImagesDelete']);
    Route::post('getmallBrands',[adminMallController::class,'getmallBrands']);


    // ----------- Brand Routes -----------
    Route::get('brandList',[adminBrandsController::class,'brandListView'])->middleware('adminLoginMiddleware');
    Route::get('brandAdd',[adminBrandsController::class,'brandAddView'])->middleware('adminLoginMiddleware');
    Route::post('brandStore',[adminBrandsController::class,'brandStore']);
    Route::get('brandEdit/{id}',[adminBrandsController::class,'brandEditView'])->middleware('adminLoginMiddleware');
    Route::post('brandUpdate/{id}',[adminBrandsController::class,'brandUpdate']);
    Route::post('brandImagesStore/{id}',[adminBrandsController::class,'brandImagesStore']);
    Route::get('brandImagesDelete/{id}/{mall_id}/{path}',[adminBrandsController::class,'brandImagesDelete']);


    // ----------- Coupon Routes -----------
    Route::get('couponAdd',[adminCouponController::class,'couponAddView'])->middleware('adminLoginMiddleware');
    Route::post('couponStore',[adminCouponController::class,'couponStore'])->middleware('adminLoginMiddleware');
    Route::get('couponEdit/{id}',[adminCouponController::class,'couponEditView'])->middleware('adminLoginMiddleware');
    Route::post('couponUpdate/{id}',[adminCouponController::class,'couponUpdate']);
    Route::get('couponList/{status}',[adminCouponController::class,'couponListView'])->middleware('adminLoginMiddleware');



    // ----------- Offers Routes -----------
    Route::get('offerAdd',[adminOffersController::class,'offerAddView'])->middleware('adminLoginMiddleware');
    Route::post('offerStore',[adminOffersController::class,'offerStore']);
    Route::get('offerEdit/{id}',[adminOffersController::class,'offerEditView'])->middleware('adminLoginMiddleware');
    Route::post('offerUpdate/{id}',[adminOffersController::class,'offerUpdate']);
    Route::get('offerList/{status}',[adminOffersController::class,'offerListView'])->middleware('adminLoginMiddleware');



    // ----------- Franchise Listing Routes -----------
    Route::get('franchiseList',[adminFranchiseController::class,'franchiseListView'])->middleware('adminLoginMiddleware');
    Route::get('franchiseAdd',[adminFranchiseController::class,'franchiseAddView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseStore',[adminFranchiseController::class,'franchiseStore'])->middleware('adminLoginMiddleware');

    Route::get('franchiseCategoryMainList',[adminFranchiseController::class,'franchiseCategoryMainListView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseCategoryMainStore',[adminFranchiseController::class,'franchiseCategoryMainStore']);
    Route::get('franchiseCategoryMainEdit/{id}',[adminFranchiseController::class,'franchiseCategoryMainEditView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseCategoryMainUpdate/{id}',[adminFranchiseController::class,'franchiseCategoryMainUpdate']);

    Route::get('franchiseCategorySubList',[adminFranchiseController::class,'franchiseCategorySubListView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseCategorySubStore',[adminFranchiseController::class,'franchiseCategorySubStore']);
    Route::get('franchiseCategorySubEdit/{id}',[adminFranchiseController::class,'franchiseCategorySubEditView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseCategorySubUpdate/{id}',[adminFranchiseController::class,'franchiseCategorySubUpdate']);

    Route::get('franchiseCategoryChildList',[adminFranchiseController::class,'franchiseCategoryChildListView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseCategoryChildStore',[adminFranchiseController::class,'franchiseCategoryChildStore']);
    Route::get('franchiseCategoryChildEdit/{id}',[adminFranchiseController::class,'franchiseCategoryChildEditView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseCategoryChildUpdate/{id}',[adminFranchiseController::class,'franchiseCategoryChildUpdate']);

    Route::get('franchiseEdit/{id}',[adminFranchiseController::class,'franchiseEditView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseUpdate/{id}',[adminFranchiseController::class,'franchiseUpdate']);

    Route::get('franchiseOtherDetailList/{id}',[adminFranchiseController::class,'franchiseOtherDetailListView'])->middleware('adminLoginMiddleware');
    Route::post('franchiseImageStore',[adminFranchiseController::class,'franchiseImageStore']);
    Route::get('franchiseImageRemove/{id}/{franchiseId}/{path}',[adminFranchiseController::class,'franchiseImageRemove']);
    Route::post('franchiseLocationDetailStore',[adminFranchiseController::class,'franchiseLocationDetailStore']);
    Route::get('franchiseLocationDetailRemove/{id}/{franchiseId}',[adminFranchiseController::class,'franchiseLocationDetailRemove']);


    // ----------- User Routes -----------
    Route::get('userList',[adminUserController::class,'userListView'])->middleware('adminLoginMiddleware');
    Route::get('userEdit/{id}',[adminUserController::class,'userEditView'])->middleware('adminLoginMiddleware');
    Route::post('userStore',[adminUserController::class,'userStore']);
    Route::post('userUpdate',[adminUserController::class,'userUpdate']);


    // ----------- Product And Services Routes -----------
    Route::get('productAndServiceList',[adminProductAndServiceController::class,'productAndServiceListView'])->middleware('adminLoginMiddleware');
    Route::get('productAndServiceAdd',[adminProductAndServiceController::class,'productAndServiceAddView'])->middleware('adminLoginMiddleware');
    Route::post('productAndServiceStore',[adminProductAndServiceController::class,'productAndServiceStore']);
    Route::get('productAndServiceEdit/{id}',[adminProductAndServiceController::class,'productAndServiceEditView'])->middleware('adminLoginMiddleware');
    Route::post('productAndServiceUpdate/{id}',[adminProductAndServiceController::class,'productAndServiceUpdate']);

    // ----------- Coupon And Services Routes -----------
    Route::get('couponAndServiceList',[adminCouponAndOfferController::class,'couponAndServiceListView'])->middleware('adminLoginMiddleware');
    Route::get('couponAndServiceAdd',[adminCouponAndOfferController::class,'couponAndServiceAdd'])->middleware('adminLoginMiddleware');


    
    // ----------- Website Content Routes -----------
    Route::get('websiteContentEdit',[adminWebsiteContentController::class,'websiteContentEditView'])->middleware('adminLoginMiddleware');
    Route::post('websiteContentUpdate',[adminWebsiteContentController::class,'websiteContentUpdate']);
    Route::get('policyEdit/{type}',[adminWebsiteContentController::class,'websiteContentTCAndPPView'])->middleware('adminLoginMiddleware');
    Route::post('websiteContentTCAndPPUpdate',[adminWebsiteContentController::class,'websiteContentTCAndPPUpdate']);


    // ----------- Press Release Routes -----------
    Route::get('pressReleaseList',[adminPressReleaseController::class,'pressReleaseListView'])->middleware('adminLoginMiddleware');
    Route::get('pressReleaseAdd',[adminPressReleaseController::class,'pressReleaseAddView'])->middleware('adminLoginMiddleware');
    Route::post('pressReleaseStore',[adminPressReleaseController::class,'pressReleaseStore']);
    Route::get('pressReleaseEdit/{id}',[adminPressReleaseController::class,'pressReleaseEditView'])->middleware('adminLoginMiddleware');
    Route::post('pressReleaseUpdate',[adminPressReleaseController::class,'pressReleaseUpdate']);
    Route::post('pressReleaseImages',[adminPressReleaseController::class,'pressReleaseImages']);
    Route::get('pressReleaseImagesDelete/{id}/{press_release_id}/{path}',[adminPressReleaseController::class,'pressReleaseImagesDelete']);

});
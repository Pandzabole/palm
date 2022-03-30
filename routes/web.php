<?php

use App\Http\Controllers\ActivityCategoryController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MiscInformationController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\StaticComponentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MetaDataController;
use App\Http\Controllers\Layout\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassCategoryController;
use App\Http\Controllers\ClassSubCategoryController;
use App\Http\Controllers\ClassReservationController;
use App\Http\Controllers\Layout\ReservationClassController;
use App\Http\Controllers\Layout\ClassController as FrontClassController;
use App\Http\Controllers\Layout\ContactController as FrontContactController;
use App\Http\Controllers\ClassLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return redirect()->route('login');
})->name('home');

/** Route for FE layout */
Route::get('/set-language-layout', [HomeController::class, 'setLanguage'])->name('set-language-layout');

Route::middleware('language.layout')->group(static function () {
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('contact-us', [FrontContactController::class, 'index'])->name('contact-us');
Route::get('single-class/{uuid}', [FrontClassController::class, 'showSingleClass'])->name('single-class');
Route::get('all-classes', [FrontClassController::class, 'allClasses'])->name('all-classes');
Route::get('online-classes', [FrontClassController::class, 'allOnlineClasses'])->name('online-classes');
Route::get('sub-classes/{uuid}', [FrontClassController::class, 'showSubCategoryClasses'])->name('sub-classes');
Route::get('main-category/{uuid}', [FrontClassController::class, 'showMainCategoryClasses'])->name('main-category');
Route::get('level-filter/{levelUuid}/{uuid}', [FrontClassController::class, 'classLevelFilter'])->name('level-filter');
Route::get('level-filter-main/{levelUuid}/{uuid}', [FrontClassController::class, 'classLevelFilterMain'])->name('level-filter-main');
Route::get('level-filter-all/{uuid}', [FrontClassController::class, 'classLevelFilterAll'])->name('level-filter-all');
Route::get('level-filter-discount/{uuid}', [FrontClassController::class, 'classLevelFilterDiscount'])->name('level-filter-discount');
Route::get('location-filter/{locationUuid}/{uuid}', [FrontClassController::class, 'classLocationFilter'])->name('location-filter');
Route::get('location-filter-main/{locationUuid}/{uuid}', [FrontClassController::class, 'classLocationFilterMain'])->name('location-filter-main');
Route::get('location-filter-all/{uuid}', [FrontClassController::class, 'classLocationFilterAll'])->name('location-filter-all');
Route::get('location-filter-discount/{uuid}', [FrontClassController::class, 'classLocationFilterDiscount'])->name('location-filter-discount');
Route::get('popular-classes/{uuid}', [FrontClassController::class, 'popularClasses'])->name('popular-classes');
Route::get('popular-classes-main/{uuid}', [FrontClassController::class, 'popularClassesMain'])->name('popular-classes-main');
Route::get('popular-classes-all', [FrontClassController::class, 'popularClassesAll'])->name('popular-classes-all');
Route::get('popular-classes-discount', [FrontClassController::class, 'popularClassesDiscount'])->name('popular-classes-discount');
Route::get('popular-online', [FrontClassController::class, 'popularOnlineClasses'])->name('popular-online');
Route::get('discount-classes/{uuid}', [FrontClassController::class, 'discountedClasses'])->name('discount-classes');
Route::get('discount-classes-main/{uuid}', [FrontClassController::class, 'discountedClassesMain'])->name('discount-classes-main');
Route::get('discount-classes-all', [FrontClassController::class, 'discountedClassesAll'])->name('discount-classes-all');
Route::get('discount-online', [FrontClassController::class, 'discountedOnlineClasses'])->name('discount-online');
Route::get('low-to-high-price/{uuid}', [FrontClassController::class, 'lowToHighPrice'])->name('low-to-high-price');
Route::get('low-to-high-price-main/{uuid}', [FrontClassController::class, 'lowToHighPriceMain'])->name('low-to-high-price-main');
Route::get('low-to-high-price-all', [FrontClassController::class, 'lowToHighPriceAll'])->name('low-to-high-price-all');
Route::get('low-to-high-price-discount', [FrontClassController::class, 'lowToHighPriceDiscount'])->name('low-to-high-price-discount');
Route::get('low-to-high-price-online', [FrontClassController::class, 'lowToHighPriceOnline'])->name('low-to-high-price-online');
Route::get('high-to-low-price/{uuid}', [FrontClassController::class, 'highToLowPrice'])->name('high-to-low-price');
Route::get('high-to-low-price-main/{uuid}', [FrontClassController::class, 'highToLowPriceMain'])->name('high-to-low-price-main');
Route::get('high-to-low-price-all', [FrontClassController::class, 'highToLowPriceAll'])->name('high-to-low-price-all');
Route::get('high-to-low-online', [FrontClassController::class, 'highToLowPriceOnline'])->name('high-to-low-online');
Route::get('high-to-low-price-discount', [FrontClassController::class, 'highToLowPriceDiscount'])->name('high-to-low-price-discount');
Route::get('all-discounted-classes', [FrontClassController::class, 'allDiscountedClasses'])->name('all-discounted-classes');
Route::post('submit-review-form', [FrontClassController::class, 'reviewClass'])->name('submit-review-form');
Route::get('search-class', [FrontClassController::class, 'searchClasses'])->name('search-class');
Route::resource('reservation-class', ReservationClassController::class);
/** Return contact view*/

});

Route::middleware('auth')->group(static function () {
    Route::get('/language', [DashboardController::class, 'languages'])->name('language')->middleware('auth');
    Route::get('/set-language', [DashboardController::class, 'setLanguage'])->name('set-language')->middleware('auth');

    Route::resource('admins', AdminController::class);
    Route::post('admins-markets', [AdminController::class, 'getSpecificMarkets'])->name('admins.markets');
    Route::get('admins-data', [AdminController::class, 'getData'])->name('admins.data');
});

Route::prefix('admin')->middleware(['auth', 'language'])->group(static function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('pages', PageController::class)->except(['create', 'store', 'destroy']);
    Route::get('pages-data', [PageController::class, 'getData'])->name('pages.data');

    Route::get('page-components/{pageSlug}', [StaticComponentController::class, 'show'])->name('components.show');
    Route::get('page-components/{pageSlug}/edit', [StaticComponentController::class, 'edit'])->name('components.edit');
    Route::put('page-components/{pageSlug}/update', [StaticComponentController::class, 'update'])->name('components.update');

    Route::resource('misc-information', MiscInformationController::class)->except(['show', 'create', 'store', 'destroy']);
    Route::get('emailmisc-information-data', [MiscInformationController::class, 'getData'])->name('misc-information.data');

    Route::resource('sliders', SliderController::class);
    Route::get('sliders-data', [SliderController::class, 'getData'])->name('sliders.data');

    Route::resource('markets', MarketController::class)->except(['create', 'destroy', 'store']);
    Route::get('markets-data', [MarketController::class, 'getData'])->name('markets.data');
    Route::post('markets-reorder', [MarketController::class, 'reorderSortable'])->name('markets.reorder');

    Route::resource('activities', ActivityController::class);
    Route::get('activities-data', [ActivityController::class, 'getData'])->name('activities.data');
    Route::post('activities-reorder', [ActivityController::class, 'reorderSortable'])->name('activities.reorder');
    Route::resource('activity-categories', ActivityCategoryController::class);
    Route::get('activity-categories-data', [ActivityCategoryController::class, 'getData'])->name('activity-categories.data');

    Route::resource('news', NewsController::class);
    Route::get('news-data', [NewsController::class, 'getData'])->name('news.data');
    Route::post('news-reorder', [NewsController::class, 'reorderSortable'])->name('news.reorder');
    Route::get('news-highlight/{id}', [NewsController::class, 'highlight'])->name('news.highlight');
    Route::resource('news-categories', NewsCategoryController::class);
    Route::get('news-categories-data', [NewsCategoryController::class, 'getData'])->name('news-categories.data');

    Route::resource('contents', ContentController::class)->only(['store', 'update']);
    Route::post('contents/destroy', [ContentController::class, 'destroy'])->name('contents.destroy');
    Route::get('contents-data', [ContentController::class, 'getData'])->name('contents.data');
    Route::post('contents-reorder', [ContentController::class, 'reorderSortable'])->name('contents.reorder');

    Route::resource('contacts', ContactController::class)->except(['store', 'edit']);
    Route::get('contacts-data', [ContactController::class, 'getData'])->name('contacts.data');

    Route::get('publish', [PublishController::class, 'publish'])->name('publish');

    Route::resource('meta-data', MetaDataController::class)->except(['create', 'store', 'destroy']);
    Route::get('meta-data-data', [MetaDataController::class, 'getData'])->name('meta.data');

    Route::resource('certificates', CertificateController::class);
    Route::get('certificates-data', [CertificateController::class, 'getData'])->name('certificates.data');

    Route::resource('classes', ClassController::class);
    Route::get('classes-data', [ClassController::class, 'getData'])->name('classes.data');
    Route::post('classes-reorder', [ClassController::class, 'reorderSortable'])->name('classes.reorder');
    Route::get('classes-highlight/{id}', [ClassController::class, 'highlight'])->name('classes.highlight');

    Route::resource('teachers', TeacherController::class);
    Route::get('teachers-data', [TeacherController::class, 'getData'])->name('teachers.data');

    Route::resource('main-categories', ClassCategoryController::class);
    Route::get('main-categories-data', [ClassCategoryController::class, 'getData'])->name('main-categories.data');

    Route::resource('sub-categories', ClassSubCategoryController::class);
    Route::get('sub-categories-data', [ClassSubCategoryController::class, 'getData'])->name('sub-categories.data');
    Route::get('class-sub-categories', [ClassSubCategoryController::class, 'getSubCategories'])->name('class-sub-categories');


    Route::resource('class-reservation', ClassReservationController::class);
    Route::get('classes-reservation-data', [ClassReservationController::class, 'getData'])->name('classes-reservation.data');
    Route::get('class-reservation-read/{id}', [ClassReservationController::class, 'updateClassRead'])->name('class.read');
    Route::get('class-reservation-reply/{id}', [ClassReservationController::class, 'updateClassReply'])->name('class.reply');

    Route::resource('class-location', ClassLocation::class)->except(['destroy']);
    Route::get('class-location-data', [ClassLocation::class, 'getData'])->name('class-location.data');

});

Auth::routes(['register' => false]);

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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MetaDataController;
use App\Http\Controllers\Layout\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassCategoryController;
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
    Route::get('misc-information-data', [MiscInformationController::class, 'getData'])->name('misc-information.data');

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

    Route::resource('products', ProductController::class);
    Route::get('products-data', [ProductController::class, 'getData'])->name('products.data');
    Route::post('products-reorder', [ProductController::class, 'reorderSortable'])->name('products.reorder');

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

});

Auth::routes(['register' => false]);

<?php

use App\Http\Controllers\API\ActivityCategoriesController;
use App\Http\Controllers\API\ActivityController;
use App\Http\Controllers\API\CertificateController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\MiscInformationController;
use App\Http\Controllers\API\NewsCategoriesController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\ComponentsController;
use App\Http\Controllers\API\MarketController;
use App\Http\Controllers\API\LanguageController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\MetaDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('language.api')->group(
    static function () {
        Route::get('components/types', [ComponentsController::class, 'indexTypes']);
        Route::get('components/{pageSlug}', [ComponentsController::class, 'index']);

        Route::get('news', [NewsController::class, 'index']);
        Route::get('news/paginate', [NewsController::class, 'indexPaginate']);
        Route::get('news/categories', [NewsCategoriesController::class, 'index']);
        Route::get('news/highlighted', [NewsController::class, 'showHighlighted']);
        Route::get('news/{slug}', [NewsController::class, 'show']);

        Route::get('activities', [ActivityController::class, 'index']);
        Route::get('activities/paginate', [ActivityController::class, 'indexPaginate']);
        Route::get('activities/categories', [ActivityCategoriesController::class, 'index']);
        Route::get('activities/{slug}', [ActivityController::class, 'show']);

        Route::get('menu', [MenuController::class, 'showAllPages']);

        Route::get('misc-information', [MiscInformationController::class, 'index']);

        Route::get('market', [MarketController::class, 'showAllMarkets']);
        Route::get('certificates', [CertificateController::class, 'index']);

        Route::get('products', [ProductController::class, 'index']);
        Route::get('products/{slug}', [ProductController::class, 'show']);

        Route::get('meta-data/{slug}', [MetaDataController::class, 'show']);
    }
);

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::get('languages', [LanguageController::class, 'showAllLanguages']);

Route::post('contact', [ContactController::class, 'store'])->middleware(['client', 'language.api']);

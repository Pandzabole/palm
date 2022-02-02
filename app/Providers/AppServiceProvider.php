<?php

namespace App\Providers;

use App\Services\MediaManager\Providers\ImageProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Imagick;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            ImageProvider::class,
            static function () {
                return new ImageProvider(new Imagick());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\UsersRepository::class,
            static function () {
                return new \App\Repositories\UsersRepository(new \App\Models\User());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\PagesRepository::class,
            static function () {
                return new \App\Repositories\PagesRepository(new \App\Models\Page());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\SlidersRepository::class,
            static function () {
                return new \App\Repositories\SlidersRepository(new \App\Models\Slider());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\SliderItemsRepository::class,
            static function () {
                return new \App\Repositories\SliderItemsRepository(new \App\Models\SliderItem());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\MediaRepository::class,
            static function () {
                return new \App\Repositories\MediaRepository(new \App\Models\Media());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\MarketsRepository::class,
            static function () {
                return new \App\Repositories\MarketsRepository(new \App\Models\Market());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\NewsRepository::class,
            static function () {
                return new \App\Repositories\NewsRepository(new \App\Models\News());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\NewsCategoriesRepository::class,
            static function () {
                return new \App\Repositories\NewsCategoriesRepository(new \App\Models\NewsCategory());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\ActivitiesRepository::class,
            static function () {
                return new \App\Repositories\ActivitiesRepository(new \App\Models\Activity());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\ActivityCategoriesRepository::class,
            static function () {
                return new \App\Repositories\ActivityCategoriesRepository(new \App\Models\ActivityCategory());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\LanguagesRepository::class,
            static function () {
                return new \App\Repositories\LanguagesRepository(new \App\Models\Language());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\StaticComponentsRepository::class,
            static function () {
                return new \App\Repositories\StaticComponentsRepository(new \App\Models\StaticComponent());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\PackageNumbersRepository::class,
            static function () {
                return new \App\Repositories\PackageNumbersRepository(new \App\Models\PackageNumber());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\PackageVolumesRepository::class,
            static function () {
                return new \App\Repositories\PackageVolumesRepository(new \App\Models\PackageVolume());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\ContactsRepository::class,
            static function () {
                return new \App\Repositories\ContactsRepository(new \App\Models\Contact());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\PublishRepository::class,
            static function () {
                return new \App\Repositories\PublishRepository(new \App\Models\Publish());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\MetaDataRepository::class,
            static function () {
                return new \App\Repositories\MetaDataRepository(new \App\Models\MetaData());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\MiscInformationRepository::class,
            static function () {
                return new \App\Repositories\MiscInformationRepository(new \App\Models\MiscInformation());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\ContentRepository::class,
            static function () {
                return new \App\Repositories\ContentRepository(new \App\Models\Content\Content());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\TextContentRepository::class,
            static function () {
                return new \App\Repositories\TextContentRepository(new \App\Models\Content\TextContent());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\RichTextContentRepository::class,
            static function () {
                return new \App\Repositories\RichTextContentRepository(new \App\Models\Content\RichTextContent());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\ImageContentRepository::class,
            static function () {
                return new \App\Repositories\ImageContentRepository(new \App\Models\Content\ImageContent());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\VideoContentRepository::class,
            static function () {
                return new \App\Repositories\VideoContentRepository(new \App\Models\Content\VideoContent());
            }
        );
        $this->app->singleton(
            \App\Repositories\Contracts\CertificatesRepository::class,
            static function () {
                return new \App\Repositories\CertificatesRepository(new \App\Models\Certificate());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\MainMarketsRepository::class,
            static function () {
                return new \App\Repositories\MainMarketsRepository(new \App\Models\MainMarket());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\ClassCategoryRepository::class,
            static function () {
                return new \App\Repositories\ClassCategoryRepository(new \App\Models\ClassCategory());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\ClassSubCategoryRepository::class,
            static function () {
                return new \App\Repositories\ClassSubCategoryRepository(new \App\Models\ClassSubCategory());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\ClassesRepository::class,
            static function () {
                return new \App\Repositories\ClassesRepository(new \App\Models\Classe());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\ClassLocationRepository::class,
            static function () {
                return new \App\Repositories\ClassLocationRepository(new \App\Models\ClassLocation());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\TeacherRepository::class,
            static function () {
                return new \App\Repositories\TeacherRepository(new \App\Models\Teacher());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\ReservationClassRepository::class,
            static function () {
                return new \App\Repositories\ReservationClassRepository(new \App\Models\ReservationClass());
            }
        );

        $this->app->singleton(
            \App\Repositories\Contracts\GendersRepository::class,
            static function () {
                return new \App\Repositories\GendersRepository(new \App\Models\Gender());
            }
        );


        $this->app->singleton(
            \App\Repositories\Contracts\ClassCategoryClassSubCategory::class,
            static function () {
                return new \App\Repositories\ClassCategoryClassSubCategory(new \App\Models\ClassCategoryClassSubCategory());
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}

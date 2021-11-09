<?php

namespace App\Http\Composers;

use App\Repositories\Contracts\PublishRepository;
use Illuminate\View\View;

class PublishComposer
{
    /**
     * The publish repository implementation.
     *
     * @var PublishRepository $publishRepository
     */
    protected $publishRepository;

    /**
     * Create a new publish composer.
     *
     * @param PublishRepository $publishRepository
     */
    public function __construct(PublishRepository $publishRepository)
    {
        $this->publishRepository = $publishRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
//        if (!in_array($view->name, config('publish.exclude-views'), true)) {
//            $published = optional($this->publishRepository->findOneById(1))->isPublished();
//
//            $view->with(compact('published'));
//        }
    }
}

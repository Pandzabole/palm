<?php

namespace App\Http\Composers;

use App\Repositories\Contracts\LanguagesRepository;
use App\Repositories\Contracts\UsersRepository;
use App\Services\ContentManager\ContentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LanguagesComposer
{
    /**
     * The languages repository implementation.
     *
     * @var LanguagesRepository
     */
    protected $languagesRepository;

    /**
     * @var ContentService $contentService
     */
    protected $contentService;

    /**
     * @var UsersRepository $userRepository
     */
    protected $userRepository;

    /**
     * Create a new languages composer.
     *
     * @param ContentService $contentService
     * @param LanguagesRepository $languagesRepository
     * @param UsersRepository $userRepository
     */
    public function __construct(
        ContentService $contentService,
        LanguagesRepository $languagesRepository,
        UsersRepository $userRepository
    ) {
        $this->contentService = $contentService;
        $this->languagesRepository = $languagesRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $currentConnection = $this->contentService->getCurrentConnectionDatabase();
        $this->contentService->setDefaultConnectionDatabase();
        $composedLanguages = null;

        if (Auth::check()) {
            $autUser = Auth::user()->id;
            $composedLanguages = $this->userRepository->findOneById($autUser)->mainMarkets()->pluck('name', 'short');
        }
        $this->contentService->setConnectionDatabase(DB::getDefaultConnection(), $currentConnection);

        $view->with(compact('composedLanguages'));
    }
}

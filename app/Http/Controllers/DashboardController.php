<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetLanguageRequest;
use App\Repositories\Contracts\ActivitiesRepository;
use App\Repositories\Contracts\ContactsRepository;
use App\Repositories\Contracts\LanguagesRepository;
use App\Repositories\Contracts\NewsRepository;
use App\Repositories\Contracts\UsersRepository;
use App\Services\ContentManager\ContentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /** @var NewsRepository */
    private $newsRepository;

    /** @var ContactsRepository */
    private $contactsRepository;

    /** @var LanguagesRepository */
    private $languagesRepository;

    /** @var ActivitiesRepository */
    private $activitiesRepository;

    /** @var UsersRepository */
    private $userRepository;

    /**
     * DashboardController constructor.
     *
     * @param ContentService $contentService
     * @param NewsRepository $newsRepository
     * @param ContactsRepository $contactsRepository
     * @param LanguagesRepository $languagesRepository
     * @param ActivitiesRepository $activitiesRepository
     * @param UsersRepository $userRepository
     */
    public function __construct(
        ContentService $contentService,
        NewsRepository $newsRepository,
        ContactsRepository $contactsRepository,
        LanguagesRepository $languagesRepository,
        ActivitiesRepository $activitiesRepository,
        UsersRepository $userRepository
    ) {
        $this->newsRepository = $newsRepository;
        $contentService->setDefaultConnectionDatabase();
        $this->contactsRepository = $contactsRepository;
        $this->languagesRepository = $languagesRepository;
        $this->activitiesRepository = $activitiesRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $news = $this->newsRepository->findByFilters('created_at', 'desc', [], [], 5);
        $contacts = $this->contactsRepository->findByFilters('created_at', 'desc', [], [], 5);
        $activities = $this->activitiesRepository->findByFilters('created_at', 'desc', [], [], 5);

        return view('admin.dashboard', compact('news', 'contacts', 'activities'));
    }

    /**
     * @return  Application|Factory|View
     */
    public function languages()
    {
        $user = Auth::user()->id;
        $markets = $this->userRepository->findOneById($user)->mainMarkets;

        return view('admin.languages', compact('markets'));
    }

    /**
     * @param SetLanguageRequest $request
     * @return RedirectResponse
     */
    public function setLanguage(SetLanguageRequest $request): RedirectResponse
    {
        $language = $request->get('lang');

        $language = $this->languagesRepository->findOneBy(['short' => $language]);

        Session::put(['db_language' => $language->connection_name, 'db_language_name' => $language->short]);

        return redirect()->route('dashboard');
    }
}

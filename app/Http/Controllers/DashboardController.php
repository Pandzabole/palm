<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetLanguageRequest;
use App\Repositories\Contracts\ActivitiesRepository;
use App\Repositories\Contracts\ContactsRepository;
use App\Repositories\Contracts\LanguagesRepository;
use App\Repositories\Contracts\NewsRepository;
use App\Repositories\Contracts\UsersRepository;
use App\Repositories\Contracts\ReservationClassRepository;
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

    /** @var ReservationClassRepository */
    private $reservationClassRepository;

    /**
     * DashboardController constructor.
     *
     * @param ContentService $contentService
     * @param NewsRepository $newsRepository
     * @param ContactsRepository $contactsRepository
     * @param LanguagesRepository $languagesRepository
     * @param ActivitiesRepository $activitiesRepository
     * @param UsersRepository $userRepository
     * @param ReservationClassRepository $reservationClassRepository
     */
    public function __construct(
        ContentService $contentService,
        NewsRepository $newsRepository,
        ContactsRepository $contactsRepository,
        LanguagesRepository $languagesRepository,
        ActivitiesRepository $activitiesRepository,
        UsersRepository $userRepository,
        ReservationClassRepository $reservationClassRepository
    ) {
        $this->newsRepository = $newsRepository;
        $contentService->setDefaultConnectionDatabase();
        $this->contactsRepository = $contactsRepository;
        $this->languagesRepository = $languagesRepository;
        $this->activitiesRepository = $activitiesRepository;
        $this->userRepository = $userRepository;
        $this->reservationClassRepository = $reservationClassRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $reservationClass = $this->reservationClassRepository->findByFilters('created_at', 'asc', [], [], 5);
        $reservationClassUnread = $this->reservationClassRepository->findByFilters('created_at', 'asc', ['read_reservation' => false], [], 5);
        $contacts = $this->contactsRepository->findByFilters('created_at', 'desc', [], [], 5);
        $activities = $this->activitiesRepository->findByFilters('created_at', 'desc', [], [], 5);
        $noAnsweredReservations = $this->reservationClassRepository->findByFilters('created_at', 'desc', ['reply_client' => false]);

        return view('admin.dashboard', compact('reservationClass', 'contacts', 'activities', 'reservationClassUnread', 'noAnsweredReservations'));
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

<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayoutRequests\SetLanguageLayoutRequest;
use App\Repositories\Contracts\ActivitiesRepository;
use App\Repositories\Contracts\LanguagesRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /** @var ActivitiesRepository $activityCategoriesRepository */
    public ActivitiesRepository $activityCategoriesRepository;

    /** @var LanguagesRepository $languagesRepository*/
    public LanguagesRepository $languagesRepository;

    /**
     * ActivityCategoryController constructor.
     *
     * @param ActivitiesRepository $activityCategoriesRepository
     * @param LanguagesRepository $languagesRepository
     */
    public function __construct(
        ActivitiesRepository $activityCategoriesRepository,
        LanguagesRepository $languagesRepository
    )
    {
        $this->activityCategoriesRepository = $activityCategoriesRepository;
        $this->languagesRepository = $languagesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $languageList = config('languages');
        $pera = $this->activityCategoriesRepository->findOneById('1')->title;
        return view('main', compact('pera', 'languageList'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function setLanguage(Request $request): RedirectResponse
    {
        $language = $request->get('lang');

        $language = $this->languagesRepository->findOneBy(['short' => $language]);
        Session::put(['db_language_layout' => $language->connection_name, 'db_language_name_layout' => $language->short]);
        return redirect()->route('home');
    }
}

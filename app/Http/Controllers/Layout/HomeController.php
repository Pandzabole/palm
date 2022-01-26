<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayoutRequests\SetLanguageLayoutRequest;
use App\Repositories\Contracts\ActivitiesRepository;
use App\Repositories\Contracts\LanguagesRepository;
use App\Repositories\Contracts\ClassesRepository;
use App\Repositories\Contracts\ClassCategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /** @var ActivitiesRepository $activityCategoriesRepository */
    public $activityCategoriesRepository;

    /** @var LanguagesRepository $languagesRepository */
    public $languagesRepository;

    /** @var ClassesRepository $classesRepository */
    public $classesRepository;

    /** @var ClassCategoryRepository $classCategoryRepository */
    public $classCategoryRepository;

    /**
     * ActivityCategoryController constructor.
     *
     * @param ActivitiesRepository $activityCategoriesRepository
     * @param LanguagesRepository $languagesRepository
     * @param ClassesRepository $classesRepository
     * @param ClassCategoryRepository $classCategoryRepository
     */
    public function __construct(
        ActivitiesRepository $activityCategoriesRepository,
        LanguagesRepository $languagesRepository,
        ClassesRepository $classesRepository,
        ClassCategoryRepository $classCategoryRepository
    )
    {
        $this->activityCategoriesRepository = $activityCategoriesRepository;
        $this->languagesRepository = $languagesRepository;
        $this->classesRepository = $classesRepository;
        $this->classCategoryRepository = $classCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
//        $langSession = Session::get('db_language_name_layout');
//        App::setLocale($langSession);
//
//        session()->put('locale', $langSession);

        $languageList = config('languages');
        $session = Session::get('db_language_layout');
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');

        return view('main', compact('languageList', 'session', 'mainCategories'));
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

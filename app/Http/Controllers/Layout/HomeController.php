<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayoutRequests\SetLanguageLayoutRequest;
use App\Repositories\Contracts\ActivitiesRepository;
use App\Repositories\Contracts\LanguagesRepository;
use App\Repositories\Contracts\ClassesRepository;
use App\Repositories\Contracts\ClassCategoryRepository;
use App\Repositories\Contracts\SliderItemsRepository;
use Illuminate\Contracts\Foundation\Application;
use App\Services\FrontLayout\FrontLayoutDataService;
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

    /** @var SliderItemsRepository $sliderItemsRepository */
    public $sliderItemsRepository;

    /** @var FrontLayoutDataService $frontLayoutDataService */
    public $frontLayoutDataService;


    /**
     * ActivityCategoryController constructor.
     *
     * @param ActivitiesRepository $activityCategoriesRepository
     * @param LanguagesRepository $languagesRepository
     * @param ClassesRepository $classesRepository
     * @param ClassCategoryRepository $classCategoryRepository
     * @param FrontLayoutDataService $frontLayoutDataService
     * @param SliderItemsRepository $sliderItemsRepository
     */
    public function __construct(
        ActivitiesRepository $activityCategoriesRepository,
        LanguagesRepository $languagesRepository,
        ClassesRepository $classesRepository,
        FrontLayoutDataService $frontLayoutDataService,
        ClassCategoryRepository $classCategoryRepository,
        SliderItemsRepository $sliderItemsRepository
    )
    {
        $this->activityCategoriesRepository = $activityCategoriesRepository;
        $this->languagesRepository = $languagesRepository;
        $this->classesRepository = $classesRepository;
        $this->classCategoryRepository = $classCategoryRepository;
        $this->frontLayoutDataService = $frontLayoutDataService;
        $this->sliderItemsRepository = $sliderItemsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->frontLayoutDataService->getData();
        $languageList = config('languages');
        $session = Session::get('db_language_layout');
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $sliderItems = $this->sliderItemsRepository->getAll();

        return view('main', compact('languageList', 'session', 'mainCategories', 'sliderItems'));
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

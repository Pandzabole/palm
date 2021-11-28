<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayoutRequests\SetLanguageLayoutRequest;
use App\Repositories\Contracts\ActivitiesRepository;
use App\Repositories\Contracts\LanguagesRepository;
use App\Repositories\Contracts\ClassesRepository;
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
    public $activityCategoriesRepository;

    /** @var LanguagesRepository $languagesRepository */
    public $languagesRepository;

    /** @var ClassesRepository $classesRepository */
    public $classesRepository;

    /**
     * ActivityCategoryController constructor.
     *
     * @param ActivitiesRepository $activityCategoriesRepository
     * @param LanguagesRepository $languagesRepository
     * @param ClassesRepository $classesRepository
     */
    public function __construct(
        ActivitiesRepository $activityCategoriesRepository,
        LanguagesRepository $languagesRepository,
        ClassesRepository $classesRepository
    )
    {
        $this->activityCategoriesRepository = $activityCategoriesRepository;
        $this->languagesRepository = $languagesRepository;
        $this->classesRepository = $classesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $languageList = config('languages');
        $classes  = $this->classesRepository->getAll();
        $pera = $this->activityCategoriesRepository->findOneById('1')->title;
        $session = Session::get('db_language_layout');

        return view('main', compact('pera', 'languageList', 'classes', 'session'));
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

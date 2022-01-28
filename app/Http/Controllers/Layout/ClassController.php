<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ClassCategoryRepository;
use App\Repositories\Contracts\ClassesRepository;
use App\Services\FrontLayout\FrontLayoutDataService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ClassController extends Controller
{
    /** @var ClassCategoryRepository $classCategoryRepository */
    public $classCategoryRepository;

    /** @var ClassesRepository $classesRepository */
    public $classesRepository;

    /** @var FrontLayoutDataService $frontLayoutDataService */
    public $frontLayoutDataService;

    /**
     * ActivityCategoryController constructor.
     *
     * @param ClassCategoryRepository $classCategoryRepository
     * @param FrontLayoutDataService $frontLayoutDataService
     * @param ClassesRepository $classesRepository
     */
    public function __construct(
        ClassCategoryRepository $classCategoryRepository,
        FrontLayoutDataService $frontLayoutDataService,
        ClassesRepository $classesRepository
    )
    {
        $this->classCategoryRepository = $classCategoryRepository;
        $this->frontLayoutDataService = $frontLayoutDataService;
        $this->classesRepository = $classesRepository;
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

        return view('front-pages.all-classes', compact('languageList', 'session', 'mainCategories'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function showSubCategoryClasses($id)
    {
        $this->frontLayoutDataService->getData();
        $classes = $this->classesRepository->findByFilters('created_at', 'desc', ['class_sub_category_id' => $id]);
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();
        $session = Session::get('db_language_layout');

        return view('front-pages.all-sub-classes', compact('classes', 'session', 'mainCategories', 'singleClass'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function showSingleClass($id)
    {
        $this->frontLayoutDataService->getData();
        $class = $this->classesRepository->findOneById($id);
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $session = Session::get('db_language_layout');

        return view('front-pages.single-class', compact('session', 'mainCategories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

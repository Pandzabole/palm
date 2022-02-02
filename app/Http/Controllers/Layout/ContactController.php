<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ClassCategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Services\FrontLayout\FrontLayoutDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /** @var ClassCategoryRepository $classCategoryRepository */
    public $classCategoryRepository;

    /** @var FrontLayoutDataService $frontLayoutDataService */
    public $frontLayoutDataService;

    /**
     * ActivityCategoryController constructor.
     *
     * @param ClassCategoryRepository $classCategoryRepository
     * @param FrontLayoutDataService $frontLayoutDataService
     */
    public function __construct(
        ClassCategoryRepository $classCategoryRepository,
        FrontLayoutDataService $frontLayoutDataService
    )
    {
        $this->classCategoryRepository = $classCategoryRepository;
        $this->frontLayoutDataService = $frontLayoutDataService;
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
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');

        return view('front-pages.contact', compact('languageList', 'mainCategories'));
    }
}

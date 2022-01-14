<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ClassCategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /** @var ClassCategoryRepository $classCategoryRepository */
    public $classCategoryRepository;

    /**
     * ActivityCategoryController constructor.
     *
     * @param ClassCategoryRepository $classCategoryRepository
     */
    public function __construct(
        ClassCategoryRepository $classCategoryRepository
    )
    {
        $this->classCategoryRepository = $classCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $langSession = Session::get('db_language_name_layout');
        App::setLocale($langSession);

        session()->put('locale', $langSession);

        $languageList = config('languages');
        $session = Session::get('db_language_layout');
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');


        return view('front-pages.contact', compact('languageList', 'session', 'mainCategories'));

    }
}

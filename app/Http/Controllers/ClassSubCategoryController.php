<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassCategoryCreateRequest;
use App\Http\Requests\ClassCategoryUpdateRequest;
use App\Models\ClassSubCategory;
use App\Repositories\Contracts\ClassSubCategoryRepository;
use App\Repositories\Contracts\ClassesRepository;
use App\Repositories\Contracts\ClassCategoryRepository;
use App\Repositories\Contracts\ClassCategoryClassSubCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ClassSubCategoryController extends Controller
{
    /** @var ClassSubCategoryRepository $classSubCategoryRepository */
    private $classSubCategoryRepository;

    /** @var ClassesRepository $classesRepository */
    private $classesRepository;

    /** @var ClassCategoryRepository $classCategoryRepository */
    private $classCategoryRepository;

    /** @var ClassCategoryClassSubCategory $classCategoryClassSubCategory */
    private $classCategoryClassSubCategory;

    /**
     * ContactController constructor.
     *
     * @param ClassSubCategoryRepository $classSubCategoryRepository
     * @param ClassCategoryRepository $classCategoryRepository
     * @param ClassesRepository $classesRepository
     * @param ClassCategoryClassSubCategory $classCategoryClassSubCategory
     */
    public function __construct(
        ClassSubCategoryRepository $classSubCategoryRepository,
        ClassesRepository $classesRepository,
        ClassCategoryRepository $classCategoryRepository,
        ClassCategoryClassSubCategory $classCategoryClassSubCategory
    )
    {
        $this->classSubCategoryRepository = $classSubCategoryRepository;
        $this->classesRepository = $classesRepository;
        $this->classCategoryRepository =  $classCategoryRepository;
        $this->classCategoryClassSubCategory =  $classCategoryClassSubCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.class-sub-categories.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function getData(): JsonResponse
    {
        $categories = $this->classSubCategoryRepository->findByFilters();

        return DataTables::of($categories)
            ->editColumn('actions', static function ($category) {
                return view(
                    'partials.datatables.actions',
                    ['model' => $category, 'routeModelName' => 'sub-categories']
                );
            })
            ->addColumn('categories', static function (ClassSubCategory $category) {
                return $category->classCategory->pluck('name')->implode(', ');
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $mainCategory = $this->classCategoryRepository->findByFilters()->pluck('name', 'id');

        return view('admin.class-sub-categories.create', compact('mainCategory'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ClassCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $subCategory = $this->classSubCategoryRepository->store($data);
        $this->classCategoryRepository->attach($subCategory, 'classCategory', [$request->get('main_category')]);

        return redirect()
            ->route('sub-categories.show', $subCategory->id)
            ->with('success', 'Sub category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $subCategory = $this->classSubCategoryRepository->findOneById($id)->load('classCategory');

        return view('admin.class-sub-categories.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $subCategory = $this->classSubCategoryRepository->findOneById($id);
        $mainCategory = $this->classCategoryRepository->findByFilters()->pluck('name', 'id');

        return view('admin.class-sub-categories.edit', compact('subCategory', 'mainCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClassCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->all();
        $subCategory = $this->classSubCategoryRepository->findOneById($id);
        $this->classSubCategoryRepository->update($subCategory, $data);
        $this->classesRepository->sync($subCategory, 'classCategory', [$data['main_category']]);


        return redirect()
            ->route('sub-categories.show', $subCategory->id)
            ->with('success', 'Main category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $subCategory = $this->classSubCategoryRepository->findOneById($id)->id;
        $class = $this->classesRepository->findByFilters('created_at', 'desc', ['class_sub_category_id' => $subCategory]);

        if($class->isEmpty()){
            $subCategory = $this->classSubCategoryRepository->findOneById($id);
            $this->classSubCategoryRepository->delete($subCategory);
            return redirect()
                ->route('sub-categories.index')
                ->with('success', 'Sub category deleted successfully!');

        } else{
            return redirect()
                ->route('sub-categories.index')
                ->with('success', 'You cannot delete a sub category because it is in use');
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSubCategories(Request $request): JsonResponse
    {
        $mainCategoryId = $request->get('id');
        $subCategory = $this->classCategoryClassSubCategory->findByFilters(
            'created_at',
            'desc',
            ['class_category_id' => $mainCategoryId])->load('classSubCategory');
        return response()->json(['subcategories' => $subCategory], 200);
    }
}

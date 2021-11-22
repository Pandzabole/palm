<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ClassCategoryRepository;
use App\Repositories\Contracts\ClassesRepository;
use App\Http\Requests\ClassCategoryCreateRequest;
use App\Http\Requests\ClassCategoryUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ClassCategoryController extends Controller
{
    /** @var ClassCategoryRepository $classCategoryRepository */
    private $classCategoryRepository;

    /** @var ClassesRepository $classesRepository */
    private $classesRepository;


    /**
     * ContactController constructor.
     *
     * @param ClassCategoryRepository $classCategoryRepository
     * @param ClassesRepository $classesRepository
     */
    public function __construct(ClassCategoryRepository $classCategoryRepository, ClassesRepository $classesRepository )
    {
        $this->classCategoryRepository = $classCategoryRepository;
        $this->classesRepository = $classesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.class-categories.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function getData(): JsonResponse
    {
        $categories = $this->classCategoryRepository->findByFilters();

        return DataTables::of($categories)
            ->editColumn('actions', static function ($category) {
                return view(
                    'partials.datatables.actions',
                    ['model' => $category, 'routeModelName' => 'main-categories']
                );
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

        return view('admin.class-categories.create', compact('mainCategory'));
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

        $mainCategory = $this->classCategoryRepository->store($data);

        return redirect()
            ->route('main-categories.show', $mainCategory->id)
            ->with('success', 'Main category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $mainCategory = $this->classCategoryRepository->findOneById($id);

        return view('admin.class-categories.show', compact('mainCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $mainCategory = $this->classCategoryRepository->findOneById($id);

        return view('admin.class-categories.edit', compact('mainCategory'));
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

        $mainCategory = $this->classCategoryRepository->findOneById($id);
        $this->classCategoryRepository->update($mainCategory, $data);

        return redirect()
            ->route('main-categories.show', $mainCategory->id)
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
        $mainCategory = $this->classCategoryRepository->findOneById($id)->id;
        $class = $this->classesRepository->findByFilters('created_at', 'desc', ['class_category_id' => $mainCategory]);

        if($class->isEmpty()){
            $mainCategory = $this->classCategoryRepository->findOneById($id);
            $this->classCategoryRepository->delete($mainCategory);
            return redirect()
                ->route('main-categories.index')
                ->with('success', 'Main category deleted successfully!');

        } else{
            return redirect()
                ->route('main-categories.index')
                ->with('success', 'You cannot delete a category because it is in use');
        }
    }
}

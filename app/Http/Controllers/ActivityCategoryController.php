<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityCategoryCreateRequest;
use App\Http\Requests\ActivityCategoryUpdateRequest;
use App\Repositories\Contracts\ActivityCategoriesRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class ActivityCategoryController extends Controller
{
    /** @var ActivityCategoriesRepository $activityCategoriesRepository */
    public $activityCategoriesRepository;

    /**
     * ActivityCategoryController constructor.
     *
     * @param ActivityCategoriesRepository $activityCategoriesRepository
     */
    public function __construct(ActivityCategoriesRepository $activityCategoriesRepository)
    {
        $this->activityCategoriesRepository = $activityCategoriesRepository;
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $activities = $this->activityCategoriesRepository->findByFilters();

        return DataTables::of($activities)
            ->editColumn('actions', static function ($activity) {
                return view(
                    'partials.datatables.actions',
                    ['model' => $activity, 'routeModelName' => 'activity-categories']
                );
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.activity-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.activity-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ActivityCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ActivityCategoryCreateRequest $request): RedirectResponse
    {
        $activityCategory = $this->activityCategoriesRepository->store(['name' => $request->get('name')]);

        return redirect()
            ->route('activity-categories.show', $activityCategory->id)
            ->with('success', 'Activity Category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $activityCategory = $this->activityCategoriesRepository->findOneById($id);

        return view('admin.activity-categories.show', compact('activityCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $activityCategory = $this->activityCategoriesRepository->findOneById($id);

        return view('admin.activity-categories.edit', compact('activityCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ActivityCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ActivityCategoryUpdateRequest $request, int $id): RedirectResponse
    {
        $activityCategory = $this->activityCategoriesRepository->findOneById($id);
        $this->activityCategoriesRepository->update($activityCategory, ['name' => $request->get('name')]);

        return redirect()
            ->route('activity-categories.show', $activityCategory->id)
            ->with('success', 'Activity Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $activityCategory = $this->activityCategoriesRepository->findOneById($id);
        $this->activityCategoriesRepository->delete($activityCategory);

        return redirect()
            ->route('activity-categories.index')
            ->with('success', 'Activity Category deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityCreateRequest;
use App\Http\Requests\ActivitySearchRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Http\Requests\ReorderActivityRequest;
use App\Models\Activity;
use App\Repositories\Contracts\ActivitiesRepository;
use App\Repositories\Contracts\ActivityCategoriesRepository;
use App\Repositories\Contracts\MediaRepository;
use App\Repositories\Contracts\StaticComponentsRepository;
use App\Services\MediaManager\MediaManager;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class ActivityController extends Controller
{
    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /** @var MediaRepository $mediaRepository */
    public $mediaRepository;

    /** @var ActivitiesRepository $activitiesRepository */
    public $activitiesRepository;

    /** @var StaticComponentsRepository $staticComponentsRepository */
    public $staticComponentsRepository;

    /** @var ActivityCategoriesRepository $activityCategoriesRepository */
    public $activityCategoriesRepository;

    /**
     * ActivityController constructor.
     *
     * @param MediaManager $mediaManager
     * @param MediaRepository $mediaRepository
     * @param ActivitiesRepository $activitiesRepository
     * @param StaticComponentsRepository $staticComponentsRepository
     * @param ActivityCategoriesRepository $activityCategoriesRepository
     */
    public function __construct(
        MediaManager $mediaManager,
        MediaRepository $mediaRepository,
        ActivitiesRepository $activitiesRepository,
        StaticComponentsRepository $staticComponentsRepository,
        ActivityCategoriesRepository $activityCategoriesRepository
    )
    {
        $this->mediaManager = $mediaManager;
        $this->mediaRepository = $mediaRepository;
        $this->activitiesRepository = $activitiesRepository;
        $this->staticComponentsRepository = $staticComponentsRepository;
        $this->activityCategoriesRepository = $activityCategoriesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = $this->activityCategoriesRepository->findByFilters()->pluck('name', 'id');

        return view('admin.activities.index', compact('categories'));
    }

    /**
     * Process data-tables ajax request.
     *
     * @param ActivitySearchRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(ActivitySearchRequest $request): JsonResponse
    {
        $activitiesRepository = $this->activitiesRepository;
        if ($categoryId = $request->get('categoryId')) {
            $activities = $activitiesRepository->findByHasRelationship('categories', ['activity_categories.id' => $categoryId]);
        } else {
            $activities = $activitiesRepository->findByFilters();
        }

        return DataTables::of($activities)
            ->editColumn('actions', static function ($activity) {
                return view(
                    'partials.datatables.actions',
                    ['model' => $activity, 'routeModelName' => 'activities']
                );
            })
            ->editColumn('date', static function ($activity) {
                return $activity->created_at;
            })
            ->rawColumns(['actions'])
            ->addColumn('categories', static function (Activity $activity) {
                return $activity->categories->pluck('name')->implode(', ');
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $media = $this->mediaRepository->findImages();
        $categories = $this->activityCategoriesRepository->findByFilters()->pluck('name', 'id');

        return view('admin.activities.create', compact('media', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ActivityCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ActivityCreateRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data['activity_component_id'] = $this->staticComponentsRepository->findOneBy(['type' => 'activity'])->id;

        $activity = $this->activitiesRepository->storeWithSortable($data);
        $this->activitiesRepository->attach($activity, 'categories', $data['categories']);

        $this->mediaManager->uploadMedia($request->allFiles(), $activity, [$request->get('media_id')]);

        return redirect()
            ->route('activities.show', $activity->id)
            ->with('success', 'Activity created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $activity = $this->activitiesRepository->findOneById($id);
        $media = $this->mediaRepository->findByFilters();

        return view('admin.activities.show', compact('activity', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $activity = $this->activitiesRepository->findOneById($id);
        $media = $this->mediaRepository->findByFilters();
        $categories = $this->activityCategoriesRepository->findByFilters();
        $selectedCategories = $activity->categories->pluck('id')->toArray();

        return view('admin.activities.edit', compact('activity', 'media', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ActivityUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ActivityUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $activity = $this->activitiesRepository->findOneById($id);
        $this->activitiesRepository->update($activity, $data);
        $this->activitiesRepository->sync($activity, 'categories', $data['categories']);

        $this->mediaManager->uploadMedia($request->allFiles(), $activity, [$request->get('media_id')]);

        return redirect()
            ->route('activities.show', $activity->id)
            ->with('success', 'Activity updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $activity = $this->activitiesRepository->findOneById($id);
        $this->activitiesRepository->deleteWithSortable($activity);

        return redirect()
            ->route('activities.index')
            ->with('success', 'Activity deleted successfully!');
    }

    /**
     * Reorder items
     *
     * @param ReorderActivityRequest $request
     * @return JsonResponse
     */
    public function reorderSortable(ReorderActivityRequest $request): JsonResponse
    {
        $this->activitiesRepository->reorderSortable($request->get('items'));

        return response()->json();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Media;
use App\Repositories\Contracts\ClassesRepository;
use App\Repositories\Contracts\ClassLocationRepository;
use App\Repositories\Contracts\ClassCategoryRepository;
use App\Repositories\Contracts\ClassSubCategoryRepository;
use App\Repositories\Contracts\TeacherRepository;
use App\Repositories\Contracts\MediaRepository;
use App\Services\MediaManager\MediaManager;
use App\Http\Requests\ClassControllerCreateRequest;
use App\Http\Requests\ClassControllerUpdateRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class ClassController extends Controller
{
    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /** @var MediaRepository $mediaRepository */
    public $mediaRepository;

    /** @var ClassesRepository $classesRepository */
    public $classesRepository;

    /** @var ClassLocationRepository $classLocationRepository */
    public $classLocationRepository;

    /** @var ClassCategoryRepository $classCategoryRepository */
    public $classCategoryRepository;

    /** @var ClassSubCategoryRepository $classSubCategoryRepository */
    public $classSubCategoryRepository;

    /** @var TeacherRepository $teacherRepository */
    public $teacherRepository;

    /**
     * ClassController constructor.
     *
     * @param MediaManager $mediaManager
     * @param MediaRepository $mediaRepository
     * @param ClassesRepository $classesRepository
     * @param ClassLocationRepository $classLocationRepository
     * @param ClassCategoryRepository $classCategoryRepository
     * @param ClassSubCategoryRepository $classSubCategoryRepository
     * @param TeacherRepository $teacherRepository
     */
    public function __construct(
        MediaManager               $mediaManager,
        MediaRepository            $mediaRepository,
        ClassesRepository          $classesRepository,
        ClassLocationRepository    $classLocationRepository,
        ClassCategoryRepository    $classCategoryRepository,
        ClassSubCategoryRepository $classSubCategoryRepository,
        TeacherRepository          $teacherRepository
    )
    {
        $this->mediaManager = $mediaManager;
        $this->mediaRepository = $mediaRepository;
        $this->classesRepository = $classesRepository;
        $this->classLocationRepository = $classLocationRepository;
        $this->classCategoryRepository = $classCategoryRepository;
        $this->classSubCategoryRepository = $classSubCategoryRepository;
        $this->teacherRepository = $teacherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $categories = $this->classCategoryRepository->findByFilters()->pluck('name', 'id');

        return view('admin.classes.index', compact('categories'));
    }

    /**
     * Process data-tables ajax request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(Request $request): JsonResponse
    {
        $classesRepository = $this->classesRepository;
        if ($categoryId = $request->get('categoryId')) {
            $classes = $classesRepository->findByHasRelationship('classCategory', ['class_category_id' => $categoryId]);
        } else {
            $classes = $classesRepository->findByFilters();
        }

        return DataTables::of($classes)
            ->editColumn('actions', static function ($class) {
                return view(
                    'partials.datatables.actions',
                    ['model' => $class, 'routeModelName' => 'classes']
                );
            })
            ->editColumn('highlighted', 'admin.classes.datatables.highlighted')
            ->editColumn('date', static function ($class) {
                return $class->created_at;
            })
            ->rawColumns(['actions', 'highlighted'])
            ->addColumn('categories', static function (Classe $class) {
                return $class->classCategory->pluck('name')->implode(', ');
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
        $mediaDesktop = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'desktop']);
        $mediaMobile = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'mobile']);
        $classCategory = $this->classCategoryRepository->findByFilters()->pluck('name', 'id');
        $classSubCategory = $this->classSubCategoryRepository->findByFilters()->pluck('name', 'id');
        $classLocation = $this->classLocationRepository->findByFilters()->pluck('location', 'id');
        $teacher = $this->teacherRepository->findByFilters()->pluck('name', 'id');

        return view('admin.classes.create', compact(
            'mediaDesktop',
            'mediaMobile',
            'classCategory',
            'classSubCategory',
            'classLocation',
            'teacher'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClassControllerCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ClassControllerCreateRequest $request): RedirectResponse
    {
        $data = $request->all();
        $position = $this->classesRepository->getAll()->pluck('position')->max() + 1;
        $data['position'] = $position;
        $classes = $this->classesRepository->store($data);
        $classCategoryId = [$request->get('class_category_id')];
        $classSubCategoryId = $request->get('class_sub_category_id');
        $classSubCategoryRepository = $this->classSubCategoryRepository->findOneById($classSubCategoryId);

        $this->classCategoryRepository->attach($classSubCategoryRepository, 'classCategory', $classCategoryId);

        $this->classesRepository->attach($classes, 'locations', $data['class_location']);


        $this->mediaManager->uploadMedia(
            [$request->file("image_desktop")],
            $classes,
            [$request->get('media_desktop_id')],
            Media::DESKTOP,
            true
        );
        $this->mediaManager->uploadMedia(
            [$request->file("image_mobile")],
            $classes,
            [$request->get('media_mobile_id')],
            Media::MOBILE,
            true
        );

        return redirect()
            ->route('classes.show', $classes->id)
            ->with('success', 'Class created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $classes = $this->classesRepository->findOneById($id);
        $media = $this->mediaRepository->findByFilters();

        return view('admin.classes.show', compact('classes', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $class = $this->classesRepository->findOneById($id);
        $mediaDesktop = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'desktop']);
        $mediaMobile = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'mobile']);
        $classCategory = $this->classCategoryRepository->findByFilters()->pluck('name', 'id');
        $classSubCategory = $this->classSubCategoryRepository->findByFilters()->pluck('name', 'id');
        $classLocation = $this->classLocationRepository->findByFilters();
        $selectedLocations = $class->locations->pluck('id')->toArray();
        $teacher = $this->teacherRepository->findByFilters()->pluck('name', 'id');

        return view('admin.classes.edit', compact('class',
            'mediaDesktop',
            'mediaMobile',
            'classCategory',
            'classSubCategory',
            'classLocation',
            'selectedLocations',
            'teacher'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClassControllerUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ClassControllerUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $class = $this->classesRepository->findOneById($id);

        $this->classesRepository->update($class, $data);
        $this->classesRepository->sync($class, 'locations', $data['class_location']);

        $classCategoryId = [$request->get('class_category_id')];
        $classSubCategoryId = $request->get('class_sub_category_id');
        $classSubCategoryRepository = $this->classSubCategoryRepository->findOneById($classSubCategoryId);

        $this->classCategoryRepository->sync($classSubCategoryRepository, 'classCategory', $classCategoryId);

        $files = [
            [
                'type' => Media::DESKTOP,
                'file' => $request->file("image_desktop"),
                'existing_media' => $request->get('media_desktop_id')
            ],
            [
                'type' => Media::MOBILE,
                'file' => $request->file("image_mobile"),
                'existing_media' => $request->get('media_mobile_id')
            ]
        ];

        $this->mediaManager->uploadTypedMedia($class, $files);

        return redirect()
            ->route('classes.show', $class->id)
            ->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $class = $this->classesRepository->findOneById($id);
        $this->classesRepository->delete($class);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class deleted successfully!');
    }

    /**
     * Reorder items
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reorderSortable(Request $request): JsonResponse
    {
        $this->classesRepository->reorderSortable($request->get('items'));

        return response()->json();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function highlight(int $id): RedirectResponse
    {
        $this->classesRepository->updateMultiple(['highlighted' => true], ['highlighted' => false]);
        $class = $this->classesRepository->findOneById($id);
        $this->classesRepository->update($class, ['highlighted' => true]);

        return redirect()
            ->route('classes.index')
            ->with('success', 'News highlighted successfully!');
    }
}

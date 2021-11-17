<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Repositories\Contracts\ClassesRepository;
use App\Repositories\Contracts\ClassLocationRepository;
use App\Repositories\Contracts\ClassCategoryRepository;
use App\Repositories\Contracts\ClassSubCategoryRepository;
use App\Repositories\Contracts\TeacherRepository;
use App\Repositories\Contracts\MediaRepository;
use App\Services\MediaManager\MediaManager;
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
            ->rawColumns(['actions'])
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
        $media = $this->mediaRepository->findImages();
        $classCategory = $this->classCategoryRepository->findByFilters()->pluck('name', 'id');
        $classSubCategory = $this->classSubCategoryRepository->findByFilters()->pluck('name', 'id');
        $classLocation = $this->classLocationRepository->findByFilters()->pluck('location', 'id');
        $teacher = $this->teacherRepository->findByFilters()->pluck('name', 'id');

        return view('admin.classes.create', compact(
            'media',
            'classCategory',
            'classSubCategory',
            'classLocation',
            'teacher'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *  @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $position = $this->classesRepository->getAll()->pluck('position')->max() + 1;
        $data['position'] = $position;
        $classes = $this->classesRepository->store($data);

        $this->classesRepository->attach($classes, 'locations', $data['class_location']);

        $this->mediaManager->uploadMedia($request->allFiles(), $classes, [$request->get('media_id')]);

        return redirect()
            ->route('classes.index')
            ->with('success', 'News created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

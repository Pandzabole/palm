<?php

namespace App\Http\Controllers;

use App\Services\MediaManager\MediaManager;
use App\Repositories\Contracts\TeacherRepository;
use App\Repositories\Contracts\MediaRepository;
use App\Repositories\Contracts\GendersRepository;
use App\Http\Requests\TeacherCreateRequest;
use App\Http\Requests\TeacherUpdateRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /** @var MediaRepository $mediaRepository */
    public $mediaRepository;

    /** @var TeacherRepository $teacherRepository */
    public $teacherRepository;

    /** @var GendersRepository $gendersRepository */
    public $gendersRepository;

    /**
     * ActivityController constructor.
     *
     * @param MediaManager $mediaManager
     * @param MediaRepository $mediaRepository
     * @param TeacherRepository $teacherRepository
     * @param GendersRepository $gendersRepository
     */
    public function __construct(
        MediaManager      $mediaManager,
        MediaRepository   $mediaRepository,
        TeacherRepository $teacherRepository,
        GendersRepository $gendersRepository
    )
    {
        $this->mediaManager = $mediaManager;
        $this->mediaRepository = $mediaRepository;
        $this->teacherRepository = $teacherRepository;
        $this->gendersRepository = $gendersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $teachers = $this->teacherRepository->findByFilters()->pluck('name', 'id');

        return view('admin.teachers.index', compact('teachers'));
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
        $teacherRepository = $this->teacherRepository;

        $teachers = $teacherRepository->findByFilters();


        return DataTables::of($teachers)
            ->editColumn('actions', static function ($teacher) {
                return view(
                    'partials.datatables.actions',
                    ['model' => $teacher, 'routeModelName' => 'teachers']
                );
            })
            ->editColumn('date', static function ($teacher) {
                return $teacher->created_at;
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
        $media = $this->mediaRepository->findImages();
        $genders = $this->gendersRepository->findByFilters();
        return view('admin.teachers.create', compact('media', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherCreateRequest $request
     * @return RedirectResponse
     */
    public function store(TeacherCreateRequest $request): RedirectResponse
    {
        $data = $request->all();
        $teacher = $this->teacherRepository->store($data);
        $this->mediaManager->uploadMedia($request->allFiles(), $teacher, [$request->get('media_id')]);

        return redirect()
            ->route('teachers.show', $teacher->id)
            ->with('success', 'Teacher created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $teacher = $this->teacherRepository->findOneById($id);
        $media = $this->mediaRepository->findByFilters();

        return view('admin.teachers.show', compact('teacher', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $teacher = $this->teacherRepository->findOneById($id);
        $media = $this->mediaRepository->findByFilters();
        $genders = $this->gendersRepository->findByFilters();

        return view('admin.teachers.edit', compact('teacher', 'media', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TeacherUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $teacher = $this->teacherRepository->findOneById($id);
        $this->teacherRepository->update($teacher, $data);

        $this->mediaManager->uploadMedia($request->allFiles(), $teacher, [$request->get('media_id')]);

        return redirect()
            ->route('teachers.show', $teacher->id)
            ->with('success', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $activity = $this->teacherRepository->findOneById($id);
        $this->teacherRepository->delete($activity);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }
}

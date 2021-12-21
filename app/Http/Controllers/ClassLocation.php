<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassLocationCreateRequest;
use App\Http\Requests\ClassLocationUpdateRequest;
use App\Repositories\Contracts\ClassLocationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ClassLocation extends Controller
{
    /** @var ClassLocationRepository $classLocationRepository */
    private $classLocationRepository;

    /**
     * @param ClassLocationRepository $classLocationRepository
     */
    public function __construct(ClassLocationRepository $classLocationRepository )
    {
        $this->classLocationRepository = $classLocationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.class-location.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function getData(): JsonResponse
    {
        $classLocations = $this->classLocationRepository->findByFilters();

        return DataTables::of($classLocations)
            ->editColumn('actions', static function ($classLocation) {
                return view(
                    'admin.class-location.datatables.actions',
                    ['model' => $classLocation, 'routeModelName' => 'class-location']
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
        return view('admin.class-location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClassLocationCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ClassLocationCreateRequest $request): RedirectResponse
    {
        $data = $request->all();

        $classLocation= $this->classLocationRepository->store($data);

        return redirect()
            ->route('class-location.show', $classLocation->id)
            ->with('success', 'Class location created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $classLocation = $this->classLocationRepository->findOneById($id);

        return view('admin.class-location.show', compact('classLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $classLocation = $this->classLocationRepository->findOneById($id);

        return view('admin.class-location.edit', compact('classLocation'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ClassLocationUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ClassLocationUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $classLocation = $this->classLocationRepository->findOneById($id);
        $this->classLocationRepository->update($classLocation, $data);

        return redirect()
            ->route('class-location.show', $classLocation->id)
            ->with('success', 'Class location updated successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MetaData;
use Illuminate\Http\RedirectResponse;
use Exception;
use App\Services\MediaManager\MediaManager;
use App\Repositories\Contracts\MetaDataRepository;
use App\Repositories\Contracts\MediaRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MetaDataUpdateRequest;

class MetaDataController extends Controller
{
    /** @var  MetaDataRepository $metaData */
    private $metaData;

    /** @var MediaRepository $mediaRepository */
    public $mediaRepository;

    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /**
     * MetaData Controller constructor.
     *
     * @param MetaDataRepository $metaData
     * @param MediaRepository $mediaRepository
     * @param MediaManager $mediaManager
     */
    public function __construct(
        MetaDataRepository $metaData,
        MediaRepository $mediaRepository,
        MediaManager $mediaManager
    )
    {
        $this->metaData = $metaData;
        $this->mediaRepository = $mediaRepository;
        $this->mediaManager = $mediaManager;
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $metaData = $this->metaData->findByFilters();

        return DataTables::of($metaData)
            ->editColumn('actions', 'admin.meta-data.datatables.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        return view('admin.meta-data.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $metaData = $this->metaData->findOneById($id);
        $media = $this->mediaRepository->findByFilters();

        return view('admin.meta-data.show', compact('metaData', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $metaData = $this->metaData->findOneById($id);
        $media = $this->mediaRepository->findByFilters();

        return view('admin.meta-data.edit', compact('metaData', 'media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MetaDataUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(MetaDataUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $metaData = $this->metaData->findOneById($id);
        $this->metaData->update($metaData, $data);

        $this->mediaManager->uploadMedia($request->allFiles(), $metaData, [$request->get('media_id')]);

        return redirect()
            ->route('meta-data.show', $metaData->id)
            ->with('success', 'Meta data updated successfully!');
    }
}

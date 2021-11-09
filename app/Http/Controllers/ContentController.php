<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentCreateRequest;
use App\Http\Requests\ContentDestroyRequest;
use App\Http\Requests\ContentUpdateRequest;
use App\Http\Requests\ReorderContentsRequest;
use App\Repositories\Contracts\ContentRepository;
use App\Services\MediaManager\MediaManager;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use function app;

class ContentController extends Controller
{
    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /** @var ContentRepository $contentRepository */
    public $contentRepository;

    /**
     * ContentController constructor.
     *
     * @param MediaManager $mediaManager
     * @param ContentRepository $contentRepository
     */
    public function __construct(MediaManager $mediaManager, ContentRepository $contentRepository)
    {
        $this->mediaManager = $mediaManager;
        $this->contentRepository = $contentRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(Request $request): JsonResponse
    {
        $content = $this->contentRepository
            ->findByFilters(
                'created_at',
                'asc',
                [
                    'containable_type' => $request->get('containable'),
                    'containable_id' => $request->get('containable_id')
                ],
                ['contentable']
            )
            ->transform(
                static function ($content) {
                    $contentable = $content->contentable;
                    $contentable->sort_order = $content->sort_order;
                    return $contentable;
                }
            );

        return DataTables::of($content)
            ->editColumn('actions', 'vendor.content.content-table-actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Store a newly created resource.
     *
     * @param ContentCreateRequest $request
     * @return JsonResponse
     */
    public function store(ContentCreateRequest $request): JsonResponse
    {
        $contentType = $request->get('content_type');
        $containableId = $request->get('containable_id');
        $containable = $request->get('containable');

        $contentModel = app($contentType);
        $content = app($contentModel->repo)->store($request->except(['content_type', 'containable_id', 'containable']));

        if (method_exists($content, 'media')) {
            $this->mediaManager->uploadMedia($request->allFiles(), $content, [$request->get('media_id')]);
        }
        $containableModel = app($containable);

        $containableId = app($containableModel->repo)->findOneById($containableId)->id;

        $this->contentRepository->storeWithSortable(
            [
                'containable_type' => $containable,
                'containable_id' => $containableId,
                'contentable_type' => $contentType,
                'contentable_id' => $content->id
            ]
        );

        return response()->json($content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param ContentUpdateRequest $request
     * @return JsonResponse
     */
    public function update(ContentUpdateRequest $request, int $id): JsonResponse
    {
        $contentType = $request->get('content_type_class');

        $contentModel = app($contentType);
        $contentRepo = app($contentModel->repo);

        $content = $contentRepo->findOneById($id);
        $content = $contentRepo->update($content, $request->except(['content_type']));

        if (method_exists($content, 'media')) {
            $this->mediaManager->uploadMedia($request->allFiles(), $content, [$request->get('media_id')]);
        }

        return response()->json($content);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContentDestroyRequest $request
     * @return JsonResponse
     */
    public function destroy(ContentDestroyRequest $request): JsonResponse
    {
        $content = $this->contentRepository->findOneBy(
            [
                'contentable_type' => $request->get('content_type'),
                'contentable_id' => $request->get('content_id')
            ]
        );

        $this->contentRepository->deleteContentWithSortable(
            $content,
            [
                'containable' => $request->get('containable'),
                'containable_id' => $request->get('containable_id'),
            ]
        );

        return response()->json();
    }

    /**
     * Reorder items
     *
     * @param ReorderContentsRequest $request
     * @return JsonResponse
     */
    public function reorderSortable(ReorderContentsRequest $request): JsonResponse
    {
        $this->contentRepository->reorderSortable($request->all());

        return response()->json();
    }
}

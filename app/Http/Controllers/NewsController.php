<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsSearchRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Requests\ReorderNewsRequest;
use App\Models\News;
use App\Repositories\Contracts\MediaRepository;
use App\Repositories\Contracts\NewsCategoriesRepository;
use App\Repositories\Contracts\NewsRepository;
use App\Repositories\Contracts\StaticComponentsRepository;
use App\Services\MediaManager\MediaManager;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /** @var NewsRepository $newsRepository */
    public $newsRepository;

    /** @var MediaRepository $mediaRepository */
    public $mediaRepository;

    /** @var NewsCategoriesRepository $newsCategoriesRepository */
    public $newsCategoriesRepository;

    /** @var StaticComponentsRepository $staticComponentsRepository */
    public $staticComponentsRepository;

    /**
     * NewsController constructor.
     *
     * @param MediaManager $mediaManager
     * @param NewsRepository $newsRepository
     * @param MediaRepository $mediaRepository
     * @param NewsCategoriesRepository $newsCategoriesRepository
     * @param StaticComponentsRepository $staticComponentsRepository
     */
    public function __construct(
        MediaManager $mediaManager,
        NewsRepository $newsRepository,
        MediaRepository $mediaRepository,
        NewsCategoriesRepository $newsCategoriesRepository,
        StaticComponentsRepository $staticComponentsRepository
    ) {
        $this->mediaManager = $mediaManager;
        $this->newsRepository = $newsRepository;
        $this->mediaRepository = $mediaRepository;
        $this->newsCategoriesRepository = $newsCategoriesRepository;
        $this->staticComponentsRepository = $staticComponentsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = $this->newsCategoriesRepository->findByFilters()->pluck('name', 'id');

        return view('admin.news.index', compact('categories'));
    }

    /**
     * Process data-tables ajax request.
     *
     * @param NewsSearchRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(NewsSearchRequest $request): JsonResponse
    {
        $newsRepository = $this->newsRepository;
        if ($categoryId = $request->get('categoryId')) {
            $news = $newsRepository->findByHasRelationship('categories', ['news_categories.id' => $categoryId]);
        } else {
            $news = $newsRepository->findByFilters();
        }

        return DataTables::of($news)
            ->editColumn(
                'actions',
                static function ($news) {
                    return view(
                        'partials.datatables.actions',
                        ['model' => $news, 'routeModelName' => 'news']
                    );
                }
            )
            ->editColumn('highlighted', 'admin.news.datatables.highlighted')
            ->editColumn(
                'date',
                static function ($news) {
                    return $news->created_at;
                }
            )
            ->rawColumns(['actions', 'highlighted'])
            ->addColumn(
                'categories',
                static function (News $news) {
                    return $news->categories->pluck('name')->implode(', ');
                }
            )
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $media = $this->mediaRepository->findByFilters();
        $categories = $this->newsCategoriesRepository->findByFilters()->pluck('name', 'id');

        return view('admin.news.create', compact('media', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsCreateRequest $request
     * @return RedirectResponse
     */
    public function store(NewsCreateRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data['news_component_id'] = $this->staticComponentsRepository->findOneBy(['type' => 'news'])->id;

        $news = $this->newsRepository->storeWithSortable($data);
        $this->newsRepository->attach($news, 'categories', $data['categories']);

        $this->mediaManager->uploadMedia($request->allFiles(), $news, [$request->get('media_id')]);

        return redirect()
            ->route('news.show', $news->id)
            ->with('success', 'News created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $news = $this->newsRepository->findOneById($id);
        $media = $this->mediaRepository->findImages();

        return view('admin.news.show', compact('news', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $news = $this->newsRepository->findOneById($id);
        $media = $this->mediaRepository->findByFilters();
        $categories = $this->newsCategoriesRepository->findByFilters();
        $selectedCategories = $news->categories->pluck('id')->toArray();

        return view('admin.news.edit', compact('news', 'media', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(NewsUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $news = $this->newsRepository->findOneById($id);
        $this->newsRepository->update($news, $data);
        $this->newsRepository->sync($news, 'categories', $data['categories']);

        $this->mediaManager->uploadMedia($request->allFiles(), $news, [$request->get('media_id')]);

        return redirect()
            ->route('news.show', $news->id)
            ->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $news = $this->newsRepository->findOneById($id);
        $this->newsRepository->deleteWithSortable($news);

        return redirect()
            ->route('news.index')
            ->with('success', 'News deleted successfully!');
    }

    /**
     * Reorder items
     *
     * @param ReorderNewsRequest $request
     * @return JsonResponse
     */
    public function reorderSortable(ReorderNewsRequest $request): JsonResponse
    {
        $this->newsRepository->reorderSortable($request->get('items'));

        return response()->json();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function highlight(int $id): RedirectResponse
    {
        $this->newsRepository->updateMultiple(['highlighted' => true], ['highlighted' => false]);
        $news = $this->newsRepository->findOneById($id);
        $this->newsRepository->update($news, ['highlighted' => true]);

        return redirect()
            ->route('news.index')
            ->with('success', 'News highlighted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCategoryCreateRequest;
use App\Http\Requests\NewsCategoryUpdateRequest;
use App\Repositories\Contracts\NewsCategoriesRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class NewsCategoryController extends Controller
{
    /** @var NewsCategoriesRepository $newsCategoriesRepository */
    public $newsCategoriesRepository;

    /**
     * NewsCategoryController constructor.
     *
     * @param NewsCategoriesRepository $newsCategoriesRepository
     */
    public function __construct(NewsCategoriesRepository $newsCategoriesRepository)
    {
        $this->newsCategoriesRepository = $newsCategoriesRepository;
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $news = $this->newsCategoriesRepository->findByFilters();

        return DataTables::of($news)
            ->editColumn('actions', static function ($news) {
                return view(
                    'partials.datatables.actions',
                    ['model' => $news, 'routeModelName' => 'news-categories']
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
        return view('admin.news-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.news-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(NewsCategoryCreateRequest $request): RedirectResponse
    {
        $newsCategory = $this->newsCategoriesRepository->store(['name' => $request->get('name')]);

        return redirect()
            ->route('news-categories.show', $newsCategory->id)
            ->with('success', 'News Category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $newsCategory = $this->newsCategoriesRepository->findOneById($id);

        return view('admin.news-categories.show', compact('newsCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $newsCategory = $this->newsCategoriesRepository->findOneById($id);

        return view('admin.news-categories.edit', compact('newsCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(NewsCategoryUpdateRequest $request, int $id): RedirectResponse
    {
        $newsCategory = $this->newsCategoriesRepository->findOneById($id);
        $this->newsCategoriesRepository->update($newsCategory, ['name' => $request->get('name')]);

        return redirect()
            ->route('news-categories.show', $newsCategory->id)
            ->with('success', 'News Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $news = $this->newsCategoriesRepository->findOneById($id);
        $this->newsCategoriesRepository->delete($news);

        return redirect()
            ->route('news-categories.index')
            ->with('success', 'News Category deleted successfully!');
    }
}

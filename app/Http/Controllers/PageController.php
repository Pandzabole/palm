<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PageUpdateRequest;
use App\Repositories\Contracts\PagesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    /** @var PagesRepository $pagesRepository */
    private $pagesRepository;

    /**
     * PageController constructor.
     *
     * @param PagesRepository $pagesRepository
     */
    public function __construct(PagesRepository $pagesRepository)
    {
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $page = $this->pagesRepository->findByFilters();

        return DataTables::of($page)
            ->editColumn('actions', 'admin.pages.datatables.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $page = $this->pagesRepository->findOneById($id);

        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $page = $this->pagesRepository->findOneById($id);

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PageUpdateRequest $request, int $id): RedirectResponse
    {
        $page = $this->pagesRepository->findOneById($id);

        $this->pagesRepository->update($page, $request->only('name'));

        return redirect()
            ->route('pages.show', $page->id)
            ->with('success', 'Page successfully updated');
    }
}

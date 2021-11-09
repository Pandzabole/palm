<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarketUpdateRequest;
use App\Http\Requests\ReorderMarketRequest;
use Exception;
use App\Repositories\Contracts\MarketsRepository;
use App\Repositories\Contracts\MainMarketsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MarketController extends Controller
{
    /** @var MarketsRepository $marketsRepository */
    private $marketsRepository;

    /** @var MainMarketsRepository $mainMarketsRepository */
    private $mainMarketsRepository;

    /**
     * MarketController constructor.
     *
     * @param MarketsRepository $marketsRepository
     * @param MainMarketsRepository $mainMarketsRepository
     */
    public function __construct(MarketsRepository $marketsRepository, MainMarketsRepository $mainMarketsRepository)
    {
        $this->marketsRepository = $marketsRepository;
        $this->mainMarketsRepository = $mainMarketsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.markets.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $markets = $this->marketsRepository->findByFilters();

        return DataTables::of($markets)
            ->editColumn('actions', 'admin.markets.datatables.actions')
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
        $market = $this->marketsRepository->findOneById($id);

        return view('admin.markets.show', compact('market'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $market = $this->marketsRepository->findOneById($id);

        return view('admin.markets.edit', compact('market'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MarketUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(MarketUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();
        $market = $this->marketsRepository->findOneById($id);

        $this->marketsRepository->update($market, ['name' => $data['name']]);

        return redirect()
            ->route('markets.show', $market->id)
            ->with('success', 'Market successfully updated');
    }

    /**
     * Reorder items
     *
     * @param ReorderMarketRequest $request
     * @return JsonResponse
     */
    public function reorderSortable(ReorderMarketRequest $request): JsonResponse
    {
        $this->marketsRepository->reorderSortable($request->get('items'));

        return response()->json();
    }
}

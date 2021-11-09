<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\MiscInformationRepository;
use App\Http\Requests\MiscInformationUpdateClass;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MiscInformationController extends Controller
{
    /** @var MiscInformationRepository $miscInformationRepository */
    private $miscInformationRepository;

    /**
     * PageController constructor.
     *
     * @param MiscInformationRepository $miscInformationRepository
     */
    public function __construct(MiscInformationRepository $miscInformationRepository)
    {
        $this->miscInformationRepository = $miscInformationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.misc-information.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $miscInformation = $this->miscInformationRepository->findByFilters();

        return DataTables::of($miscInformation)
            ->editColumn('actions', 'admin.misc-information.datatables.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $miscInformation = $this->miscInformationRepository->findOneById($id);

        return view('admin.misc-information.edit', compact('miscInformation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MiscInformationUpdateClass $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(MiscInformationUpdateClass $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $miscInformation = $this->miscInformationRepository->findOneById($id);
        $this->miscInformationRepository->update($miscInformation, $data);

        return redirect()
            ->route('misc-information.index')
            ->with('success', 'Information is updated successfully!');
    }
}

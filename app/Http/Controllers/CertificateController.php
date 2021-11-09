<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateCreateRequest;
use App\Http\Requests\CertificateUpdateRequest;
use App\Repositories\Contracts\CertificatesRepository;
use App\Repositories\Contracts\MediaRepository;
use App\Services\MediaManager\MediaManager;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class CertificateController extends Controller
{
    /** @var MediaManager */
    private $mediaManager;

    /**  @var MediaRepository */
    private $mediaRepository;

    /** @var CertificatesRepository */
    private $certificatesRepository;

    /**
     * CertificateController constructor.
     * @param MediaManager $mediaManager
     * @param MediaRepository $mediaRepository
     * @param CertificatesRepository $certificatesRepository
     */
    public function __construct(
        MediaManager $mediaManager,
        MediaRepository $mediaRepository,
        CertificatesRepository $certificatesRepository
    ) {
        $this->mediaManager = $mediaManager;
        $this->mediaRepository = $mediaRepository;
        $this->certificatesRepository = $certificatesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.certificates.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $certificates = $this->certificatesRepository->findByFilters();

        return DataTables::of($certificates)
            ->editColumn(
                'actions',
                static function ($certificate) {
                    return view(
                        'partials.datatables.actions',
                        ['model' => $certificate, 'routeModelName' => 'certificates']
                    );
                }
            )
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
        $media = $this->mediaRepository->findByFilters();

        return view('admin.certificates.create', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CertificateCreateRequest $request
     * @return RedirectResponse
     */
    public function store(CertificateCreateRequest $request): RedirectResponse
    {
        $certificate = $this->certificatesRepository->store($request->only('name'));
        $this->mediaManager->uploadMedia($request->allFiles(), $certificate, [$request->get('media_id')]);

        return redirect()
            ->route('certificates.show', $certificate->id)
            ->with('success', 'Certificate created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $certificate = $this->certificatesRepository->findOneById($id);

        return view('admin.certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $certificate = $this->certificatesRepository->findOneById($id);
        $media = $this->mediaRepository->findByFilters();

        return view('admin.certificates.edit', compact('certificate', 'media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CertificateUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CertificateUpdateRequest $request, int $id): RedirectResponse
    {
        $certificate = $this->certificatesRepository->findOneById($id);
        $this->certificatesRepository->update($certificate, $request->only('name'));

        $this->mediaManager->uploadMedia($request->allFiles(), $certificate, [$request->get('media_id')]);

        return redirect()
            ->route('certificates.show', $certificate->id)
            ->with('success', 'Certificate updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $certificate = $this->certificatesRepository->findOneById($id);
        $this->certificatesRepository->delete($certificate);

        return redirect()
            ->route('certificates.index')
            ->with('success', 'Certificate deleted successfully!');
    }
}

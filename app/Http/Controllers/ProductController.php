<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReorderProductRequest;
use App\Models\Media;
use App\Repositories\Contracts\MediaRepository;
use App\Services\MediaManager\MediaManager;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\Contracts\ProductsRepository;
use App\Repositories\Contracts\PackageNumbersRepository;
use App\Repositories\Contracts\PackageVolumesRepository;
use Illuminate\Contracts\Foundation\Application;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;

class ProductController extends Controller
{
    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /** @var MediaRepository $mediaRepository */
    public $mediaRepository;

    /** @var ProductsRepository $productsRepository */
    public $productsRepository;

    /** @var PackageVolumesRepository $packageVolumeRepository */
    public $packageVolumeRepository;

    /** @var PackageNumbersRepository $packageNumberRepository */
    public $packageNumberRepository;

    /**
     * ProductsController constructor.
     *
     * @param MediaManager $mediaManager
     * @param MediaRepository $mediaRepository
     * @param ProductsRepository $productsRepository
     * @param PackageVolumesRepository $packageVolumeRepository
     * @param PackageNumbersRepository $packageNumberRepository
     */
    public function __construct(
        MediaManager $mediaManager,
        MediaRepository $mediaRepository,
        ProductsRepository $productsRepository,
        PackageVolumesRepository $packageVolumeRepository,
        PackageNumbersRepository $packageNumberRepository
    ) {
        $this->mediaManager = $mediaManager;
        $this->mediaRepository = $mediaRepository;
        $this->productsRepository = $productsRepository;
        $this->packageVolumeRepository = $packageVolumeRepository;
        $this->packageNumberRepository = $packageNumberRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $products = $this->productsRepository->findByFilters();

        return DataTables::of($products)
            ->editColumn(
                'actions',
                static function ($product) {
                    return view(
                        'partials.datatables.actions',
                        ['model' => $product, 'routeModelName' => 'products']
                    );
                }
            )
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
        $product = $this->productsRepository->findOneById($id);
        $media = $this->mediaRepository->findByFilters();

        return view('admin.products.show', compact('product', 'media'));
    }

    /**
     * Show the form for creating a product resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $mediaDesktop = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'desktop']);
        $mediaMobile = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'mobile']);
        $packageVolume = $this->packageVolumeRepository->findByFilters();
        $packageNumber = $this->packageNumberRepository->findByFilters();

        return view('admin.products.create', compact('mediaDesktop', 'mediaMobile',  'packageVolume', 'packageNumber'));
    }

    /**
     * @param ProductCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $product = $this->productsRepository->storeWithSortable($request->all());

        $this->mediaManager->uploadMedia(
            [$request->file("image_desktop")],
            $product,
            [$request->get('media_desktop_id')],
            Media::DESKTOP,
            true
        );
        $this->mediaManager->uploadMedia(
            [$request->file("image_mobile")],
            $product,
            [$request->get('media_mobile_id')],
            Media::MOBILE,
            true
        );

        return redirect()
            ->route('products.show', $product->id)
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $product = $this->productsRepository->findOneById($id);
        $packageVolume = $this->packageVolumeRepository->findByFilters();
        $packageNumber = $this->packageNumberRepository->findByFilters();
        $mediaDesktop = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'desktop']);
        $mediaMobile = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'mobile']);

        return view('admin.products.edit', compact('product', 'mediaDesktop', 'mediaMobile',  'packageVolume', 'packageNumber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $product = $this->productsRepository->findOneById($id);
        $this->productsRepository->update($product, $data);

        $files = [
            [
                'type' => Media::DESKTOP,
                'file' => $request->file("image_desktop"),
                'existing_media' => $request->get('media_desktop_id')
            ],
            [
                'type' => Media::MOBILE,
                'file' => $request->file("image_mobile"),
                'existing_media' => $request->get('media_mobile_id')
            ]
        ];

        $this->mediaManager->uploadTypedMedia($product, $files);

        return redirect()
            ->route('products.show', $product->id)
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = $this->productsRepository->findOneById($id);
        $this->productsRepository->deleteWithSortable($product);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Reorder items
     *
     * @param ReorderProductRequest $request
     * @return JsonResponse
     */
    public function reorderSortable(ReorderProductRequest $request): JsonResponse
    {
        $this->productsRepository->reorderSortable($request->get('items'));

        return response()->json();
    }
}

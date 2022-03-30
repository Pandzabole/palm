<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderUpdateRequest;
use App\Models\Media;
use App\Models\Slider;
use App\Repositories\Contracts\MediaRepository;
use App\Repositories\Contracts\SlidersRepository;
use App\Repositories\Contracts\SliderItemsRepository;
use App\Services\MediaManager\MediaManager;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SliderCreateRequest;

class SliderController extends Controller
{
    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /** @var MediaRepository $mediaRepository */
    public $mediaRepository;

    /** @var SlidersRepository $slidersRepository */
    public $slidersRepository;

    /** @var SliderItemsRepository $sliderItemsRepository */
    public $sliderItemsRepository;

    /**
     * SliderController constructor.
     *
     * @param MediaManager $mediaManager
     * @param MediaRepository $mediaRepository
     * @param SlidersRepository $slidersRepository
     * @param SliderItemsRepository $sliderItemsRepository
     */
    public function __construct(
        MediaManager $mediaManager,
        MediaRepository $mediaRepository,
        SlidersRepository $slidersRepository,
        SliderItemsRepository $sliderItemsRepository
    ) {
        $this->mediaManager = $mediaManager;
        $this->mediaRepository = $mediaRepository;
        $this->slidersRepository = $slidersRepository;
        $this->sliderItemsRepository = $sliderItemsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $slider = $this->slidersRepository->findFirst();

        return view('admin.sliders.show', compact('slider'));
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $sliders = $this->slidersRepository->findByFilters('created_at', 'desc', [], ['pages']);

        return DataTables::of($sliders)
            ->addColumn(
                'pages',
                static function (Slider $slider) {
                    return $slider->pages->pluck('name')->implode(', ');
                }
            )
            ->editColumn(
                'actions',
                static function (Slider $slider) {
                    return view('partials.datatables.actions', ['model' => $slider, 'routeModelName' => 'sliders']);
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
        $mediaDesktop = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'desktop']);
        $mediaMobile = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'mobile']);

        return view('admin.sliders.create', compact('mediaDesktop', 'mediaMobile'));
    }

    /**
     * @param SliderCreateRequest $request
     * @return JsonResponse
     */
    public function store(SliderCreateRequest $request): JsonResponse
    {
        $slider = $this->slidersRepository->store([]);
        $steps = $request->get('steps');
        if ($steps) {
            foreach ($steps as $position => $step) {
                $data = [
                    'main_text' => data_get($step, 'main_text'),
                    'second_text' => data_get($step, 'second_text'),
                    'position' => $position,
                    'slider_id' => $slider->id
                ];
                $sliderStep = $this->sliderItemsRepository->store($data);

                $this->mediaManager->uploadMedia(
                    [$request->file("steps.{$position}.image_desktop")],
                    $sliderStep,
                    [data_get($step, 'media_desktop_id')],
                    Media::DESKTOP,
                    true,
                     true

                );
                $this->mediaManager->uploadMedia(
                    [$request->file("steps.{$position}.image_mobile")],
                    $sliderStep,
                    [data_get($step, 'media_mobile_id')],
                    Media::MOBILE,
                    true,
                    true
                );
            }
        }

        return response()->json(['redirect' => route('sliders.show', $slider->id)]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $slider = $this->slidersRepository->findOneById($id);

        return view('admin.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $slider = $this->slidersRepository->findOneById($id);
        $mediaDesktop = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'desktop']);
        $mediaMobile = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'mobile']);

        return view('admin.sliders.edit', compact('slider', 'mediaDesktop', 'mediaMobile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SliderUpdateRequest $request, int $id): JsonResponse
    {
        $slider = $this->slidersRepository->findOneById($id);
        if ($steps = $request->get('steps')) {
            foreach ($steps as $position => $step) {
                $data = [
                    'position' => $position,
                    'slider_id' => $slider->id,
                    'main_text' => data_get($step, 'main_text'),
                    'second_text' => data_get($step, 'second_text'),
                ];
                $sliderStep = $this->sliderItemsRepository->updateOrCreate(
                    ['id' => data_get($step, 'step_id')],
                    $data
                );

                $files = [
                    [
                        'type' => Media::DESKTOP,
                        'file' => $request->file("steps.{$position}.image_desktop"),
                        'existing_media' => data_get($step, 'media_desktop_id')
                    ],
                    [
                        'type' => Media::MOBILE,
                        'file' => $request->file("steps.{$position}.image_mobile"),
                        'existing_media' => data_get($step, 'media_mobile_id')
                    ]
                ];

                $this->mediaManager->uploadTypedMedia($sliderStep, $files, true);
            }
        }

        $deletedSliderSteps = $request->get('deleted_steps');
        if (!empty($deletedSliderSteps)) {
            $this->sliderItemsRepository->deleteAll($deletedSliderSteps);
        }

        return response()->json(['redirect' => route('sliders.show', $slider->id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $slider = $this->slidersRepository->findOneById($id);
        $this->slidersRepository->delete($slider);

        return redirect(route('sliders.index'))->with('success', 'Slider deleted successfully!');
    }
}

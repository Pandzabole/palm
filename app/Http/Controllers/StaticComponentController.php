<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Repositories\Contracts\StaticComponentsRepository;
use App\Repositories\Contracts\PagesRepository;
use App\Repositories\Contracts\MediaRepository;
use App\Services\MediaManager\MediaManager;
use App\Http\Requests\StaticComponentsUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StaticComponentController extends Controller
{
    /** @var MediaManager $mediaManager */
    public $mediaManager;

    /** @var MediaRepository $mediaRepository */
    public $mediaRepository;

    /** @var PagesRepository $pagesRepository */
    public $pagesRepository;

    /** @var StaticComponentsRepository $staticComponents */
    public $staticComponents;

    /**
     * StaticComponentController constructor.
     *
     * @param MediaManager $mediaManager
     * @param MediaRepository $mediaRepository
     * @param PagesRepository $pagesRepository
     * @param StaticComponentsRepository $staticComponents
     */
    public function __construct(
        MediaManager $mediaManager,
        MediaRepository $mediaRepository,
        PagesRepository $pagesRepository,
        StaticComponentsRepository $staticComponents
    ) {
        $this->mediaManager = $mediaManager;
        $this->mediaRepository = $mediaRepository;
        $this->pagesRepository = $pagesRepository;
        $this->staticComponents = $staticComponents;
    }

    /**
     * @param string $pageSlug
     * @return Application|Factory|View
     */
    public function show(string $pageSlug)
    {
        $page = $this->pagesRepository->getWithComponents($pageSlug);

        $pageComponents = $page->staticComponent->merge(
            $page->news->merge($page->activity)
        )->sortBy('position');

        return view('admin.page-components.show', compact('pageComponents', 'pageSlug'));
    }

    /**
     * @param string $pageSlug
     * @return Application|Factory|View
     */
    public function edit(string $pageSlug)
    {
        $page = $this->pagesRepository->getWithComponents($pageSlug);

        $pageComponents = $page->staticComponent->merge(
            $page->news->merge($page->activity)
        )->sortBy('position');

        $mediaDesktop = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'desktop']);
        $mediaMobile = $this->mediaRepository->findByFilters('created_at', 'desc', ['config' => 'mobile']);

        return view('admin.page-components.edit', compact('pageComponents', 'pageSlug', 'mediaDesktop', 'mediaMobile'));
    }

    /**
     * @param StaticComponentsUpdateRequest $request
     * @param string $pageSlug
     * @return RedirectResponse
     */
    public function update(StaticComponentsUpdateRequest $request, string $pageSlug): RedirectResponse
    {
        $data = $request->all();
        if ($data) {
            foreach ($data['components'] as $components) {
                $component = $this->staticComponents->findOneById($components['id']);
                $this->staticComponents->update($component, $components);

                $files = [
                    [
                        'type' => Media::DESKTOP,
                        'file' => $request->file("components.{$component['id']}.image_desktop"),
                        'existing_media' => data_get($components, 'media_desktop_id')
                    ],
                    [
                        'type' => Media::MOBILE,
                        'file' => $request->file("components.{$component['id']}.image_mobile"),
                        'existing_media' => data_get($components, 'media_mobile_id')
                    ]
                ];

                $this->mediaManager->uploadTypedMedia($component, $files);
            }
        }

        return redirect()
            ->route('components.show', $pageSlug)
            ->with('success', 'Page components updated successfully!');
    }
}

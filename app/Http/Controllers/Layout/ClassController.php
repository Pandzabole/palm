<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ClassCategoryRepository;
use App\Repositories\Contracts\ClassesRepository;
use App\Repositories\Contracts\ReviewRepository;
use App\Repositories\Contracts\ClassSubCategoryRepository;
use App\Repositories\Contracts\ClassLevelRepository;
use App\Repositories\Contracts\ClassLocationRepository;
use App\Services\FrontLayout\FrontLayoutDataService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ClassController extends Controller
{
    /** @var ClassCategoryRepository $classCategoryRepository */
    public $classCategoryRepository;

    /** @var ClassesRepository $classesRepository */
    public $classesRepository;

    /** @var ClassSubCategoryRepository $classSubCategoryRepository */
    public $classSubCategoryRepository;

    /** @var ClassLevelRepository $classLevelRepository */
    public $classLevelRepository;

    /** @var ClassLocationRepository $classLocationRepository */
    public $classLocationRepository;

    /** @var FrontLayoutDataService $frontLayoutDataService */
    public $frontLayoutDataService;

    /** @var ReviewRepository $reviewRepository */
    public $reviewRepository;

    /**
     * ActivityCategoryController constructor.
     *
     * @param ClassCategoryRepository $classCategoryRepository
     * @param ClassSubCategoryRepository $classSubCategoryRepository
     * @param ClassLevelRepository $classLevelRepository
     * @param ClassLocationRepository $classLocationRepository
     * @param FrontLayoutDataService $frontLayoutDataService
     * @param ClassesRepository $classesRepository
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(
        ClassCategoryRepository    $classCategoryRepository,
        ClassSubCategoryRepository $classSubCategoryRepository,
        ClassLevelRepository       $classLevelRepository,
        ClassLocationRepository    $classLocationRepository,
        FrontLayoutDataService     $frontLayoutDataService,
        ClassesRepository          $classesRepository,
        ReviewRepository           $reviewRepository
    )
    {
        $this->classCategoryRepository = $classCategoryRepository;
        $this->classSubCategoryRepository = $classSubCategoryRepository;
        $this->classLevelRepository = $classLevelRepository;
        $this->classLocationRepository = $classLocationRepository;
        $this->frontLayoutDataService = $frontLayoutDataService;
        $this->classesRepository = $classesRepository;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function allClasses()
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByPaginate(12);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function showSubCategoryClasses($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classSubCategoryId = $this->classSubCategoryRepository->findOneBy(['uuid' => $uuid])->id;
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_sub_category_id' => $classSubCategoryId]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-sub-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function showMainCategoryClasses($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classMainCategoryId = $this->classCategoryRepository->findOneBy(['uuid' => $uuid])->id;
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_category_id' => $classMainCategoryId]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-main-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));

    }

    /**
     * @param $levelUuid
     * @param $uuid
     * @return Application|Factory|View
     */
    public function classLevelFilter($levelUuid, $uuid)
    {

        $this->frontLayoutDataService->getData();
        $classMainCategoryId = $this->classSubCategoryRepository->findOneBy(['uuid' => $uuid])->id;
        $classLevelId = $this->classLevelRepository->findOneBy(['uuid' => $levelUuid])->id;

        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_sub_category_id' => $classMainCategoryId, 'class_level_id' => $classLevelId]);
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-sub-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function classLevelFilterAll($uuid)
    {

        $this->frontLayoutDataService->getData();
        $classLevelId = $this->classLevelRepository->findOneBy(['uuid' => $uuid])->id;
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_level_id' => $classLevelId]);
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $levelUuid
     * @param $uuid
     * @return Application|Factory|View
     */
    public function classLevelFilterMain($levelUuid, $uuid)
    {
        $this->frontLayoutDataService->getData();
        $classMainCategoryId = $this->classCategoryRepository->findOneBy(['uuid' => $uuid])->id;
        $classLevelId = $this->classLevelRepository->findOneBy(['uuid' => $levelUuid])->id;

        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_category_id' => $classMainCategoryId, 'class_level_id' => $classLevelId]);
        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-main-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $locationUuid
     * @param $uuid
     * @return Application|Factory|View
     */
    public function classLocationFilter($locationUuid, $uuid)
    {
        $this->frontLayoutDataService->getData();
        $classSubCategoryId = $this->classSubCategoryRepository->findOneBy(['uuid' => $uuid])->id;
        $classLocationId = $this->classLocationRepository->findOneBy(['uuid' => $locationUuid])->id;
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByHasOrWhereRelationship(
            'locations',
            ['class_location_id' => $classLocationId],
            [],
            ['class_sub_category_id' => $classSubCategoryId],
        )->paginate(12);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-sub-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $locationUuid
     * @param $uuid
     * @return Application|Factory|View
     */
    public function classLocationFilterAll($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classLocationId = $this->classLocationRepository->findOneBy(['uuid' => $uuid])->id;
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByHasOrWhereRelationship(
            'locations',
            ['class_location_id' => $classLocationId],
            [],
        )->paginate(12);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $locationUuid
     * @param $uuid
     * @return Application|Factory|View
     */
    public function classLocationFilterMain($locationUuid, $uuid)
    {
        $this->frontLayoutDataService->getData();
        $classMainCategoryId = $this->classCategoryRepository->findOneBy(['uuid' => $uuid])->id;
        $classLocationId = $this->classLocationRepository->findOneBy(['uuid' => $locationUuid])->id;
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByHasOrWhereRelationship(
            'locations',
            ['class_location_id' => $classLocationId],
            [],
            ['class_category_id' => $classMainCategoryId],
        )->paginate(12);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-main-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function popularClasses($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classSubCategoryId = $this->classSubCategoryRepository->findOneBy(['uuid' => $uuid])->id;

        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_sub_category_id' => $classSubCategoryId, 'popular' => true]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-sub-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @return Application|Factory|View
     */
    public function popularClassesAll()
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['popular' => true]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function popularClassesMain($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classMainCategoryId = $this->classCategoryRepository->findOneBy(['uuid' => $uuid])->id;

        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_sub_category_id' => $classMainCategoryId, 'popular' => true]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-main-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function discountedClasses($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classSubCategoryId = $this->classSubCategoryRepository->findOneBy(['uuid' => $uuid])->id;

        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_sub_category_id' => $classSubCategoryId, 'discount' => true]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-sub-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }


    /**
     * @return Application|Factory|View
     */
    public function discountedClassesAll()
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['discount' => true]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function discountedClassesMain($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classMainCategoryId = $this->classCategoryRepository->findOneBy(['uuid' => $uuid])->id;

        $classes = $this->classesRepository->findByPaginate(
            12,
            'created_at',
            'desc',
            ['class_sub_category_id' => $classMainCategoryId, 'discount' => true]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-main-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function lowToHighPrice($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classSubCategoryId = $this->classSubCategoryRepository->findOneBy(['uuid' => $uuid])->id;

        $classes = $this->classesRepository->findByPaginate(
            12,
            'price_eur',
            'asc',
            ['class_sub_category_id' => $classSubCategoryId]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-sub-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @return Application|Factory|View
     */
    public function lowToHighPriceAll()
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByPaginate(
            12,
            'price_eur',
            'asc',
        );

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function lowToHighPriceMain($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classMainCategoryId = $this->classCategoryRepository->findOneBy(['uuid' => $uuid])->id;

        $classes = $this->classesRepository->findByPaginate(
            12,
            'price_eur',
            'asc',
            ['class_sub_category_id' => $classMainCategoryId]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-main-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @return Application|Factory|View
     */
    public function highToLowPriceAll()
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();

        $classes = $this->classesRepository->findByPaginate(
            12,
            'price_eur',
            'desc',
        );

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function highToLowPriceMain($uuid)
    {
        $this->frontLayoutDataService->getData();
        $classLevel = $this->classLevelRepository->findByFilters();
        $classLocation = $this->classLocationRepository->findByFilters();
        $classMainCategoryId = $this->classCategoryRepository->findOneBy(['uuid' => $uuid])->id;

        $classes = $this->classesRepository->findByPaginate(
            12,
            'price_eur',
            'desc',
            ['class_sub_category_id' => $classMainCategoryId]);

        $mainCategories = $this->classCategoryRepository->getAll()->load('classSubCategory');
        $singleClass = $classes->first();

        return view('front-pages.all-main-classes',
            compact('classes',
                'mainCategories',
                'singleClass',
                'classLevel',
                'classLocation',
                'uuid'
            ));
    }

    /**
     * @param $uuid
     * @return Application|Factory|View
     */
    public function showSingleClass($uuid)
    {
        $this->frontLayoutDataService->getData();
        $class = $this->classesRepository->findOneBy(['uuid' => $uuid]);
        $relatedClasses = $this->classesRepository->getAll()->take(3);
        $mainCategories = $this->classCategoryRepository->getAll();
        $classReview = $this->reviewRepository->findByFilters(
            'created_at',
            'desc',
            [
                'classe_id' => $class->id,
                'publish' => true,

            ]
        );

        return view('front-pages.single-class', compact('mainCategories', 'class', 'relatedClasses', 'classReview'));

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function reviewClass(Request $request): JsonResponse
    {
        $this->reviewRepository->store($request->all());
        return response()->json(['success' => 'Successfully'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

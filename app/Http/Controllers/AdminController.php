<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Contracts\UsersRepository;
use App\Repositories\Contracts\MainMarketsRepository;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /** @var UsersRepository $usersRepository */
    public $usersRepository;

    /** @var MainMarketsRepository $mainMarketsRepository */
    public $mainMarketsRepository;

    /**
     * AdminController constructor.
     *
     * @param UsersRepository $usersRepository
     * @param MainMarketsRepository $mainMarketsRepository
     */
    public function __construct(UsersRepository $usersRepository, MainMarketsRepository $mainMarketsRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->mainMarketsRepository = $mainMarketsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $admins = $this->usersRepository->findByFilters();

        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $admins = $this->usersRepository->findByFilters();

        return DataTables::of($admins)
            ->editColumn('actions', static function ($admin) {
                return view(
                    'admin.admins.datatables.actions',
                    ['model' => $admin, 'routeModelName' => 'admins']
                );
            })
            ->addColumn('admin_privileges', static function (User $admin) {
                return $admin->role_name;
            })
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
        $markets = $this->mainMarketsRepository->findByFilters();
        return view('admin.admins.create', compact('markets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminCreateRequest $request
     * @return RedirectResponse
     */
    public function store(AdminCreateRequest $request): RedirectResponse
    {
        $data = $request->all();
        $mainMarketsId = $request->get('main_market_id');

        if (!$mainMarketsId) {
            $markets = $this->mainMarketsRepository->findByFilters()->pluck('id')->toArray();
        }

        $admin = $this->usersRepository->store($data);

        $admin->mainMarkets()->attach($mainMarketsId ?: $markets);

        return redirect()
            ->route('admins.show', $admin->id)
            ->with('success', 'Admin created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $admin = $this->usersRepository->findOneById($id);

        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $admin = $this->usersRepository->findOneById($id);
        $markets = $this->mainMarketsRepository->findByFilters();

        return view('admin.admins.edit', compact('admin', 'markets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(AdminUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        if (data_get($data, 'change_password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $mainMarketsId = $request->get('main_market_id');

        if (!$mainMarketsId) {
            $markets = $this->mainMarketsRepository->findByFilters()->pluck('id')->toArray();
        }
        $admin = $this->usersRepository->findOneById($id);

        $this->usersRepository->update($admin, $data);
        $admin->mainMarkets()->sync($mainMarketsId ?: $markets);

        return redirect()
            ->route('admins.show', $admin->id)
            ->with('success', 'Admin updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $admin = $this->usersRepository->findOneById($id);

        $this->authorize('delete', [User::class, $id]);
        $this->usersRepository->delete($admin);
        $admin->mainMarkets()->detach();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin deleted successfully!');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getSpecificMarkets(Request $request)
    {
        $markets = $this->mainMarketsRepository->findByFilters(
            'created_at',
            'asc',
            ['privileges' => $request->get('role_id')]
        );
        return response()->json(['markets' => $markets]);
    }
}

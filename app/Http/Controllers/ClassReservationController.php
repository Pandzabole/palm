<?php

namespace App\Http\Controllers;

use App\Models\ReservationClass;
use App\Repositories\Contracts\ReservationClassRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class ClassReservationController extends Controller
{
    /** @var  ReservationClassRepository $reservationClassRepository */
    private $reservationClassRepository;

    /**
     * @param ReservationClassRepository $reservationClassReposit
     */
    public function __construct(ReservationClassRepository $reservationClassReposit)
    {
        $this->reservationClassRepository = $reservationClassReposit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $reservations = $this->reservationClassRepository->findByFilters()->pluck('name', 'id');

        return view('admin.class-reservation.index', compact('reservations'));
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $reservations = $this->reservationClassRepository->findByFilters();

        return DataTables::of($reservations)
            ->editColumn(
                'actions',
                static function (ReservationClass $reservation) {
                    return view('partials.datatables.actions', ['model' => $reservation, 'routeModelName' => 'class-reservation']);
                }
            )
            ->editColumn('reply_client', 'admin.class-reservation.datatables.answered')
            ->rawColumns(['actions'])
            ->rawColumns(['actions', 'reply_client'])
            ->make(true);
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
     * @param  \Illuminate\Http\Request  $request
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
     * @return Application|Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $classReservation = $this->reservationClassRepository->findOneById($id);

        return view('admin.class-reservation.show', compact('classReservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function updateClassRead(int $id): RedirectResponse
    {
        $classReservation = $this->reservationClassRepository->findOneById($id);
        $this->reservationClassRepository->update($classReservation, ['read_reservation' => true ]);

        return redirect()
            ->route('class-reservation.show', $id)
            ->with('success', 'Reservation read successfully!');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function updateClassReply(int $id): RedirectResponse
    {
        $classReservation = $this->reservationClassRepository->findOneById($id);
        $this->reservationClassRepository->update($classReservation, ['reply_client' => true ]);

        return redirect()
            ->route('class-reservation.show', $id)
            ->with('success', 'Reservation change successfully!');
    }
}

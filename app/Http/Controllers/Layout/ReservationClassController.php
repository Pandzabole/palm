<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ReservationClassRepository;
use App\Services\SendEmailService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ReservationClassController extends Controller
{

    /** @var ReservationClassRepository $reservationClassRepository */
    public $reservationClassRepository;

    /** @var SendEmailService $sendEmailService */
    public $sendEmailService;

    /**
     * ActivityController constructor.
     * @param ReservationClassRepository $reservationClassRepository
     * @param SendEmailService $sendEmailService
     */
    public function __construct(
        ReservationClassRepository $reservationClassRepository,
        SendEmailService $sendEmailService
    )
    {
        $this->reservationClassRepository = $reservationClassRepository;
        $this->sendEmailService = $sendEmailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $data = $request->all();
        $language = $data['language'];
        $langSession = Session::get('db_language_layout');
        $data['classe_id'] = 1;
        $data['teacher_id'] = 1;
        $data['amount'] = 1;

        $reservation = $this->reservationClassRepository->store($data);
        $this->sendEmailService->sendEmail($reservation, $language);

        return redirect()->back()->with('success', 'Račun je poslat');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}

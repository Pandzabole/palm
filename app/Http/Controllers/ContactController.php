<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Exception;
use App\Repositories\Contracts\ContactsRepository;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    /** @var ContactsRepository $contactsRepository */
    private $contactsRepository;

    /**
     * ContactController constructor.
     *
     * @param ContactsRepository $contactsRepository
     */
    public function __construct(ContactsRepository $contactsRepository)
    {
        $this->contactsRepository = $contactsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.contacts.index');
    }

    /**
     * Process data-tables ajax request.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function getData(): JsonResponse
    {
        $contacts = $this->contactsRepository->findByFilters();

        return DataTables::of($contacts)
            ->editColumn(
                'actions',
                static function ($contact) {
                    return view(
                        'admin.contacts.datatables.actions',
                        ['model' => $contact, 'routeModelName' => 'contacts', 'id' => $contact->id]
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
        $contact = $this->contactsRepository->findOneById($id);

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $contact = $this->contactsRepository->findOneById($id);
        $this->contactsRepository->delete($contact);

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contacts deleted successfully!');
    }
}

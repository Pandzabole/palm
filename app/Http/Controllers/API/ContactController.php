<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Notifications\ContactNotification;
use App\Repositories\Contracts\ContactsRepository;
use App\Repositories\Contracts\UsersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;


class ContactController extends Controller
{
    /** @var ContactsRepository $contactsRepository */
    private $contactsRepository;

    /** @var UsersRepository $usersRepository */
    private $usersRepository;

    /**
     * ContactController constructor.
     * @param UsersRepository $usersRepository
     * @param ContactsRepository $contactsRepository
     */
    public function __construct(UsersRepository $usersRepository, ContactsRepository $contactsRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->contactsRepository = $contactsRepository;
    }

    /**
     * * @OA\Post(
     *     path="/api/contact",
     *     tags={"Contacts"},
     *     summary="Send contact message",
     *     operationId="contact",
     *     @OA\Parameter(
     *         name="lang",
     *         in="query",
     *         required=false,
     *         description="Send language short code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="unprocessable entity"
     *     ),
     *     security={
     *          {"passport": {}},
     *     },
     *     requestBody={"$ref": "#/components/requestBodies/Contact"}
     * )
     *
     * @param ContactRequest $request
     * @return JsonResponse
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'description' => $request->get('description'),
        ];

        $contact = $this->contactsRepository->store($data);
        $admin = $this->usersRepository->findAdminUser();

        Notification::send($admin, (new ContactNotification($contact))->locale($request->get('lang')));

        return response()->json(['message' => 'Message Sent Successfully'], 201);
    }

    /**
     * @OA\RequestBody(
     *     request="Contact",
     *     description="Contact message details",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/contact")
     * )
     */

    /**
     * @OA\Schema(
     *     schema="contact",
     *     type="object",
     *     title="Contact",
     *     required={"name", "email", "description"},
     *     @OA\Property(property="name", type="string", description="Name"),
     *     @OA\Property(property="email", type="string", description="Email address"),
     *     @OA\Property(property="description", type="string", description="Message description"),
     * )
     */
}

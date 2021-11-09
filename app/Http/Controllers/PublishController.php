<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PublishRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PublishController extends Controller
{
    /**@var PublishRepository $publishRepository */
    private $publishRepository;

    /**
     * PublishController constructor.
     * @param PublishRepository $publishRepository
     */
    public function __construct(PublishRepository $publishRepository)
    {
        $this->publishRepository = $publishRepository;
    }

    /**
     * @return JsonResponse
     */
    public function publish(): JsonResponse
    {
        $response = Http::post(config('publish.endpoint'));
        $statusCode = $response->status();

        if ($statusCode === 201) {
            $publish = $this->publishRepository->findOneById(1);
            $this->publishRepository->update($publish, ['status' => 1]);
        }

        return response()->json()->setStatusCode($statusCode);
    }
}

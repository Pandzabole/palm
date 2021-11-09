<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\LanguagesRepository;
use App\Services\ContentManager\ContentService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckLanguageAPI
{
    /** @var ContentService $contentService */
    private $contentService;

    /** @var LanguagesRepository $languagesRepository */
    private $languagesRepository;

    /**
     * CheckLanguageAPI constructor.
     *
     * @param ContentService $contentService
     * @param LanguagesRepository $languagesRepository
     */
    public function __construct(ContentService $contentService, LanguagesRepository $languagesRepository)
    {
        $this->contentService = $contentService;
        $this->languagesRepository = $languagesRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $languageParameter = $request->get('lang') ?? $request->route('lang');
        $language = $this->languagesRepository->findOrGetDefault($languageParameter);
        $connectionSchema = config("content-connections.$language->connection_name");

        $this->contentService->setConnectionDatabase(DB::getDefaultConnection(), $connectionSchema);

        return $next($request);
    }
}

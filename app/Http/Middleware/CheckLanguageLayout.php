<?php

namespace App\Http\Middleware;

use App\Services\ContentManager\ContentService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CheckLanguageLayout
{
    /** @var ContentService $contentService */
    private  $contentService;

    /**
     * CheckLanguage constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
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
        $langSession = Session::get('db_language_layout');
        $langName = Session::get('db_language_name_layout');

        if (!$langSession) {
            $langSession = 'database-en';
            $langName = 'en';
            Session::put(['db_language_layout' => $langSession, 'db_language_name_layout' => $langName ]);
        }

        $connection = DB::getDefaultConnection();
        $connectionSchema = config("content-connections.$langSession");
        $activeConnectionSchema = config("database.connections.$connection .database");

        if ($connectionSchema !== $activeConnectionSchema) {
            $this->contentService->setConnectionDatabase($connection, $connectionSchema);
        }

        View::share('selectedLanguageLayout', $langName);

        return $next($request);
    }
}

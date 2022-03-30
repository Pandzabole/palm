<?php

namespace App\Http\Middleware;

use App\Services\ContentManager\ContentService;
use Closure;
use App\Repositories\Contracts\LanguagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CheckLanguageLayout
{
    /** @var ContentService $contentService */
    private  $contentService;

    /** @var LanguagesRepository $languagesRepository */
    public $languagesRepository;

    /**
     * CheckLanguage constructor.
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
        $langSession = Session::get('db_language_layout');
        $langName = Session::get('db_language_name_layout');
        $language = $request->get('lang');

        if($language){
            $language = $this->languagesRepository->findOneBy(['short' => $language]);
            $langSession = $language->connection_name;
            Session::put(['db_language_layout' => $langSession, 'db_language_name_layout' => $language->short]);
        }

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

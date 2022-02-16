<?php

namespace App\Services\FrontLayout;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class FrontLayoutDataService
{
    /**
     * @return void
     */
    public function getData(): void
    {
        $langSession = Session::get('db_language_name_layout');
        App::setLocale($langSession);

        session()->put('locale', $langSession);

    }
}

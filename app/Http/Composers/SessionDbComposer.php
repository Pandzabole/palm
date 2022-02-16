<?php

namespace App\Http\Composers;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class SessionDbComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $language = 'database-en';

        $session = Session::get('db_language_layout');

        if( $session === 'database-om' ){

            $language = 'database-om';
        }

        if( $session === 'database-ar' ){

            $language = 'database-ar';
        }

        $view->with(compact('session', 'language'));

    }
}

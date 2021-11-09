<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class BreadcrumbComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $route = request()->route();
        $name = null;
        $action = null;

        if ($route) {
            $routeName = explode('.', $route->getName());
            $name = data_get($routeName, 0);
            $actionName = data_get($routeName, 1);
            if ($actionName) {
                $actionList = ['index' => 'list', 'show' => 'details', 'edit' => 'edit', 'create' => 'add'];
                $action = data_get($actionList, $actionName);
            }
        }

        $view->with(compact('name', 'action'));
    }
}

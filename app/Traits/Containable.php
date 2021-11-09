<?php

namespace App\Traits;

use App\Models\Content\Content;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Throwable;

trait Containable
{
    /**
     * @param $views
     * @param array $data
     * @return array|string
     */
    public function render($views, $data = [])
    {
        return view()->first($views)->with($data)->render();
    }

    /**
     * @return array|string
     * @throws Throwable
     */
    public function renderForm()
    {
        return $this->render([$this->formView]);
    }

    /**
     * @return array|string
     * @throws Throwable
     */
    public function renderShow()
    {
        return $this->render([$this->showView]);
    }

    /**
     * @return MorphMany
     */
    public function contains(): MorphMany
    {
        return $this->morphMany(Content::class, 'contentable');
    }
}

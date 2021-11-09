<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UploadImageRule implements Rule
{
    /** @var bool $create */
    private $create;

    /** @var bool $create */
    private $twoTypes;

    /**
     * Create a new rule instance.
     *
     * @param bool $create
     * @param bool $twoTypes
     */
    public function __construct(bool $create = true, bool $twoTypes = true)
    {
        $this->create = $create;
        $this->twoTypes = $twoTypes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->checkExistence($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute image or media is required.';
    }

    /**
     * @param array $value
     * @return bool
     */
    private function checkExistence(array $value): bool
    {
        $result = false;
        if ($this->create || data_get($value, 'deleted')) {
            $result = $this->checkMedia($value);
        }

        if ($this->twoTypes) {
            $result = $this->checkTwoWayType($value);
        }

        return $result;
    }

    /**
     * @param $value
     * @return bool
     */
    private function checkTwoWayType($value): bool
    {
        $mobile = true;
        if ($this->create || data_get($value, 'mobile_deleted')) {
            $mobile = $this->checkMedia($value, 'mobile');
        }

        $desktop = true;
        if ($this->create || data_get($value, 'desktop_deleted')) {
            $desktop = $this->checkMedia($value, 'desktop');
        }

        return $mobile && $desktop;
    }

    /**
     * @param $value
     * @param $type
     * @return bool
     */
    private function checkMedia($value, $type = null): bool
    {
        $type = $type ? "_{$type}" : '';

        $image = data_get($value, "image{$type}");
        $media = data_get($value, "media{$type}_id");

        return $image || $media;
    }
}

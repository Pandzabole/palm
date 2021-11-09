<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SeedContainable
{
    /**
     * @param array|null $data
     */
    public function seedData($data = null): void
    {
        $currentSchema = $this->getCurrentSchema();

        foreach (config('content-connections') as $contentConnection => $schema) {
            if ($currentSchema === $schema) {
                if (isset($this->modelClass)) {
                    $this->seedPreparedData($contentConnection, $data);
                } else {
                    $this->seedFactoryData($contentConnection, $data);
                }
            }
        }
    }

    /**
     * @param $currentSchema
     * @param $pageId
     * @param array $media
     */
    public function seedStaticData($currentSchema, $pageId, $media = []): void
    {
        foreach (config('content-connections') as $contentConnection => $schema) {
            if ($currentSchema === $schema) {
                $this->insertStaticData($pageId, $contentConnection);
                $this->insertMedia($media);
            }
        }
    }

    /**
     * @param $pageId
     * @param $contentConnection
     */
    public function insertStaticData($pageId, $contentConnection): void
    {
        $componentable = [];
        $data = $this->getPreparedData();

        foreach ($data[$contentConnection] as $pageComponent) {
            $class = config("relationships.page.{$pageComponent['type']}.class");
            $staticComponent = $class::firstOrCreate($pageComponent);
            $componentable[] = [
                'page_id' => $pageId,
                'component_type' => $class,
                'component_id' => $staticComponent->id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('components')->insertOrIgnore($componentable);
    }

    /**
     * @param $components
     */
    public function insertMedia($components): void
    {
        $mediables = [];

        foreach ($components as $componentId => $componentClass) {
            $mediables[] = [
                'media_id' => 1,
                'mediable_type' => $componentClass,
                'mediable_id' => $componentId
            ];

            $mediables[] = [
                'media_id' => 2,
                'mediable_type' => $componentClass,
                'mediable_id' => $componentId
            ];
        }

        DB::table('mediables')->insertOrIgnore($mediables);
    }

    /**
     * @return string
     */
    public function getCurrentSchema(): string
    {
        $connection = DB::getDefaultConnection();

        return config("database.connections.$connection.database");
    }

    /**
     * @param string $contentConnection
     * @param null $data
     */
    private function seedPreparedData(string $contentConnection, $data = null): void
    {
        $data = $data ?: $this->getPreparedData();

        $this->modelClass::insertOrIgnore($data[$contentConnection]);
    }

    /**
     * @param string $contentConnection
     * @param null $data
     */
    private function seedFactoryData(string $contentConnection, $data = null): void
    {
        $data = $data ?: $this->getDataMethods();

        $this->{$data[$contentConnection]}();
    }

    /**
     * @return string[]
     */
    private function getDataMethods(): array
    {
        return [
            'database-en' => 'getEnData',
            'database-ar' => 'getArData',
        ];
    }

    /**
     * @return array
     */
    private function getPreparedData(): array
    {
        return [
            'database-en' => $this->getEnData(),
            'database-ar' => $this->getArData(),
        ];
    }

    /**
     * @return void|array
     */
    abstract protected function getEnData(): array;

    /**
     * @return void|array
     */
    abstract protected function getArData(): array;

}

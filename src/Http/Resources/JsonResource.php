<?php

namespace Rickgoemans\LaravelApiResponseHelpers\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;

/** @property-read Model $resource */
class JsonResource extends BaseJsonResource
{
    public function baseToArray(string $modelClass): array
    {
        $data = [
            $this->resource->getKeyName() => $this->resource->getKey(),
        ];

        if ($this->resource->usesTimestamps()) {
            $data = [
                ...$data,

                $this->resource->getCreatedAtColumn() => $this->resource->{$this->resource->getCreatedAtColumn()}->toIso8601String(),
                $this->resource->getUpdatedAtColumn() => $this->resource->{$this->resource->getUpdatedAtColumn()}->toIso8601String(),
            ];
        }

        $traits = class_uses_recursive($modelClass);
        if (in_array(SoftDeletes::class, array_keys($traits))) {
            $data = [
                ...$data,

                // @phpstan-ignore-next-line
                $this->resource->getDeletedAtColumn() => $this->resource->{$this->resource->getDeletedAtColumn()}?->toIso8601String(),
            ];
        }

        return $data;
    }
}

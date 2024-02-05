<?php

namespace Modules\Award\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Award\App\Models\Award;

class AwardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        /** @var Award|self $this */
        return [
            'title' => $this->title
        ];
    }
}

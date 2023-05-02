<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MobileAppNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->data["title"],
            "body" => $this->data["message"],
            "read_at" => DateTimeResource::make($this->read_at),
            "created_at" => DateTimeResource::make($this->created_at),
            "updated_at" => DateTimeResource::make($this->updated_at)
        ];
    }
}

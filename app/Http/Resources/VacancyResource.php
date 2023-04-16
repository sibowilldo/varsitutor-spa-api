<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category->name,
            'type' => $this->type->name,
            'user' => $this->user->profile->name,
            'department' => $this->department->name,
            'status' => $this->status->name,
            'title' => $this->title,
            'description' => $this->description,
            'short_description' => str()->limit(25, $this->description),
            'location' => $this->location,
            'expires_at' => DateTimeResource::make($this->expires_at),
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}

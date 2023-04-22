<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' =>$this->title,
            'url' => url(Storage::url($this->path)),
            'type' =>$this->type,
            'mime_type' =>$this->mime_type,
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->profile->name,
            'given_name' => $this->profile->given_name,
            'family_name' => $this->profile->family_name,
            'contact_number' => $this->profile->contact_number,
            'email' => $this->email,
            'status' => $this->status->name,
            'joined' => DateTimeResource::make($this->created)
        ];
    }
}

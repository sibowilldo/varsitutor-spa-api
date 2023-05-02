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
            'id' => $this->id,
            'internal_id' => $this->internal_identification,
            'name' => $this->profile->name,
            'given_name' => $this->profile->given_name,
            'family_name' => $this->profile->family_name,
            'contact_number' => $this->profile->contact_number,
            'province_city' => $this->profile?->province_city,
            'profile_photo_url'=> $this->profile_photo_url,
            'email' => $this->email,
            'status' => $this->status->name,
            'applications_count' => count($this->applications),
            'applications' => new ApplicationResourceCollection($this->applications),
            'joined' => DateTimeResource::make($this->created_at),
            'verified' => $this->email_verified_at == null
        ];
    }
}

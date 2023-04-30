<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'vacancy' => new VacancyResource($this->vacancy),
            'status' => $this->status?->name,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'additional_information' =>[
                'job_title' => $this->job_title,
                'duration' => sprintf('%s %s',$this->duration,str('month')->plural((int)$this->duration)),
                'company_department' => $this->company_department,
                'motivation' => $this->motivation,
            ],
            'attachments' => new AttachmentResourceCollection($this->attachments),
            'created_at' => DateTimeResource::make($this->created_at)
        ];
    }
}

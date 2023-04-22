<?php

namespace App\Actions\Application;

use App\Enums\StatusModelTypeEnum;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\Status;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateNewApplication
{
    use AsAction;

    public function rules(): array
    {
        return [
            'vacancy_id' => 'required',
            'user_id' => 'required',
            'contact_number' => 'nullable|string|max:15',
            'email' => 'nullable|string|email',
            'job_title' => 'nullable|string|max:50',
            'duration' => 'nullable|string|max:50',
            'company_department' => 'nullable|string|max:100',
            'motivation' => 'nullable|string',
            'attachment' => 'nullable|mimes:doc,pdf,docx',

        ];
    }

    public function handle($user, Vacancy $vacancy, array $data): Model
    {
        DB::beginTransaction();
        $sentStatus = Status::where(['name'=>'sent', 'model_type' => StatusModelTypeEnum::APPLICATIONS->value])->first();
        $application = $user->applications()->create([
            'vacancy_id' => $vacancy->id,
            'status_id' => $sentStatus->id,
            'contact_number' => $data['contact_number']?? null,
            'email' => $data['email']?? null,
            'job_title' => $data['job_title']?? null,
            'duration' => $data['duration']?? null,
            'company_department' => $data['company_department']?? null,
            'motivation' => $data['motivation']?? null,
        ]);
        if($data['attachment']??null){
            $this->uploadAttachedFile($data['attachment'], $user, $application);
        }
        DB::commit();
        return $application->fresh();
    }

    public function asController(ActionRequest $request): Model
    {
        $vacancy = Vacancy::find($request->vacancy_id);
        abort_if($vacancy === null, 404, 'Vacancy not found!');

        $user = auth('sanctum')->user();
        abort_if($user === null, 404, 'User not found!');

        return $this->handle($user, $vacancy, $request->validated());
    }

    public function jsonResponse(Application $application): ApplicationResource{
        return new ApplicationResource($application);
    }

    /**
     * @param UploadedFile $attachment
     * @param User $user
     * @param Model $application
     */
    private function uploadAttachedFile(UploadedFile $attachment, User $user, Model $application): void
    {
        $path = 'attachments/';
        $name = $attachment->getClientOriginalName();
        $mime = $attachment->getClientOriginalExtension();
        $path .= $attachment->store(sprintf('/%s/%s', $user->id, $application->id), 'attachments');
        $application->attachments()->create([
            'title' => $name,
            'description'=>null,
            'path' => $path,
            'type' => 'CV/Resume',
            'mime_type' => $mime
        ]);
    }
}

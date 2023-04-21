<?php

namespace App\Actions\Application;

use App\Enums\StatusModelTypeEnum;
use App\Models\Application;
use App\Models\Status;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
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

    public function handle(User $user, array $data): Model
    {
        return $user->applications()->create([
            'vacancy_id' => $data['vacancy_id'],
            'status_id' => Status::where([
                'name'=>'sent',
                'model_type' => StatusModelTypeEnum::APPLICATIONS->value])->first()->id
        ]);
    }

    public function asController(ActionRequest $request)
    {
        dd($request->all());
        $vacancy = Vacancy::find($request->vacancy_id);
        abort_if($vacancy === null, 404, 'Vacancy not found!');

        $user = User::find($request->user_id);
        abort_if($user === null, 404, 'User not found!');

        return $this->handle($user, $request->validated());
    }

    public function jsonResponse(Application $application){
        return $application;
    }
}

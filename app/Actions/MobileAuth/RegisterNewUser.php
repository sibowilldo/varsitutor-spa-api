<?php

namespace App\Actions\MobileAuth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Enums\InternalIdTypeEnum;
use App\Enums\StatusModelTypeEnum;
use App\Events\UserRegisteredEvent;
use App\Http\Resources\UserResource;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterNewUser
{
    use AsAction;
    use PasswordValidationRules;

    public function rules(): array
    {
        return [
            'internal_identification' => ['required', 'string', 'max:10', 'unique:users'],
            'password' => $this->passwordRules(),
            'device_name' => ['required'],
            'given_name' => ['required', 'string', 'max:255'],
            'family_name' => ['required', 'string', 'max:255'],
            'preferred_name' => ['string', 'max:255'],
            'contact_number' => ['string', 'max:15', 'unique:profiles'],
            'province_city' => ['string'],
        ];
    }

    public function asController(ActionRequest $request): User
    {
        return $this->handle($request->validated());
    }

    public function handle(array $input): User
    {
        DB::beginTransaction();
        $isStudent = str($input['internal_identification'])->length() >= 8;
        $user = User::create([
            'internal_identification' => $input['internal_identification'],
            'internal_identification_type' => $isStudent
                ? InternalIdTypeEnum::STUDENT->value
                : InternalIdTypeEnum::STAFF->value,
            'email' => $input['internal_identification'] . ($isStudent
                    ? '@dut4life.ac.za'
                    : '@dut.ac.za'),
            'status_id' => Status::where(['name' => 'inactive', 'model_type' => StatusModelTypeEnum::USERS->value])->first()->id,
            'password' => Hash::make($input['password']),
        ]);

        $user->profile()->create([
            'given_name' => $input['given_name'],
            'family_name' => $input['family_name'],
            'name' => $input['preferred_name']
                ?? sprintf('%s. %s', str($input['given_name'])->substr(0, 1), $input['family_name']),
            'contact_number' => $input['contact_number'],
            'province_city' => $input['province_city'],
        ]);
        DB::commit();

        UserRegisteredEvent::dispatch($user, $input);
        return $user;
    }

    public function jsonResponse(User $user, ActionRequest $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($user),
            'verified' => $user->email_verified_at !== null,
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ]);
    }
}

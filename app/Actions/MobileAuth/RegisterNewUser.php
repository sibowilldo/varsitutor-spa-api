<?php

namespace App\Actions\MobileAuth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Events\UserRegisteredEvent;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'device_name' => ['required'],
            'given_name' => ['required', 'string', 'max:255'],
            'family_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['string', 'max:15', 'unique:profiles'],
        ];
    }

    public function handle(array $input): User
    {
        $user = User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        UserRegisteredEvent::dispatch($user, $input);

        return $user;
    }

    public function asController(ActionRequest $request): User
    {
        return $this->handle($request->validated());
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

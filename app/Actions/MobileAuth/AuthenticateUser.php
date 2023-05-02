<?php

namespace App\Actions\MobileAuth;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class AuthenticateUser
{
    use AsAction;

    /**
     * @throws ValidationException
     */
    public function handle(array $data): User
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        // purge existing user tokens of the same device
        $user->tokens()->where('name', $data['device_name'])->delete();

        return $user;
    }

    public function rules(): array
    {
        return [
            'email' => ['required'],
            'password' => ['required'],
            'device_name' => ['required'],
        ];
    }

    public function asController(ActionRequest $request): User
    {
        return $this->handle($request->validated());
    }

    public function jsonResponse(User $user, ActionRequest $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ]);
    }
}

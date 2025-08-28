<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required|same:password|min:8',
        ], [
            'name.required' => 'Il nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.max' => 'Il nome non può superare i 255 caratteri.',
            'last_name.required' => 'Il cognome è obbligatorio.',
            'last_name.string' => 'Il cognome deve essere una stringa.',
            'last_name.max' => 'Il cognome non può superare i 255 caratteri.',

            'email.required' => 'L\'email è obbligatoria.',
            'email.email' => 'Inserisci una email valida.',
            'email.max' => 'L\'email non può superare i 255 caratteri.',
            'email.unique' => 'Questa email è già registrata.',

            'password.required' => 'La password è obbligatoria.',
            'password.min' => 'La password deve contenere almeno 8 caratteri.',
            'password.regex' => 'La password deve contenere almeno una lettera maiuscola, una minuscola, un numero e un carattere speciale.',

            'password_confirmation.required' => 'La conferma della password è obbligatoria.',
            'password_confirmation.same' => 'Le password non corrispondono.',
            'password_confirmation.min' => 'La password deve contenere almeno 8 caratteri.',
        ]);

        $validator->validate();

        return User::create([
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'role' => 'user',
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}

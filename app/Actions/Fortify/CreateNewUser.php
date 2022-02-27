<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'crv_number' =>['required', 'numeric', 'digits_between:8,8'],
            'address' =>['required', 'string', 'max:255'],
            'company' =>['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ],[
            'crv_number.digits_between'=>'CVR nummeret findes ikke...',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'company'=> $input['company'],
            'address'=> $input['address'],
            'crv_number'=> $input['crv_number'],
            'city'=> $input['city'],
        ]);


        \Mail::to('info@sortiment.dk')->send(new \App\Mail\AdminCompanyApproval($user));//
        return $user;
    }
}

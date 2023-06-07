<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Illuminate\Support\Facades\Auth;


class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;
    
    public $current_password;
    public $password;
    public $password_confirmation;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update()
    {
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ])->validateWithBag('updatePassword');

        // $user->forceFill([
        //     'password' => Hash::make($input['password']),
        // ])->save();

        if(Hash::check($this->current_password,Auth::user()->password)){

            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->password);
            $user->save();

            return back();
        }
        else{
            return back();
        }
        }
    }

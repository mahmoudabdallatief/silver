<?php

namespace App\Http\Controllers\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_en' => ['required', 'string','regex:/^[a-zA-Z0-9\s.,?!\'"]+$/', 'min:12',  'max:255'],
            'name_ar' => ['required', 'string','regex:/^[\x{0600}-\x{06FF}\s]+$/u' ,'min:12', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:password_confirmation'],
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
{
    $user = User::create([
        'name_ar' => $data['name_ar'],
        'name_en' => $data['name_en'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'roles_name' => ["user"],
    ]);

    foreach ($user->roles_name as $roleName) {
        $role = Role::where('name_en', $roleName)->first();
        if ($role) {
            $user->assignRole($role);
        }
    }

    return $user;
}

}

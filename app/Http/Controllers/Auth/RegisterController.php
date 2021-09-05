<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

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
    
    protected function register(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255','regex:/^\S*$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $new_db = substr($request['email'], 0, strpos($request['email'], '@'));
        $db_name = $new_db.rand(0,100);
        $user = User::create([
           'name' => $request['name'],
           'email' => $request['email'],
           'password' => Hash::make($request['password']),
           'db_name'=> $db_name
        ]);
        DB::connection('mysql')->statement(sprintf("CREATE DATABASE %s",$db_name));
        DB::connection('mysql')->statement(sprintf("use %s",$db_name));
        DB::connection('mysql')->statement("CREATE TABLE categories (
                 id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                 name VARCHAR(255))");

        DB::connection('mysql')->statement("CREATE TABLE products ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) , price VARCHAR(255), category_id INT(6) UNSIGNED, FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE)");
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);

        

    }
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'db_name'=> $data['email'].rand(0,99999999990)
        ]);
       
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Phone;
use DB;
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'family' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'min:11', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $user =  User::create([
            'username' => $this->generateUniqueCode(),
            'name' => $data['name'],
            'family' => $data['family'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $this->PhoneCreate($data['phone'],$user->id);
        return $user;
    }

    protected function PhoneCreate($phone,$user_id){

        if($phone = DB::table('phones')->where('phone',$phone)->first()){
            DB::table('phone_user')->insert(['user_id' => $user_id,'phone_id' => $phone->id]);
        }else{
            $phone = Phone::create(['phone' => $phone]);
            DB::table('phone_user')->insert(['user_id' => $user_id,'phone_id' => $phone->id]);
        }
    }

    public function generateUniqueCode()
    {
        do {
            $code = random_int(10000, 99999);
        } while (User::where("username", "=", $code)->first());

        return $code;
    }
}

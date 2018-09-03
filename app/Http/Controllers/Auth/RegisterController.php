<?php

namespace App\Http\Controllers\Auth;

use App\City;
use App\Doctor;
use App\Helpers\FormatHelper;
use App\Http\Controllers\Controller;
use App\Rules\PhoneNumber;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = '/user/profile';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->where('email_confirmed', 1)],
            'phone' => ['required', new PhoneNumber, Rule::unique('users')->where('phone_verified', 1)],
            'password' => 'required|string|min:6|confirmed',
            'role' =>'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $role = $data['role']==0?0:20;

       $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => FormatHelper::phone($data['phone']),
            'city' => $data['city'],
            'role' => $role,
            'password' => bcrypt($data['password']),
        ]);

        if(!empty($user->phone) && $user->role == 20){

            $doctor = $this->ifDoctorExist($user->phone);

            if($doctor){
                $this->setDoctorUser($doctor, $user);
            }else{
                $this->createDoctor($user);
            }
        }

        return $user;
    }

    public function registerUser(Request $request)
    {
        if ($phone = $request->get('phone', false))
            $request->request->set('phone', preg_replace("/[^0-9]/", '', $phone));

        return $this->register($request);
    }


    public function showRegistrationForm()
    {
        $cities = City::query()->orderBy('name')->get();
        return view('auth.register', compact('cities'));
    }

    protected function ifDoctorExist($phone){
        $doctor = Doctor::where('phone', $phone)->first();

        return $doctor;
    }

    protected function setDoctorUser($doctor, $user){
        $doctor->user_id = $user->id;
        $doctor->update();
    }

    protected function createDoctor($user){
        $doctor = new Doctor();
        $doctor->firstname = $user->name;
        $doctor->lastname = $user->lastname;
        $doctor->city_id = $user->city_id;
        $doctor->phone = $user->phone;
        $doctor->user_id = $user->id;
        $doctor->save();
    }

}

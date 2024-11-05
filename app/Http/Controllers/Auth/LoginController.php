<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\Presets\JsonResponsePresets;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $input = $request->only(['username', 'password']);

         $username = $input['username'];
         $password = $input['password'];
         //$remember = $input['remember'];
         $status = 1;


        $user = User::select('id','name','email','status','zoom_login','call_review')
            ->where('username',  $username)
            ->where('pwd',  $password)
            ->where('status','=',1)
            ->first();
        
       if(!empty($user)) {
               
            session(['id' => $user->id,'name' => $user->name,'user_id' => $user->id, 'user_name' => $user->name, 'user_email' => $user->email,'call_review'=>$user->call_review , 'zoom_login'=>$user->zoom_login]);
            auth()->login($user, isset($input['remember']) ? $input['remember'] : false);

         return redirect('create-quote');

       }else{
          return redirect('/login')->with('message', 'Whoops! invalid email and password');
       }
        
        
       
    }

    protected function getValidator(array $data, $treatUsernameAsEmail = false)
    {
        $usernameMessages = [
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at-least :min characters.',
            'username.max' => 'Username must not exceed :max characters.',
            'username.unique' => 'Username is in use by another account.',
            'username.regex' => 'Username must only contain letters and digits.',
        ];

        $emailMessages = [
            'email.required' => 'Email is required.',
            'email.max' => 'Email must not exceed :max characters.',
            'email.unique' => 'Email is in use by another account.',
            'email.email' => 'Email must be in a valid format. e.g. name@domain.com',
        ];

        $messages = [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at-least :min characters.',
            'password.max' => 'Password must not exceed :max characters.',
        ];

        $messages = $treatUsernameAsEmail ? array_merge($emailMessages, $messages) : array_merge($usernameMessages, $messages);

        $usernameValidationRules = ['username' => 'required|min:1|max:16|regex:/^[A-Za-z0-9]+$/'];
        $emailValidationRules = ['email' => 'required|email|max:255'];
        $passwordValidationRules = ['password' => 'required|min:1|max:64'];

        $rules = array_merge($treatUsernameAsEmail ? $emailValidationRules : $usernameValidationRules, $passwordValidationRules);

        /** @noinspection PhpUndefinedClassInspection */
        return \Validator::make($data, $rules, $messages);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    
         //return redirect()->intended(url('/login'));
         return redirect()->intended(url('/'));
    }
}

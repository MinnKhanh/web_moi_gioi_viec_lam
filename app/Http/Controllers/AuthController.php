<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Events\CustomerOrder;
use App\Http\Requests\Auth\RegisteringRequest;
use App\Models\moi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
    public function signin(Request $request)
    {

        //   dd($password);
        // dd(DB::table('users')->where('password',$password)->get());
        //  dd($request->input('password'));
        // $user = User::where('email', $request->input('email'))->first();
        // Auth::login($user);


        // dd($user, Auth::guard('toi')->check());
        // if (Auth::check()) {
        //   event(new CustomerOrder($user));
        //  $user->givePermissionTo('edit articles');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/'); //->route('admin.index')->with('status', 'Dang nhap thanh cong');
        }

        //}
        //  return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        // $email=$request->email;
        // $user=new User();
        // $user->email=$email;
        // $user->password=$password;
        // if (Auth::attempt($user)) {
        //     return redirect('/');
        // } else {
        //     return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        // }


    }
    public function callback($provider): RedirectResponse
    {


        $data = Socialite::driver($provider)->user();

        $user = User::query()
            ->where('email', $data->getEmail())
            ->first();
        $checkExist = true;

        if (is_null($user)) {
            $user        = new User();
            $user->email = $data->getEmail();
            $checkExist  = false;
        }

        $user->name   = $data->getName();
        $user->avatar = $data->getAvatar();
        $user->role   = UserRoleEnum::ADMIN;
        $user->save();

        $role = strtolower(UserRoleEnum::getKeys($user->role)[0]);
        Auth::guard($role)->login($user, true);

        if ($checkExist) {
            return redirect()->route("$role.welcome");
        }

        return redirect()->route('register');
    }

    public function registering(RegisteringRequest $request)
    {
        $password = Hash::make($request->password);
        $role     = 1;

        if (auth()->check()) {
            User::where('id', auth()->user()->id)
                ->update([
                    'password' => $password,
                    'role'     => $role,
                ]);
        } else {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $password,
                'role'     => 1,
            ]);

            Auth::login($user);
        }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }
}

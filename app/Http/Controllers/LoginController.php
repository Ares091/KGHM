<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view(view: 'auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'u_login'=> 'required|string|max:255|exists:t_a_users',
            'u_password'=> 'required|string|min:8',

        ]);

        $credentials = [
            'u_login'  => $data['u_login'],
            'u_password' => $data['u_password'],
        ];

        $remember = true;

        if (Auth::attempt($credentials, $remember)){
            $user = Auth::user();
            $request->session()->regenerate();

            // Получаем ID текущей сессии
            $currentSessionId = Session::getId();

            // Сохраняем ID сессии в БД
            $user->updateSessionId($currentSessionId);

            // return redirect()->intended('profile');
            return match ($user->u_role) {
               'user' => redirect()->route('index'),
               'director' => redirect()->route('directorPage'),
               'admin' => redirect()->route('adminPage'),
            };
        }
        else {
            Log::info('Пользователь ввел неверные данные в логине', [$data]);
        }
        
        return back()->withErrors(['u_login' => 'неверные учетные данные']);
    }


    public function loginDynamicValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_login'    => 'required|string|exists:t_a_users',
            'u_password' => 'required|string|min:8',
        ], [
            'u_login.required'    => 'Введите логин.',
            'u_login.exists'      => 'Пользователь с таким логином не найден.',
            'u_password.required' => 'Введите пароль.',
            'u_password.min'      => 'Пароль должен содержать минимум 8 символов.',
        ]);

        $remember = $request->boolean('remember');
        // $remember = $request->input('remember');
        Log::info('remember в логине', [$remember]);


        // Ошибки валидации входных данных
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(), // { field: [messages] }
            ], 422);
        }

        $credentials = [
            'u_login'  => $request->input('u_login'),
            'password' => $request->input('u_password'), // Laravel внутренне ожидает именно 'password'
        ];

        // $remember = $request->has('remember');

        // if (!Auth::attempt($credentials, $remember)) {
            
        // }

        $request->session()->regenerate();

        if (Auth::attempt($credentials, $remember)){
            $user = Auth::user();
            $userIp = $request->ip(); 
            $computerName = gethostbyaddr($userIp);

            // Получаем ID текущей сессии
            $currentSessionId = Session::getId();

            // Сохраняем ID сессии в БД
            $user->updateSessionId($currentSessionId);

            $user->update([
                'u_ad_pc_name' => $computerName
            ]);

            // Log::info('Пользователь авторизовался с пк', [$user->u_login, $computerName]);

            // return redirect()->intended('profile');
            $redirect = match ($user->u_role) {
            'user' => route('index'),
            'director' => route('directorPage'),
            'admin' => route('adminPage'),
            };

            return response()->json([
                'success'  => true,
                'redirect' => $redirect,
                'message'  => 'Вы авторизованы успешно!',
            ]);
        }
        else {
            // Не подошёл пароль (логин уже проверен через exists)
            return response()->json([
                'success' => false,
                'errors'  => [
                    'u_password' => ['Неверный пароль.'],
                ],
            ], 422);
        }
        

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }


    public function showRegisterForm()
    {
        // return view('auth.register');
        return view('components/popup/popup_register')->render();
    }


    public function register(Request $request)
    {
        $data = $request->validate([
            'u_login'=> 'required|string|max:255|unique:t_a_users',
            'u_email'=> 'required|email|max:255|unique:t_a_users,u_email',
            'u_password'=> 'required|string|min:6',
        ]);

        $data['u_password'] = Hash::make($data['u_password']);
        $data['u_role'] = 'admin';

        // Создание пользователя
        User::create($data);

        // Log::info('В регистрацию были внесены следующие данные', [$data]);

        // $User = Song::create([
        //     'artist' => $validatedData['artist'],
        //     'second_artists' => $validatedData['second_artists'],
        //     'song_name' => $validatedData['song_name'],
        //     'song_subtext' => $validatedData['song_subtext'],
        //     'song_duration' => $validatedData['song_duration'],
        //     'song_desc' => $validatedData['song_desc'],
        //     'song_lyrics' => $validatedData['song_lyrics'],
            
        //     'song_src' => "../audio/". $validatedData['song_src'] .".mp3",
            
        //     'status' =>  'published',
        // ]);

        return redirect()->route('index')->withErrors('status',  'Регистрация прошла успешно');

    }


    public function AddUserDynamicPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_login'=> 'required|string|max:255|unique:t_a_users',
            'u_email'=> 'required|email|max:255|unique:t_a_users,u_email',
            'u_password' => 'required|string|min:8',
        ], [
            'u_login.required'    => 'Введите логин.',
            'u_login.exists'      => 'Пользователь с таким логином не найден.',
            'u_email.exists'      => 'Введите эл. почту',
            'u_email.email'      => 'Эл. почта должна быть правильно написана',
            'u_password.required' => 'Введите пароль.',
            'u_password.min'      => 'Пароль должен содержать минимум 8 символов.',
        ]);

        // Ошибки валидации входных данных
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(), // { field: [messages] }
            ]);
        }


        User::create([
            'u_login' => $request->u_login,
            'u_email' => $request->u_email,
            'u_password' =>  Hash::make($request->u_password),
            'u_role' => 'admin'
        ]);

        return response()->json([
            'success'  => true,
            'message'  => 'Учетная запись пользователя содана успешно!',
        ]);

    }


    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'u_login' => 'string|max:255',
            'u_email' => 'string|max:255|u_email|unique:users,u_email' . Auth::id(),

        ]);
        $user = Auth::user();
        // $user-> ($user instanceof User) && $user->update($data);
        $user->update($data);


        return redirect()->route('profile');
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }
    
    public function ChangePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($data['current_password'], $user->password)){
            return back()->withErrors(['current_password' => 'Текущий пароль неверен']);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return redirect()->route('profile')->with('status', 'Пароль изменен успешно');
    }

}

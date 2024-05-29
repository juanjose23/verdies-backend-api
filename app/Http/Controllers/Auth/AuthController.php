<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{

    //Login
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }


        if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
            // Obtener información del usuario autenticado
            $user = Auth::user();

            // Devolver la información del usuario en la respuesta
            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60 // Tiempo de expiración del token en segundos
            ]);
        } else {
            // El usuario no está autenticado o su correo electrónico no está verificado
            return response()->json(['error' => 'El usuario no está autenticado o su correo electrónico no está verificado'], 401);
        }

    }

    //Register
    public function register(StoreRegister $request)
    {
        try {
            $validated = $request->validated();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->sendEmailVerificationNotification();


            return response()->json([
                'Estado' => 'usuario creado',
                'usuario' => $user,
                'mensaje' => 'Se ha creado la cuenta exitosamente. Por favor, verifica tu correo electrónico para completar el proceso de registro.',
            ], 200);
        } catch (ValidationException $e) {
            Log::error($e->getMessage());

            return response()->json(['errors' => $e->validator->errors()], 422);
        }

    }

    //Verficacion de correos
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['error' => 'Enlace de verificación inválido'], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Correo electrónico ya verificado'], 200);
        }

        $user->markEmailAsVerified();

        return response()->json(['message' => 'Correo electrónico verificado exitosamente'], 200);

    }

    //
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink([
            'email' => $request->email
        ]);

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Correo electrónico de restablecimiento de contraseña enviado'])
            : response()->json(['error' => 'No se pudo enviar el correo electrónico de restablecimiento de contraseña'], 500);
    }
    public function reset(Request $request)
    {
        
    }
    public function showResetForm($token)
    {
        return response()->json(['token' => $token]);
    }

    public function resetPassword(ForgetPasswordRequest $request)
    {
      
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );
    
        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Contraseña restablecida con éxito'],200);
        } else {
            return response()->json(['error' => 'No se pudo restablecer la contraseña'], 500);
        }
    }


    //Logout
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cerrar sesión', 'message' => $e->getMessage()], 500);
        }

    }
}

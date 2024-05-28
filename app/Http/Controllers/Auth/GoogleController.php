<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        
        return Socialite::driver('google')->with(['prompt' => 'consent'])->stateless()->redirect();
    }

    public function handleGoogleCallback(): JsonResponse
    {
        try {
            $client = new Client();

            // Configura los datos para el intercambio de código por token
            $response = $client->post('https://oauth2.googleapis.com/token', [
                'form_params' => [
                    'code' => request('code'),
                    'client_id' => env('GOOGLE_CLIENT_ID'),
                    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                    'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
                    'grant_type' => 'authorization_code',
                ],
            ]);

            $body = json_decode((string) $response->getBody(), true);

            // Usa el token de acceso para obtener la información del usuario
            $userResponse = $client->get('https://www.googleapis.com/oauth2/v1/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $body['access_token'],
                ],
            ]);

            $googleUser = json_decode((string) $userResponse->getBody(), true);

            // Extrae los datos necesarios
            $googleId = $googleUser['id'];
            $googleName = $googleUser['name'];
            $googleEmail = $googleUser['email'];
            $googleProfile=$googleUser['picture'];
            // Busca un usuario con el mismo provider y provider_id
            $user = User::where('provider', 'google')
                ->where('provider_id', $googleId)
                ->first();

            // Si no se encuentra un usuario, crea uno nuevo
            if (!$user) {
                $user = new User();
                $user->provider = 'google';
                $user->provider_id = $googleId;
            }

            // Actualiza o establece los otros campos
            $user->name = $googleName;
            $user->email = $googleEmail;

            // Solo establece una nueva contraseña si no se estableció antes
            if (!$user->password) {
                $user->password = bcrypt(Str::random(24));
            }

            // Guarda el usuario
            $user->save();


            Auth::login($user, true);
            $token = JWTAuth::fromUser($user);

            // Devuelve los datos del usuario junto con el token en una respuesta JSON
            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60 // Tiempo de expiración del token en segundos
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Captura el error específico de Guzzle y muestra los detalles
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return response()->json(['error' => 'Failed to authenticate with Google', 'details' => $responseBodyAsString], 500);
        } catch (\Exception $e) {
            // Captura cualquier otro tipo de error y muestra los detalles
            return response()->json(['error' => 'Failed to authenticate with Google', 'message' => $e->getMessage()], 500);
        }
    }
}

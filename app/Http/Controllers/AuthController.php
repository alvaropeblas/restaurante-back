<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'apellidos' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'apellidos' => $request->apellidos,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * La función anterior es un fragmento de código PHP que maneja la funcionalidad de inicio de sesión
     * del usuario, incluida la validación, autenticación y generación de un token API para el usuario
     * que inició sesión.
     * 
     * @param request El parámetro  es una instancia de la clase Request, que representa una
     * solicitud HTTP. Contiene información sobre la solicitud, como el método de solicitud, encabezados
     * y datos de entrada.
     * 
     * @return  response JSON. Si la validación falla, devuelve una respuesta JSON con un estado
     * falso, un mensaje de "error de validación" y los errores de validación. Si el intento de
     * autenticación falla, devuelve una respuesta JSON con un estado falso y un mensaje de "El correo
     * electrónico y la contraseña no coinciden con nuestro registro". Si la autenticación es exitosa,
     * devuelve una respuesta JSON con un
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API_TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * La función `getUserById` recupera un usuario por su ID y devuelve una respuesta JSON con la
     * información del usuario si se encuentra, o un mensaje de error si no se encuentra o se produce
     * una excepción.
     * 
     * @return una respuesta JSON. Si se encuentra al usuario, devuelve una respuesta JSON con un estado
     * de verdadero y el objeto de usuario. Si no se encuentra el usuario, devuelve una respuesta JSON
     * con un estado falso y un mensaje que indica que no se encontró el usuario. Si ocurre una
     * excepción, devuelve una respuesta JSON con un estado falso y el mensaje de error.
     */
    public function getUserById()
    {
        try {
            $userId = Auth::id();

            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Usuario no encontrado',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'user' => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @brief Función de ejemplo
     *
     * Descripción más detallada de la función.
     *
     * @param int $parametro1 Descripción del primer parámetro.
     * @param string $parametro2 Descripción del segundo parámetro.
     * @return bool Descripción del valor de retorno.
     */
    function ejemploFuncion($parametro1, $parametro2)
    {
        // Código de la función
        return true;
    }
}

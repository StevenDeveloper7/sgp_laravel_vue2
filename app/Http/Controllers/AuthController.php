<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Usuario;
use App\Negocio;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {

        //return $request;


        $validar_correo = Usuario::where('email', '=', $request->email)->first();



        if( !empty($validar_correo) ){

            return response()->json(['error' => 'El correo ya se encuentra registrado',
                                 'code' => 1 ], 401);
        }


        $v = Validator::make($request->all(), [
            'nombre_completo' => 'required|min:3',
            'email' => 'required|email|',
            'password'  => 'required|min:3|confirmed',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }



        $user = new Usuario();


        if( $request->id_role == 1){

            $negocio = new Negocio();


            //crear usuario
            $user->id_tipo_documento = $request->id_tipo_documento;
            $user->numero_documento = $request->numero_documento;
            $user->nombre_completo = $request->nombre_completo;
            $user->id_ciudad = $request->id_ciudad;
            $user->telefono = $request->telefono;
            $user->id_estado = 1;
            $user->id_role = $request->id_role;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->foto = 'admin.png';

            $user->save();


            //crear negocio

            $id_usuario = $user->id;

            $negocio->id_usuario = $user->id;
            $negocio->nit = $request->numero_documento;
            $negocio->nombre_completo = $request->razon_social;
            $negocio->direccion = $request->direccion;
            $negocio->telefono = $request->telefono;
            $user->id_ciudad = $request->id_ciudad;
            $negocio->descripcion = $request->descripcion;
            $negocio->id_categoria = $request->id_categoria;
            $negocio->long = $request->long;
            $negocio->lat = $request->lat;
            $negocio->canal = $id_usuario.$negocio->id;
            $negocio->hora_apertura = $request->hora_apertura;
            $negocio->hora_cierre = $request->hora_cierre;
            $negocio->descripcion = $request->descripcion;
            $negocio->foto = 'logo-traelo-ve.png';

            $negocio->save();

            return response()->json([
                'status' => 'Muy bien!',
                'msg' => 'Usuario y negocio creados',
                'code' => 1
            ],201);


        }




        $user->nombre_completo = $request->nombre_completo;
        $user->telefono = $request->telefono;
        $user->id_ciudad = $request->id_ciudad;
        $user->direccion = $request->direccion;
        $user->id_estado = 1;
        $user->id_role = $request->id_role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->foto = 'avatar.png';

        $user->save();

        return response()->json([
            'status' => 'Muy bien!',
            'msg' => 'Usuario creado',
            'code' => 1
        ],201);



       // return response()->json(['status' => 'success'], 200);


}


    /**
     * Login user and return a token
     */
    public function login(Request $request)
    {


        $validar_correo = Usuario::where('email', '=', $request->email)->first();

        $validar_datos = Usuario::where('email', '=', $request->email)->get();



        if( empty($validar_correo) ){

            return response()->json(['error' => 'El usuario no existe',
                                 'code' => 1 ], 401);
        }


        //$usuario = new AuthController;

        //$mostrar_user = $usuario->user();

        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials) ) {
            return response()->json(['status' => 'success',
                                     'token' => $token,
                                      'user' => Auth::user()], 200)

                            ->header('Authorization', $token);
        }

        return response()->json(['error' => 'login_error por favor revise sus credenciales',
                                 'code' => 2 ], 401);

    }
    /**
     * Logout User
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {

        $user = Usuario::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function user_movil(Request $request)
    {

        $user = Auth::user();

        return $user;
    }
    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}

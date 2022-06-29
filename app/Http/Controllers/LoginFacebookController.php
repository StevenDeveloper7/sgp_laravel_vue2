<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Usuario;
use Auth;

class LoginFacebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    public function login(Request $request)
    {

        $validar_usuario = Usuario::where('email', '=', $request->email)->first();


        if( !empty($validar_usuario) ){

            //si existe

            if( $validar_usuario->id_estado == 2 ){

                $credentials = $request->only('email', 'password');
                if ($token = $this->guard()->attempt($credentials) )
                return response()->json(['status' => 'success',
                                        'token' => $token,
                                        'user' => Auth::user(),
                                        'redirect' => 'config'
                                                            ], 200)

                                ->header('Authorization', $token);


            }

                $credentials = $request->only('email', 'password');
            if ($token = $this->guard()->attempt($credentials) ) {
                return response()->json(['status' => 'success',
                                        'token' => $token,
                                        'user' => Auth::user(),
                                        'redirect' => 'home',
                                                        ], 200)

                                ->header('Authorization', $token);
            }

        }else{

            $user = new Usuario();

            $user->nombre_completo = $request->name;
            $user->id_estado = 2;
            $user->id_role = 2;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->foto = 'avatar.png';

            $user->save();


            $credentials = $request->only('email', 'password');
            if ($token = $this->guard()->attempt($credentials) ) {
                return response()->json(['status' => 'success',
                                        'token' => $token,
                                        'user' => Auth::user(),
                                        'redirect' => 'config'
                                                            ], 200)

                                ->header('Authorization', $token);
                }

            }


    }

    public function user(Request $request)
    {

        $user = Usuario::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipo_documento  $tipo_documento
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipo_documento  $tipo_documento
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipo_documento  $tipo_documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipo_documento  $tipo_documento
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}

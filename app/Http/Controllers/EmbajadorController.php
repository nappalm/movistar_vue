<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Session;
use App\UsuarioPermisos;

class EmbajadorController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'embajador';

    function __construct(){
        $this->middleware('auth:embajador', ['only' => ['index']]);
    }

    public function authenticated(Request $request){
        /**
         * Autentificacion de usuarios embajador:
         * 
         */
        
        if (Auth::guard('embajador')->attempt(['email' => $request->email, 'password' => $request->password])) {

            //Session storage ::
            $user = Auth::guard('embajador')->user();
            Session::put(
            array(
                'usuario'   =>  $user,
                'canal'     =>  $this->canal($user->canal),
                'permisos'  =>  $this->permisos($user->id)
                )
            );

            return redirect('embajador');
        }else{
            return redirect('/login');
        }
    }

    protected function canal($select){
        $canal = null;
        /**
         * Regresa el canal en que se encuentra
         */
        if($this->canales_propios($select)){
            $select = 'Propio';
        }elseif($this->canales_modernos($select)){
            $select = 'Moderno';
        }elseif($this->canales_especializado($select)){
            $select = 'Especializado';
        }else{
            $select = 'Propio';
        }

        switch($select){
            case 'Moderno':         $canal = array('src_value' => 'img/menu/icon_canal_moderno.png', 'background_value' => 'Moderno', 'type' => 'Moderno'); break;
            case 'Propio':          $canal = array('src_value' => 'img/menu/icon_canal_propio.png', 'background_value' => 'Propio', 'type' => 'Propio'); break;
            case 'Especializado':   $canal = array('src_value' => 'img/menu/icon_canal_especialista.png', 'background_value' => 'Especialista', 'type' => 'Especializado'); break;
            
            default:                $canal = array('src_value' => 'img/menu/icon_canal_propio.png', 'background_value' => 'Propio', 'type' => 'Propio'); break;
        }
        return $canal;
    }

    protected function permisos($usuario_id){
        $permisos = UsuarioPermisos::select('secciones')
        ->where('usuario_id',$usuario_id)->first();
        if($permisos != null){
            $seccion = explode(",", $permisos->secciones);
        }else{
            $seccion = array('Ningun Permiso Authorizado');
        }
        
        return $seccion;
    }

    protected function canales_propios($value){
        $data = array(
            "CANAL PROPIO",
            "Propio",
            "CanalPropio",
        );

        return in_array($value, $data);
    
    }

    protected function canales_modernos($value){
        $data = array(
            "Canal Moderno",
            "Moderno",
        );

        return in_array($value, $data);
    }

    protected function canales_especializado($value){
        $data = array(
            "Canal Especializado",
            "ESPECIALIZADO",
            "EspecialistaPdv",
            "EspecialistaMovil",
            "ESPECIALISTA PDV",
            "ESPECIALISTA MOVIL",
            "Especialista",
        );

        return in_array($value, $data);
    }


    public function index(){
        return view('home');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Session;
use App\UsuarioPermisos;

class ExpertoController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'experto';

    function __construct(){
        $this->middleware('auth:experto', ['only' => ['index']]);
    }

    public function authenticated(Request $request){
        /**
         * Autentificacion de usuarios experto:
         * 
         */

        $attemp = Auth::guard('experto')->attempt(
            array(
                'id_pdv' => $request->get('id_pdv'),
                'email' => $request->get('email'), 
                'password' => $request->get('password'),
            )); 
            
        if($attemp && !empty($attemp)){
            $user = Auth::guard('experto')->user();
            Session::put(
                array(
                    'usuario'   =>  $user,
                    'canal'     =>  $this->canal($user->canal),
                    'permisos'  =>  $this->permisos($user->id)
                    )
                );
                
                return redirect('experto');
        }else{
            Auth::logout();
            Session::flush();
            return redirect('/login')->with('error', 'Datos de acceso incorrectos.');
        }

    }

    protected function permisos($usuario_id){
        // $permisos = UsuarioPermisos::select('usuario_id,secciones')
        // ->where('usuario_id',$usuario_id)->first();
        // $seccion = explode(",", $permisos->secciones);

        $seccion = array('Ningun Permiso en este tipo de cuenta');
        return $seccion;
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

    /** 
     * @category Categorizar canales.
     * Veriricaciones de multiples canales para definir.
    */

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

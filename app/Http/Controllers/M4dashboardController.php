<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Flash;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

include 'funciones.php';



class M4dashboardController extends AppBaseController
{



//     _           _     _                         _ 
//     | |         | |   | |                       | |
//   __| | __ _ ___| |__ | |__   ___   __ _ _ __ __| |
//  / _` |/ _` / __| '_ \| '_ \ / _ \ / _` | '__/ _` |
// | (_| | (_| \__ \ | | | |_) | (_) | (_| | | | (_| |
//  \__,_|\__,_|___/_| |_|_.__/ \___/ \__,_|_|  \__,_|    DEL USUARIO 
                                                   
                                                   
    // BUSCAR COMO CTRL + F "ON DASHBOARD"

    public function dashboard(  $usuario_name=NULL)   // Menu Principal  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

        if( isset($usuario_name))
        {
            $usuario_name = $usuario_name;
        }
        else
        {
            $usuario_name = Auth::user()->name;
        }
        
 
        $usuario = Usuario::where('nombre_usuario', $usuario_name )->first( ); 
 
        if( empty( $usuario))
        {
            Flash::success('No hay información del usuario solicitado');
            // return view('historialoperaciones.dashboard_error');
        }
 
        //SECTOR
        $sexo = 'M';

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.dashboard', [

        'plantaTotal' => $plantaTotal,        
        'sexo'=> $sexo ,
        'usuario_name'=> $usuario_name,                   
        ]); 
    }    




 
                                                   
 

    public function planta( )   // Menu Principal  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

        if( isset($usuario_name))
        {
            $usuario_name = $usuario_name;
        }
        else
        {
            $usuario_name = Auth::user()->name;
        }
        
 
        $usuario = Usuario::where('nombre_usuario', $usuario_name )->first( ); 
 
        if( empty( $usuario))
        {
            Flash::success('No hay información del usuario solicitado');
            // return view('historialoperaciones.dashboard_error');
        }
 
        //SECTOR
        $sexo = 'M';

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.planta', [

        'plantaTotal' => $plantaTotal,        
        'sexo'=> $sexo ,
        'usuario_name'=> $usuario_name,                   
        ]); 
    }    


    public function jubilaciones( )  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

        if( isset($usuario_name))
        {
            $usuario_name = $usuario_name;
        }
        else
        {
            $usuario_name = Auth::user()->name;
        }
        
 
        $usuario = Usuario::where('nombre_usuario', $usuario_name )->first( ); 
 
        if( empty( $usuario))
        {
            Flash::success('No hay información del usuario solicitado');
            // return view('historialoperaciones.dashboard_error');
        }
 
        //SECTOR
        $sexo = 'M';

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.jubilaciones', [

        'plantaTotal' => $plantaTotal,        
        'sexo'=> $sexo ,
        'usuario_name'=> $usuario_name,                   
        ]); 
    }    



    public function ausentismo( )  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

        if( isset($usuario_name))
        {
            $usuario_name = $usuario_name;
        }
        else
        {
            $usuario_name = Auth::user()->name;
        }
        
 
        $usuario = Usuario::where('nombre_usuario', $usuario_name )->first( ); 
 
        if( empty( $usuario))
        {
            Flash::success('No hay información del usuario solicitado');
            // return view('historialoperaciones.dashboard_error');
        }
 
        //SECTOR
        $sexo = 'M';

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.ausentismo', [

        'plantaTotal' => $plantaTotal,        
        'sexo'=> $sexo ,
        'usuario_name'=> $usuario_name,                   
        ]); 
    }    



    public function sindicatos( )  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

        if( isset($usuario_name))
        {
            $usuario_name = $usuario_name;
        }
        else
        {
            $usuario_name = Auth::user()->name;
        }
        
 
        $usuario = Usuario::where('nombre_usuario', $usuario_name )->first( ); 
 
        if( empty( $usuario))
        {
            Flash::success('No hay información del usuario solicitado');
            // return view('historialoperaciones.dashboard_error');
        }
 
        //SECTOR
        $sexo = 'M';

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.sindicatos', [

        'plantaTotal' => $plantaTotal,        
        'sexo'=> $sexo ,
        'usuario_name'=> $usuario_name,                   
        ]); 
    }    

    public function licencias( )  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

        if( isset($usuario_name))
        {
            $usuario_name = $usuario_name;
        }
        else
        {
            $usuario_name = Auth::user()->name;
        }
        
 
        $usuario = Usuario::where('nombre_usuario', $usuario_name )->first( ); 
 
        if( empty( $usuario))
        {
            Flash::success('No hay información del usuario solicitado');
            // return view('historialoperaciones.dashboard_error');
        }
 
        //SECTOR
        $sexo = 'M';

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.licencias', [

        'plantaTotal' => $plantaTotal,        
        'sexo'=> $sexo ,
        'usuario_name'=> $usuario_name,                   
        ]); 
    }    








    public function genero(  ) 
    {

    // $cSelect = 
    // "SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario = '".$usuario."' AND  YEAR( estadias.fecha_desde ) = 2022  group by usuario
    // UNION
    //   SELECT COUNT(*)  AS tareas , 'Resto' AS Usuario FROM estadias WHERE usuario IN    
    //  ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )     
    //  AND  YEAR( estadias.fecha_desde ) = 2022 AND usuario <> '".$usuario."' GROUP BY 'Resto'" ; //Ahora hago la recorrida al reves

     $cSelect = "SELECT COUNT(*) AS cantidad, genero
 FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307' 
GROUP BY genero" ;


    $genero = DB::select(DB::raw($cSelect));  



      
                         
                         
     return response()->json($genero);

    }



    public function uor(  ) 
    {
     $cSelect = "SELECT ETIQUETA  as uor,EMPLEADOS as cantidad  FROM
     (SELECT lqhislegpuerca,lqhislegpuerju, COUNT(DISTINCT cuil) AS EMPLEADOS FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307'  GROUP BY lqhislegpuerca,lqhislegpuerju) AS total
     INNER JOIN INSTITUCIONES ON total.lqhislegpuerca=caracter AND total.lqhislegpuerju=jurisdiccion GROUP BY ETIQUETA, EMPLEADOS;
     " ;

    $planta = DB::select(DB::raw($cSelect));  

    //dd( $planta ) ;
     return response()->json($planta);

    }


   

    public function uor_explode( $uor ) 
    {
     $cSelect = "SELECT uni_org_desc as uor,EMPLEADOS  as cantidad FROM
     (SELECT lqhislegpuerca,lqhislegpuerju,lqhislegpueruo, COUNT(DISTINCT cuil) AS empleados FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307'  GROUP BY lqhislegpuerca,lqhislegpuerju,lqhislegpueruo) AS total
     INNER JOIN INSTITUCIONES ON total.lqhislegpuerca=caracter AND total.lqhislegpuerju=jurisdiccion AND total.lqhislegpueruo=unidar_org
     WHERE ETIQUETA='$uor' GROUP BY ETIQUETA, JUR_DESCRIP,unidar_org,uni_org_desc,EMPLEADOS" ;

    $planta = DB::select(DB::raw($cSelect));  

    //dd( $planta ) ;
     return response()->json($planta);

    }    



    public function generoxv(  ) 
    {

     $cSelect = "SELECT COUNT(*) AS value, genero as x
     FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307' 
     GROUP BY genero" ;

    $genero = DB::select(DB::raw($cSelect));  
                         
     return response()->json($genero);

    }



}


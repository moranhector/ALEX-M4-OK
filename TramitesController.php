<?php

echo "hola";
die();

return;


App::uses('AppController', 'Controller','Xml','CakeTime', 'Utility');

/**
 * TramitesController
 *
 *
 *
 */
class TramitesController extends AppController {
    // http://cdrws.mendoza.gov.ar/cdrprd/servlet/
    //  URL DE PRODUCCIÓN
    private $awscdr001checkPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr001check";
    private $awscdr001aPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr001a";
    private $awscdr001bPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr001b";
    private $awscdr002aPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr002a";
    private $awscdr003aPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr003a";
    private $awscdr003bPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr003b";
    private $awscdr003checkPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr003check";
    private $awscdr004PRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr004";
    private $awscdr005PRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr005";
    private $awscdr006aPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr006a";
    private $awscdr006bPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr006b";
    private $awscdr006cPRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr006c";
    private $awscdr007PRD = "http://cdrws.mendoza.gov.ar/cdrprd/servlet/awscdr007";
    private $awsregistitulosPRD = "http://samepws.mendoza.gov.ar/samepev1/servlet/awsregistitulos";
    private $awsprovdeplocPRD = "http://samepws.mendoza.gov.ar/samepev1/servlet/awsprovdeploc";


    public function beforeFilter() {
        parent::beforeFilter();
        
    }

    public function getUrl(){
        if ($this->request->is(array('post', 'ajax'))) {
            $this->autoRender = false;
            $this->layout = false;

            $i = 1;
            $url[$i]['url'] = $this->awscdr001aPRD;
            $url[$i]['url_link'] = "awscdr001a";
            $url[$i]['descripcion'] = "Lista los Turnos / Trámites disponibles";

            $i++;
            $url[$i]['url'] = $this->awscdr001bPRD;
            $url[$i]['url_link'] = "awscdr001b";
            $url[$i]['descripcion'] = "Lista los Organismos y Oficinas";

            $i++;
            $url[$i]['url'] = $this->awsregistitulosPRD;
            $url[$i]['url_link'] = "awsregistitulos";
            $url[$i]['descripcion'] = "Lista los Registros y Títulos";

            $i++;
            $url[$i]['url'] = $this->awsprovdeplocPRD;
            $url[$i]['url_link'] = "awsprovdeploc";
            $url[$i]['descripcion'] = "Lista las Provincias, Departamentos y Localidades";

            $i++;
            $url[$i]['url'] = $this->awscdr001checkPRD;
            $url[$i]['url_link'] = "awscdr001check";
            $url[$i]['descripcion'] = "Verifica la Existencia de un Trámite previo";

            $i++;
            $url[$i]['url'] = $this->awscdr002aPRD;
            $url[$i]['url_link'] = "awscdr002a";
            $url[$i]['descripcion'] = "Lista los Primeros Turnos Disponibles";

            $i++;
            $url[$i]['url'] = $this->awscdr003checkPRD;
            $url[$i]['url_link'] = "awscdr003check";
            $url[$i]['descripcion'] = "Verifica Validación de Datos";

            $i++;
            $url[$i]['url'] = $this->awscdr006aPRD;
            $url[$i]['url_link'] = "awscdr006a";
            $url[$i]['descripcion'] = "Confirmar Turno e Imprimie Boleta";

            $i++;
            $url[$i]['url'] = $this->awscdr003aPRD;
            $url[$i]['url_link'] = "awscdr003a";
            $url[$i]['descripcion'] = "Actualiza Datos Personales y Empresas";

            $i++;
            $url[$i]['url'] = $this->awscdr003bPRD;
            $url[$i]['url_link'] = "awscdr003b";
            $url[$i]['descripcion'] = "Genera Turno Provisorio";

            $i++;
            $url[$i]['url'] = $this->awscdr006bPRD;
            $url[$i]['url_link'] = "awscdr006b";
            $url[$i]['descripcion'] = "Impresión de Comprobante";

            $i++;
            $url[$i]['url'] = $this->awscdr004PRD;
            $url[$i]['url_link'] = "awscdr004";
            $url[$i]['descripcion'] = "Consulta trámites vigentes";

            $i++;
            $url[$i]['url'] = $this->awscdr005PRD;
            $url[$i]['url_link'] = "awscdr005";
            $url[$i]['descripcion'] = "Eliminar Trámites Seleccionados";

            $i++;
            $url[$i]['url'] = $this->awscdr006cPRD;
            $url[$i]['url_link'] = "awscdr006c";
            $url[$i]['descripcion'] = "Envío de Mail al Solicitante";

            $i++;
            $url[$i]['url'] = $this->awscdr007PRD;
            $url[$i]['url_link'] = "awscdr007";
            $url[$i]['descripcion'] = "Re-Impresión de Boleta";

            $this->set(compact('url'));

            $this->render('/Tramites/ver_url');
        }
    }

    /**
     * [actualizar_tramites ACTUALIZA LA TBL turno_tramites para el sistema de TURNOS]
     * @return [type] [description]
     */
    public function actualizar_tramites() {

        if ($this->request->is(array('post', 'ajax'))) {

            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
               <soapenv:Header/>
               <soapenv:Body>
                  <cdr:WSCDR001a.Execute>
                     <cdr:Codorganismo></cdr:Codorganismo>
                  </cdr:WSCDR001a.Execute>
               </soapenv:Body>
            </soapenv:Envelope>';

            $urlWS = $this->awscdr001aPRD;
            
            $array = $this->curlConexion($urlWS,$post_string);
			//print_r($array);
            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                
                return 0;
                exit();
            }else{
            
                @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR001a.ExecuteResponse']['Tramitescompleto']['TramitesCompleto.TramitesCompletoItem'];
                $result = array();

                if(!empty($array)){
                    $this->loadModel('TurnoTramite');

                    $dataS = $this->TurnoTramite->getDataSource();
                    $dataS->begin();
                    $validaSQL = false;

                    //  ELIMINO TODA LA TABLA
                    $this->TurnoTramite->deleteAll(array('1 = 1'));
                    $cantTramites = 0;
                    foreach ($array as $key => $tramite) {

                        if (is_numeric($key)) {
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER = $this->TurnoTramite->find('first', array(
                                'conditions' => array('TurnoTramite.cod_tramite' => $tramite['CodTramite'])));
                            $TT = null;

                            // if(empty($VER)){
                                $this->TurnoTramite->create();
                            // }else{
                                // $TT['TurnoTramite']['id'] = $VER['TurnoTramite']['id'];
                            // }

                            $TT['TurnoTramite']['cod_organismo'] = $tramite['CodOrganismo'];
                            $TT['TurnoTramite']['cd_ce_identif'] = $tramite['CDCeIdentif'];
                            $TT['TurnoTramite']['cod_tramite'] = $tramite['CodTramite'];
                            $TT['TurnoTramite']['dsc_tramite'] = $tramite['DscTramite'];
                            $TT['TurnoTramite']['recomend_tramite'] = $tramite['RecomendTramite'];
                            $TT['TurnoTramite']['cd_tr_sector'] = $tramite['CDTRSector'];
                            $TT['TurnoTramite']['cd_tr_impre_boleta'] = $tramite['CDTRImpreBoleta'];
                            $TT['TurnoTramite']['cd_tr_imp_var'] = $tramite['CDTRImpVar'];
                            $TT['TurnoTramite']['cd_tr_grado'] = $tramite['CDTRGrado'];

                            if($this->TurnoTramite->save($TT)){
                                $cantTramites = $cantTramites +1;
                                $result['Tramites']['Exito'][$key]['CodTramite'] = $tramite['CodTramite'];
                                $validaSQL = true;
                            }else{
                                $result['Tramites']['Error'][$key]['CodTramite'] = $tramite['CodTramite'];
                            }
                        }
                    }
                    $result['Resultado'] = 'Base de Datos de Trámites Actualizado.';
                    $result['Tramites']['Cantidad'] = $cantTramites;
                    $result['Tramites']['Estado'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";


                    if ($validaSQL) {
                        $dataS->commit();
                    }else{
                        $dataS->rollback();
                        $result['Tramites']['Estado'] = "<strong style='color:red;'>ERROR AL ACTUALIZAR TABLAS</strong>";
                    }
                }else{
                    $result['Resultado'] = 'Error en la estructura XML.';
                }
            }
        } else {
            $result['Resultado'] = 'Imposible realizar esta acción.';
        }

        return json_encode($result);
    }


    /**
     * [actualizar_organismos ACTUALIZA LA TBL turno_organismos para el sistema de TURNOS]
     * @return [type] [description]
     */
    public function actualizar_organismos() {

        if ($this->request->is(array('post', 'ajax'))) {

            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
               <soapenv:Header/>
               <soapenv:Body>
                  <cdr:WSCDR001b.Execute/>
               </soapenv:Body>
            </soapenv:Envelope>';

            $urlWS = $this->awscdr001bPRD;
            
            $array = $this->curlConexion($urlWS,$post_string);

            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                
                return 0;
                exit();
            }else{
                
                $cantOrganismos = 0;
                $cantOficinas = 0;

                @$organismos = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR001b.ExecuteResponse']['Organismos']['Organismos.OrganismosItem'];
                @$oficinas = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR001b.ExecuteResponse']['Organoficina']['OrganOficina.OrganOficinaItem'];
                $result = array();

                $result['Resultado'] = 'Base de Datos No Actualizada.';

                //  GUARDO LOS ORGANISMOS
                if(!empty($organismos)){
                    $this->loadModel('TurnoOrganismo');

                    $dataS = $this->TurnoOrganismo->getDataSource();
                    $dataS->begin();
                    $validaSQL = false;


                    //  ELIMINO TODA LA TABLA
                    $this->TurnoOrganismo->deleteAll(array('1 = 1'));

                    foreach ($organismos as $key => $dato) {

                        if (is_numeric($key)) {
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER = $this->TurnoOrganismo->find('first', array(
                                'conditions' => array('TurnoOrganismo.cd_cod_org' => $dato['CDOrgCod'])));
                            $TT = null;

                            $this->TurnoOrganismo->create();

                            $TT['TurnoOrganismo']['cd_cod_org'] = $dato['CDOrgCod'];
                            $TT['TurnoOrganismo']['cd_org_dsc'] = $dato['CDOrgDsc'];
                            $TT['TurnoOrganismo']['cd_org_tramites'] = $dato['CDOrgTramites'];
                            $TT['TurnoOrganismo']['cd_org_multiple'] = $dato['CDOrgMultiple'];
                            $TT['TurnoOrganismo']['cd_org_grado'] = $dato['CDOrgGrado'];

                            if($this->TurnoOrganismo->save($TT)){
                                $cantOrganismos = $cantOrganismos+1;
                                $result['Organismos']['Exito'][$key]['CDOrgCod'] = $dato['CDOrgCod'];
                                $validaSQL = true;
                            }else{
                                $result['Organismos']['Error'][$key]['CDOrgCod'] = $dato['CDOrgCod'];
                            }
                        }

                    }
                    $result['Resultado'] = 'Base de Datos de Organismos Actualizado.';
                    $result['Info']['Estado'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";
                    unset($TT);

                    if ($validaSQL) {
                        $dataS->commit();
                    }else{
                        $dataS->rollback();
                    }

                    //  GUARDO LAS OFICINAS
                    if(!empty($oficinas)){
                        $this->loadModel('TurnoOficina');

                        $dataS = $this->TurnoOficina->getDataSource();
                        $dataS->begin();
                        $validaSQL = false;

                        //  ELIMINO TODA LA TABLA
                        $this->TurnoOficina->deleteAll(array('1 = 1'));

                        foreach ($oficinas as $key1 => $dato1) {

                            if (is_numeric($key1)) {
                                //  VERIFICO SI EXISTE O NO EL TRÁMITE
                                $VER1 = $this->TurnoOficina->find('first', array(
                                    'conditions' => array('TurnoOficina.organismo_codigo' => $dato1['CDOrgCod'], 'TurnoOficina.cd_ce_identif' => $dato1['CDCeIdentif'])));
                                $TT = null;
                                
                                $this->TurnoOficina->create();

                                $TT['TurnoOficina']['organismo_codigo'] = trim($dato1['CDOrgCod']);
                                $TT['TurnoOficina']['cd_ce_identif'] = $dato1['CDCeIdentif'];
                                $TT['TurnoOficina']['cd_ce_telef'] = $dato1['CDCeTelef'];
                                $TT['TurnoOficina']['cd_ce_domici'] = $dato1['CDCeDomici'];
                                $TT['TurnoOficina']['cd_ce_denom'] = $dato1['CDCeDenom'];
                                
                                if($this->TurnoOficina->save($TT)){
                                    $result['Oficinas']['Exito'][$key1]['CDOrgCod'] = $dato1['CDOrgCod'];
                                    $cantOficinas = $cantOficinas+1;
                                    $validaSQL = true;
                                }else{
                                    $result['Oficinas']['Error'][$key1]['CDOrgCod'] = $dato1['CDOrgCod'];
                                }
                            }

                        }
                        $result['Resultado'] = $result['Resultado'].'. Base de Datos de Oficinas Actualizado.';

                        if ($validaSQL) {
                            $dataS->commit();
                        }else{
                            $dataS->rollback();
                        }
                    }else{
                        $result['Resultado'] = $result['Resultado'].'. Error en la estructura XML (Oficinas).';
                    }

                    $result['Organismos']['Cantidad'] = $cantOrganismos;
                    $result['Oficinas']['Cantidad'] = $cantOficinas;

                }else{
                    $result['Resultado'] = 'Error en la estructura XML (Organismos).';
                }

            }
        } else {
            $result['Resultado'] = 'Imposible realizar esta acción.';
        }

        return json_encode($result);
    }


    /**
     * [actualizar_registros_titulos ACTUALIZA LA TBL turno_registros y turno_titulos para el sistema de TURNOS]
     * @return [type] [description]
     */
    public function actualizar_registros_titulos() {

        if ($this->request->is(array('post', 'ajax'))) {

            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sam="SAMEPEv1">
               <soapenv:Header/>
               <soapenv:Body>
                  <sam:WSRegisTitulos.Execute/>
               </soapenv:Body>
            </soapenv:Envelope>';

            $urlWS = $this->awsregistitulosPRD;
            
            $array = $this->curlConexion($urlWS,$post_string);
            
            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                
                return 0;
                exit();
            }else{
                
                //  SELECCIONO LAS OFICINAS
                @$registros = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSRegisTitulos.ExecuteResponse']['Sdtregistros']['SDTRegistros.SDTRegistrosItem'];
                @$titulos = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSRegisTitulos.ExecuteResponse']['Sdttitulos']['SDTtitulos.SDTtitulosItem'];
                $result = array();

                $result['Resultado'] = 'Base de Datos No Actualizada.';
                
                $cantTitulos = 0;
                $cantRegistros = 0;

                //  GUARDO LOS ORGANISMOS
                if(!empty($registros)){
                    $this->loadModel('TurnoRegistro');

                    $dataS = $this->TurnoRegistro->getDataSource();
                    $dataS->begin();
                    $validaSQL = false;

                    //  ELIMINO TODA LA TABLA
                    $this->TurnoRegistro->deleteAll(array('1 = 1'));

                    foreach ($registros as $key => $dato) {

                        if (is_numeric($key)) {
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER = $this->TurnoRegistro->find('first', array(
                                'conditions' => array('TurnoRegistro.ms_reg_cod' => $dato['MSRegCod'])));
                            $TT = null;
                            $this->TurnoRegistro->create();

                            $TT['TurnoRegistro']['ms_reg_cod'] = $dato['MSRegCod'];
                            $TT['TurnoRegistro']['ms_reg_desc'] = $dato['MSRegDsc'];

                            $cantRegistros = $cantRegistros+1;

                            if($this->TurnoRegistro->save($TT)){
                                $result['Registros']['Exito'][$key]['MSRegCod'] = $dato['MSRegCod'];
                                $validaSQL = true;
                            }else{
                                $result['Registros']['Error'][$key]['MSRegCod'] = $dato['MSRegCod'];
                            }
                        }

                    }

                    $result['Resultado'] = 'Base de Datos de Registros Actualizado.';
                    $result['Info']['EstadoRegistros'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";

                    unset($TT);

                    if ($validaSQL) {
                        $dataS->commit();
                    }else{
                        $dataS->rollback();
                    }
                }else{
                    $result['Resultado'] = 'Error en la estructura XML (Registros).';
                }


                //  GUARDO LAS OFICINAS
                if(!empty($titulos)){
                    $this->loadModel('TurnoTitulo');

                    $dataS = $this->TurnoTitulo->getDataSource();
                    $dataS->begin();
                    $validaSQL = false;

                    //  ELIMINO TODA LA TABLA
                    $this->TurnoTitulo->deleteAll(array('1 = 1'));

                    foreach ($titulos as $key1 => $dato1) {

                        if (is_numeric($key1)) {
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER1 = $this->TurnoTitulo->find('first', array(
                                'conditions' => array('TurnoTitulo.registro_codigo' => $dato1['MsRegCod'],'TurnoTitulo.ms_tit_cod' => $dato1['MSTitCod'])));
                            $TT = null;
                            $this->TurnoTitulo->create();

                            $TT['TurnoTitulo']['registro_codigo'] = trim($dato1['MsRegCod']);
                            $TT['TurnoTitulo']['ms_tit_cod'] = $dato1['MSTitCod'];
                            $TT['TurnoTitulo']['ms_tit_dsc'] = $dato1['MSTitDsc'];
                            $TT['TurnoTitulo']['ms_tit_grado'] = $dato1['MsTitGrado'];

                            $cantTitulos = $cantTitulos+1;
                            if($this->TurnoTitulo->save($TT)){
                                $validaSQL = true;
                            }else{

                            }

                        }
                    }

                    $result['Resultado'] = $result['Resultado'].'. Base de Datos de Titulos Actualizado.';
                    $result['Info']['EstadoTitulos'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";

                    if ($validaSQL) {
                        $dataS->commit();
                    }else{
                        $dataS->rollback();
                    }
                }else{
                    $result['Resultado'] = $result['Resultado'].'. Error en la estructura XML (Titulos).';
                    $result['Info']['EstadoTitulos'] = "<strong style='color:red;'>ERROR AL ACTUALIZAR TABLAS</strong>";
                }

                $result['Titulos']['Cantidad'] = $cantTitulos;
                $result['Registros']['Cantidad'] = $cantRegistros;
            }
        } else {
            $result['Resultado'] = 'Imposible realizar esta acción.';
        }


        return json_encode($result);
    }


    /**
     * [actualizar_pro_dpt_loc ACTUALIZA LA TBL turno_provincias, turno_departamentos y turno_localidads para el sistema de TURNOS]
     * $tipo = 1 Provincias | 2 Departamentos | 3 Localidades
     * @return [type] [description]
     */
    public function actualizar_pro_dpt_loc($tipo) {

        if ($this->request->is(array('post', 'ajax'))) {

            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sam="SAMEPEv1">
               <soapenv:Header/>
               <soapenv:Body>
                  <sam:WSProvDepLoc.Execute/>
               </soapenv:Body>
            </soapenv:Envelope';

            $urlWS = $this->awsprovdeplocPRD;
            
            $array = $this->curlConexion($urlWS,$post_string);

            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                
                return 0;
                exit();
            }else{
                
                //  SELECCIONO LOS ARREGLOS DE PROVINCIAS
                if($tipo == 1){
                    @$provincias = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSProvDepLoc.ExecuteResponse']['Provincias']['Provincias.ProvinciasItem'];
                }
                //  SELECCIONO LOS ARREGLOS DE DEPARTAMENTOS
                if($tipo == 2){
                    @$departamentos = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSProvDepLoc.ExecuteResponse']['Departamentos']['Departamentos.DepartamentosItem'];
                }
                //  SELECCIONO LOS ARREGLOS DE LOCALIDADES
                if($tipo == 3){
                    @$localidades = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSProvDepLoc.ExecuteResponse']['Localidades']['Localidades.LocalidadesItem'];
                }
                
                $result = array();

                $result['Resultado'] = 'Base de Datos No Actualizada.';

                $cantProvincias = 0;
                $cantDepartamentos = 0;
                $cantLocalidades = 0;

                //  GUARDO LAS PROVINCIAS
                if(!empty($provincias)){
                    $this->loadModel('TurnoProvincia');

                    foreach ($provincias as $key => $dato) {

                        if (is_numeric($key)) {
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER = $this->TurnoProvincia->find('first', array(
                                'conditions' => array('TurnoProvincia.provincia_codigo' => $dato['SaLcPciaCgo'])));
                            if(empty($VER)){
                                $this->TurnoProvincia->create();
                            }else{
                                $TT['TurnoProvincia']['id'] = $VER['TurnoProvincia']['id'];
                            }
                            $TT['TurnoProvincia']['provincia_codigo'] = $dato['SaLcPciaCgo'];
                            $TT['TurnoProvincia']['nombre'] = $dato['SaLcPciaNom'];

                            $cantProvincias = $cantProvincias+1;

                            if($this->TurnoProvincia->save($TT)){
                                $result['Provincias']['Exito'][$key]['SaLcPciaCgo'] = $dato['SaLcPciaNom'];
                            }else{
                                $result['Provincias']['Error'][$key]['SaLcPciaCgo'] = $dato['SaLcPciaNom'];
                            }
                            unset($VER,$TT);
                        }

                    }


                    $result['Resultado'] = 'Base de Datos de Provincias Actualizado.';
                    $result['Info']['EstadoProvincias'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";

                    $result['Provincias']['Cantidad'] = $cantProvincias;
                }else{
                    $result['Resultado'] = 'Error en la estructura XML (Provincias).';
                }


                // GUARDO LOS DEPARTAMENTOS
                if(!empty($departamentos)){
                    $this->loadModel('TurnoDepartamento');

                    foreach ($departamentos as $key1 => $dato1) {

                        if (is_numeric($key1)) {
                            //  VERIFICO SI EXISTE O NO EL DPTO
                            $VER1 = $this->TurnoDepartamento->find('first', array(
                                'conditions' => array('TurnoDepartamento.departamento_codigo' => $dato1['SaLcDptCgo'],'TurnoDepartamento.turno_provincia_codigo' => $dato1['SaLcPciaCgo'])));

                            if(empty($VER1)){
                                $this->TurnoDepartamento->create();
                            }else{
                                $TT1['TurnoDepartamento']['id'] = $VER1['TurnoDepartamento']['id'];
                            }

                            $TT1['TurnoDepartamento']['nombre'] = trim($dato1['SaLcDptNom']);
                            $TT1['TurnoDepartamento']['departamento_codigo'] = $dato1['SaLcDptCgo'];
                            $TT1['TurnoDepartamento']['turno_provincia_codigo'] = $dato1['SaLcPciaCgo'];

                            $cantDepartamentos = $cantDepartamentos+1;
                            $this->TurnoDepartamento->save($TT1);
                            unset($VER1,$TT1);
                        }
                    }

                    $result['Resultado'] = $result['Resultado'].'. Base de Datos de Departamentos Actualizado.';
                    $result['Info']['EstadoDepartamentos'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";

                    $result['Departamentos']['Cantidad'] = $cantDepartamentos;
                }else{
                    $result['Resultado'] = $result['Resultado'].'. Error en la estructura XML (Departamentos).';
                }

                // GUARDO LAS LOCALIDADES
                if(!empty($localidades)){
                    $this->loadModel('TurnoLocalidad');
                    $this->log("INICIA - LOCALIDADES", 'debug');
                    
                    $localidadesArray = array();
                    $i = 0;
                    foreach ($localidades as $key2 => $dato2) {

                        if (is_numeric($key2)) {
                            //  VERIFICO SI EXISTE O NO LA LOCALIDAD
                            $VER2 = $this->TurnoLocalidad->find('first', array(
                                'conditions' => array(
                                    'TurnoLocalidad.localidad_codigo' => $dato2['SaLcDisCgo'],
                                    'TurnoLocalidad.turno_provincia_codigo' => $dato2['SaLcPciaCgo'],
                                    'TurnoLocalidad.turno_departamento_codigo' => $dato2['SaLcDptCgo']),
                                'limit' => 10));
                            $this->log($VER2, 'debug');
                            if(empty($VER2)){
                                $this->TurnoLocalidad->create();
                            }else{
                                $TT2['TurnoLocalidad']['id'] = $VER2['TurnoLocalidad']['id'];
                            }

                            $TT2['TurnoLocalidad']['nombre'] = trim($dato2['SaLcDisNom']);
                            $TT2['TurnoLocalidad']['localidad_codigo'] = $dato2['SaLcDisCgo'];
                            $TT2['TurnoLocalidad']['turno_departamento_codigo'] = $dato2['SaLcDptCgo'];
                            $TT2['TurnoLocalidad']['turno_provincia_codigo'] = $dato2['SaLcPciaCgo'];
                            $TT2['TurnoLocalidad']['cp'] = $dato2['SaLcDisCP'];

                            $cantLocalidades = $cantLocalidades+1;
                            $this->TurnoLocalidad->save($TT2);
                            // $this->log($TT2, 'debug');
                            unset($TT2);
                        }
                    }
                    $this->log("FIN - LOCALIDADES", 'debug');

                    $result['Resultado'] = $result['Resultado'].'. Base de Datos de Localidades Actualizado.';
                    $result['Info']['EstadoLocalidades'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";

                    $result['Localidades']['Cantidad'] = $cantLocalidades;
                }else{
                    $result['Resultado'] = $result['Resultado'].'. Error en la estructura XML (Localidades).';
                }
            }
        } else {
            $result['Resultado'] = 'Imposible realizar esta acción.';
        }


        return json_encode($result);
    }

    /**
     * **********************************************************************************************************
     * **********************   SERVICIOS ACTUALIZADOS V2 *******************************************************
     */
    
    /**
     * [curlConexion description]
     * @param  [type] $urlWS       [description]
     * @param  [type] $post_string [description]
     * @return [type]              [description]
     */
    private function curlConexion($urlWS,$post_string){

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $urlWS);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 300);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8', 'Content-Length: ' . strlen($post_string)));

        $result = curl_exec($soap_do);
        $err = curl_error($soap_do);

        curl_close($soap_do);
        
        $array['Estado'] = 1;

        if (strlen($err) > 10) {
            $array['Estado'] = 0;
            $array['Error'] = $err;
            return $array;
            exit();
        }

        //  ARMO EL XML
        include_once('../Vendor/Array2XML.php');

        $array['Rest'] = xml2array($result);

        return $array;
    }

    /**
     * [step_1 description]
     * @return [type] [description]
     */
    public function step_1(){
        $this->autoRender = false;
        
        $this->loadModel('TurnoOrganismo');
        $this->loadModel('TurnoRegistro');
        $this->loadModel('TurnoTitulo');
        //  PRESELECCION DE ORGANISMOS
        $listaGeneral = array('1' => 'Salud','2' => 'Registro Civil');

        $ORG = $this->TurnoOrganismo->find('all');

        $lista_registros = $this->TurnoRegistro->find('list', array('fields' => array('TurnoRegistro.ms_reg_cod','TurnoRegistro.ms_reg_desc')));
        $registro_null = array('00' => '- Seleccione un Registro -');
        array_unshift($lista_registros, $registro_null);

        $lista_titulos = array();
        $TIT = $this->TurnoTitulo->find('all');
        foreach ($TIT as $key => $titulo) {
            $lista_titulos[$titulo['TurnoTitulo']['registro_codigo']][$titulo['TurnoTitulo']['ms_tit_cod']."_".$titulo['TurnoTitulo']['ms_tit_grado']] = $titulo['TurnoTitulo']['ms_tit_dsc'];
        }

        $lista_organismos_sal = $lista_organismos_reg = array();
        $detalle_organismos = null;
        $lista_grados = array();

        foreach ($ORG as $key => $organismo) {
            if($organismo['TurnoOrganismo']['cd_cod_org'] == "REGC"){
                //  GENERO LA LISTA DE TRAMITES DE REGISTRO CIVIL
                $lista_organismos_reg[$key."_".$organismo['TurnoOrganismo']['cd_cod_org']."_".$organismo['TurnoOrganismo']['cd_org_grado']."_".$organismo['TurnoOrganismo']['cd_org_multiple']] = $organismo['TurnoOrganismo']['cd_org_dsc'];
            }else{
                //  GENERO LA LISTA DE TRAMITES DE SALUDO
                $lista_organismos_sal[$key."_".$organismo['TurnoOrganismo']['cd_cod_org']."_".$organismo['TurnoOrganismo']['cd_org_grado']."_".$organismo['TurnoOrganismo']['cd_org_multiple']] = $organismo['TurnoOrganismo']['cd_org_dsc'];
            }

            //  GENERO EL DETALLE DE CADA ORGANISMO
            $detalle_organismos[$key] = $organismo['TurnoOrganismo']['cd_org_tramites'];

            //  CONSULTO EL GRADO PARA LISTAR LOS TÍTULOS
            if($organismo['TurnoOrganismo']['cd_org_grado'] == 1){

                $lista_grados[$key] = "";
            }
        }

        $this->set(compact('listaGeneral','ORG', 'lista_registros', 'lista_organismos_reg','lista_organismos_sal', 'lista_titulos', 'detalle_organismos'));

        $this->set(compact('mensaje'));
        $this->render('/Tramites/step_1');
    }

    /**
     * [step_2_verifica_existencia VERIFICA SI EL USUARIO YA TIENE UN TURNO ASIGNADO]
     * @return [type] [description]
     */
    public function step_2_verifica_existencia($org_id,$tipo_doc,$num_doc,$sexo){
        $this->autoRender = false;
        $this->layout = false;

        $post_string = '
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
               <soapenv:Header/>
               <soapenv:Body>
                  <cdr:WSCDR001check.Execute>
                     <cdr:Cdorgcod>'.$org_id.'</cdr:Cdorgcod>
                     <cdr:Cdpetipdoc>'.$tipo_doc.'</cdr:Cdpetipdoc>
                     <cdr:Cdpenrodoc>'.$num_doc.'</cdr:Cdpenrodoc>
                     <cdr:Cdpesexo>'.$sexo.'</cdr:Cdpesexo>
                  </cdr:WSCDR001check.Execute>
               </soapenv:Body>
            </soapenv:Envelope>';
            
        // $urlWS = "http://msaptst1.mendoza.gov.ar:8080/cdrtstpostg/servlet/awscdr001check";
        $urlWS = $this->awscdr001checkPRD;

        $array = $this->curlConexion($urlWS,$post_string);
        
        //  ERROR DE CONEXIÓN CON EL WS
        if($array['Estado'] == 0){
            $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
            $result['flag'] = 0;
        }else{
            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR001check.ExecuteResponse'];
            if ($array['Flagerror'] == 9) {
                $result['mensaje'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
                $result['flag'] = 2;
            } else {
                $result['mensaje'] = "";
                $result['flag'] = 1;
            }    
        }

        return $result;
    }

    /**
     * [step_2 description]
     * @return [type] [description]
     */
    public function step_2(){
        
        $this->autoRender = false;
        $this->layout = false;
        

        //  SI EL TIPO DE ORG_COD == REGC -> VALIDO SI TIENE UN TURNO PREVIO
        if($this->request->data['org_id'] == "REGC"){
            $valida = $this->step_2_verifica_existencia($this->request->data['org_id'],$this->request->data['tipo_doc'],$this->request->data['num_doc'],$this->request->data['sexo']);
            if($valida['flag'] == 0){
                //  ERROR EN EL WS
                return $valida['flag'];
                exit();
            }else{
                if($valida['flag'] == 2){
                    //  YA TIENE UN TURNO ASIGNADO
                    return $valida['flag'];
                    exit();
                }
            }
        }

        $this->loadModel('TurnoTramite');

        $flagError = 1;
        $esMultiTramite = $this->request->data['org_mul'];
        if($this->request->data['org_mul'] == 1){

            $dato = $this->step_2_turnos_disponibles("html",$this->request->data['org_id'],$this->request->data['org_gra']);
            
            $flagError = $dato['flagError'];
            $msjError = $dato['msjError'];
            $turnosSelect = $dato['turnosSelect'];
            $turnosDesc = $dato['turnosDesc'];
            $listaCDR = $dato['listaCDR'];
            $preferencia = $dato['preferencia'];

            $this->set(compact('msjError', 'turnosSelect', 'turnosDesc','listaCDR','preferencia'));
        }

        //  LISTAR TODOS LOS TRAMITES SEGÚN EL ORGANISMO Y EL GRADO DEL TITULO
        //  SI EL ORG NO REQUERÍA TITULO, LISTAR TODOS LOS TRAMITES
        if($this->request->data['org_gra'] == "0"){
            $options['TurnoTramite.cod_organismo'] = $this->request->data['org_id'];
            // $gr = array("0");
            // $options['TurnoTramite.cd_tr_grado'] = 0;
        }else{
            $options['TurnoTramite.cod_organismo'] = $this->request->data['org_id'];
            if($this->request->data['tit_gra'] != "0"){
                $gr = $this->request->data['tit_gra'];
            }else{
                $gr = array("0",$this->request->data['tit_gra']);
            }
            //  OBLIGO SIEMPRE A TRAER EL GRADO 0!!! -> 28/01/16
            $gr = array("0",$this->request->data['tit_gra']);
            $options['TurnoTramite.cd_tr_grado'] = $gr;
        }

        $TRA = $this->TurnoTramite->find('all', array(
            'conditions' => $options
            )
        );

        if(!empty($TRA)){
            $lista_tramites = array();

            foreach ($TRA as $key => $tramite) {
                //  GENERO LA LISTA
                $lista_tramites[$tramite['TurnoTramite']['cod_tramite']."_".$tramite['TurnoTramite']['cd_tr_impre_boleta']] = $tramite['TurnoTramite']['dsc_tramite'];

                //  GENERO EL DETALLE DE CADA ORGANISMO
                $detalle_tramites[$tramite['TurnoTramite']['cod_tramite']]['recomendaciones'] = $tramite['TurnoTramite']['recomend_tramite'];
                $detalle_tramites[$tramite['TurnoTramite']['cod_tramite']]['identif'] = $tramite['TurnoTramite']['cd_ce_identif'];
                $detalle_tramites[$tramite['TurnoTramite']['cod_tramite']]['sector'] = $tramite['TurnoTramite']['cd_tr_sector'];
                $detalle_tramites[$tramite['TurnoTramite']['cod_tramite']]['impre_boleta'] = $tramite['TurnoTramite']['cd_tr_impre_boleta'];
                $detalle_tramites[$tramite['TurnoTramite']['cod_tramite']]['imp_var'] = $tramite['TurnoTramite']['cd_tr_imp_var'];
                $detalle_tramites[$tramite['TurnoTramite']['cod_tramite']]['grado'] = $tramite['TurnoTramite']['cd_tr_grado'];
            }
        }else{
            //  NO ENCUENTRA NADA EN LA DB
            return 0;
            exit();
        }

        if($this->request->data['org_id'] == "FARM" || $this->request->data['org_id'] == "CERT"){
            $infoTramite['cantidad'] = 10;
            $infoTramite['mensaje'] = "La cantidad máxima para cada trámite es de 10 unidades.";
        }else{
            if($this->request->data['org_id'] == "LAB" || $this->request->data['org_id'] == "BRO"){
                $infoTramite['cantidad'] = 1;
                $infoTramite['mensaje'] = "La cantidad máxima para cada trámite es de 1 unidad.";
            }else{
                $infoTramite['cantidad'] = 1;
                $infoTramite['mensaje'] = "";
            }
        }
        $this->set(compact('flagError','esMultiTramite', 'lista_tramites','detalle_tramites', 'infoTramite'));
        
        //  SI ES ORG MULTIPLE
        if($this->request->data['org_mul'] == 1){
            $this->render('/Tramites/step_2_multitramite');
        }else{
            $this->render('/Tramites/step_2');
        }
        
    }

    /**
     * [step_2_turnos_disponibles BUSCA LOS TURNOS DISPONIBLES Y LOS MUESTRA]
     * @return [type] [description]
     */
    public function step_2_turnos_disponibles($html = null, $org_cod = null,$tra_cod = null){

        $this->loadModel('TurnoTramite');

        $this->autoRender = false;
        $this->layout = false;

        if($html != null){
            $this->request->data['org_cod'] = $org_cod;
            $this->request->data['tra_cod'] = $tra_cod;
        }

        $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
               <soapenv:Header/>
               <soapenv:Body>
                  <cdr:WSCDR002a.Execute>
                     <cdr:Cdorgcod>'.$this->request->data['org_cod'].'</cdr:Cdorgcod>
                     <cdr:Cdtrcodigo>'.$this->request->data['tra_cod'].'</cdr:Cdtrcodigo>
                  </cdr:WSCDR002a.Execute>
               </soapenv:Body>
            </soapenv:Envelope>';

        $urlWS = $this->awscdr002aPRD;
        
        $array = $this->curlConexion($urlWS,$post_string);
        
        //  ERROR DE CONEXIÓN CON EL WS
        if($array['Estado'] == 0){
            $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
            $result['flag'] = 0;
            $result['flagError'] = 10;
            $result['msjError'] = "El servicio no se encuentra disponible para otorgar Turnos.";
            $result['turnosSelect'] = null;
            $result['turnosDesc'] = null;
            $result['listaCDR'] = null;
            $result['preferencia'] = null;

            return 0;
            exit();
        }else{

            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR002a.ExecuteResponse'];
            
            if ($array['Flagerror'] == 9) {
                $result['mensaje'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
                $result['flag'] = 2;
            } else {
                $result['mensaje'] = "";
                $result['flag'] = 1;
            }    
        }

        $turnosSelect = $turnosDesc = array();
        $flagError = 1;
        $msjError = "";
        $dias_texto = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $listaCDR = array();
        if ($array['Flagerror'] == 9) {
            $flagError = 9;
            $msjError = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
        } else {
            
            $this->loadModel("TurnoOficina");
            $id_cdr = null;
            foreach ($array['Cdrturnos']['CDRturnos.CDRturnosItem'] as $key => $turnos) {
                if (is_numeric($key)) {
                    
                    //  LISTO LAS OFICINAS
                    $OF = $this->TurnoOficina->find('first',array(
                            'conditions' => array('TurnoOficina.cd_ce_identif' =>$turnos['CDCeIdentif']),
                            'fields' => array('TurnoOficina.cd_ce_denom')
                            )
                        );
                    if(!empty($OF)){
                        $listaCDR[$turnos['CDCeIdentif']] = $OF['TurnoOficina']['cd_ce_denom'];
                    }else{
                        $listaCDR[$turnos['CDCeIdentif']] = $turnos['CDOrgCod']." (".$turnos['CDCeIdentif'].")";
                    }
                    $turnosSelect[$turnos['CDCeIdentif']] = $turnos['CDCeDenom'];
                    $turnosDesc[$turnos['CDCeIdentif']]['NombreOficina'] = $listaCDR[$turnos['CDCeIdentif']];
                    $turnosDesc[$turnos['CDCeIdentif']]['Domicilio'] = $turnos['CDCeDomici'];

                    $tel = "Sin Teléfonos";
                    if($turnos['CDCeTelef'] != "0"){
                        $tel = $turnos['CDCeTelef'];
                    }
                    if($turnos['CDCeTelAlternat'] != "0"){
                        $tel = ($turnos['CDCeTelef'] != "0")?$tel." / ".$turnos['CDCeTelAlternat']:$turnos['CDCeTelAlternat'];
                    }

                    $turnosDesc[$turnos['CDCeIdentif']]['Telefono'] = $tel;
                    // $turnosDesc[$turnos['CDCeIdentif']]['TelefonoAlt'] = $turnos['CDCeTelAlternat'];
                    $turnosDesc[$turnos['CDCeIdentif']]['CDOrgCod'] = $turnos['CDOrgCod'];
                    $turnosDesc[$turnos['CDCeIdentif']]['CDCeIdentif'] = $turnos['CDCeIdentif'];
                    if (!is_array($turnos['FchHoraM'])) {
                        $fechaM = explode("T", $turnos['FchHoraM']);
                        $dia = $dias_texto[date("w", strtotime($fechaM[0]))] . ", " . date("d-m-Y", strtotime($fechaM[0]));
                        $hora = "Hora: " . date("H:i", strtotime($fechaM[1]));
                        $turnosDesc[$turnos['CDCeIdentif']]['TurnoSugerido'][1] = $dia . " - " . $hora . " (Turno Mañana)";
                    }
                    if (!is_array($turnos['FchHoraT'])) {
                        $fechaT = explode("T", $turnos['FchHoraT']);
                        $dia = $dias_texto[date("w", strtotime($fechaT[0]))] . ", " . date("d-m-Y", strtotime($fechaT[0]));
                        $hora = "Hora: " . date("H:i", strtotime($fechaT[1]));
                        $turnosDesc[$turnos['CDCeIdentif']]['TurnoSugerido'][2] = $dia . " - " . $hora . " (Turno Tarde)";
                    }
                    if (!is_array($turnos['FchHoraN'])) {
                        $fechaN = explode("T", $turnos['FchHoraN']);
                        $dia = $dias_texto[date("w", strtotime($fechaN[0]))] . ", " . date("d-m-Y", strtotime($fechaN[0]));
                        $hora = "Hora: " . date("H:i", strtotime($fechaN[1]));
                        $turnosDesc[$turnos['CDCeIdentif']]['TurnoSugerido'][3] = $dia . " - " . $hora . " (Turno Noche)";
                    }
                } else {

                    $indice = substr($key, 0, 1);
                    if ($indice != "0") {
                        if ($key == "CDCeIdentif"){
                            $turnosDesc[$turnos]['CDCeIdentif'] = $turnos;
                            $id_cdr = $turnos;
                        }

                        if ($key == "CDCeDenom")
                            $turnosSelect[$id_cdr] = $turnos;

                        if ($key == "CDCeDomici")
                            $turnosDesc[$id_cdr]['Domicilio'] = $turnos;

                        if ($key == "CDCeTelef"){
                            $turnosDesc[$id_cdr]['Telefono'] = "Sin Teléfonos";
                            if($turnos != "0"){
                                $turnosDesc[$id_cdr]['Telefono'] = $turnos;
                            }

                        }

                        if ($key == "CDCeTelAlternat"){
                            if($turnos != "0"){
                                $tel = ($turnosDesc[$id_cdr]['Telefono'] != "Sin Teléfonos")?$turnosDesc[$id_cdr]['Telefono']." / ".$turnos:$turnos;
                                $turnosDesc[$id_cdr]['Telefono'] = $tel;
                            }
                        }

                        if ($key == "CDOrgCod"){
                            $turnosDesc[$id_cdr]['CDOrgCod'] = $turnos;
                            $OF = $this->TurnoOficina->find('first',array(
                                'conditions' => array('TurnoOficina.cd_ce_identif' =>$id_cdr),
                                'fields' => array('TurnoOficina.cd_ce_denom')
                                )
                            );
                            if(!empty($OF)){
                                $listaCDR[$id_cdr] = $OF['TurnoOficina']['cd_ce_denom'];
                            }else{
                                $listaCDR[$id_cdr] = $turnos." (".$id_cdr.")";
                            }
                            $turnosDesc[$id_cdr]['NombreOficina'] = $listaCDR[$id_cdr];
                        }

                        if ($key == "FchHoraM") {
                            if (count($turnos) > 0) {
                                $fechaM = explode("T", $turnos);
                                $dia = $dias_texto[date("w", strtotime($fechaM[0]))] . ", " . date("d-m-Y", strtotime($fechaM[0]));
                                $hora = "Hora: " . date("H:i", strtotime($fechaM[1]));
                                $turnosDesc[$id_cdr]['TurnoSugerido'][1] = $dia . " - " . $hora . " (Turno Mañana)";
                            }
                        }
                        if ($key == "FchHoraT") {
                            if (count($turnos) > 0) {
                                $fechaT = explode("T", $turnos);
                                $dia = $dias_texto[date("w", strtotime($fechaT[0]))] . ", " . date("d-m-Y", strtotime($fechaT[0]));
                                $hora = "Hora: " . date("H:i", strtotime($fechaT[1]));
                                $turnosDesc[$id_cdr]['TurnoSugerido'][2] = $dia . " - " . $hora . " (Turno Tarde)";
                            }
                        }
                        if ($key == "FchHoraN") {
                            if (count($turnos) > 0) {
                                $fechaN = explode("T", $turnos);
                                $dia = $dias_texto[date("w", strtotime($fechaN[0]))] . ", " . date("d-m-Y", strtotime($fechaN[0]));
                                $hora = "Hora: " . date("H:i", strtotime($fechaN[1]));
                                $turnosDesc[$id_cdr]['TurnoSugerido'][3] = $dia . " - " . $hora . " (Turno Noche)";
                            }
                        }
                    }
                }
                $preferencia = array('1' => 'Mañana');
                if($this->request->data['org_cod'] == "REGC"){
                    // $turnosPreferencia = array('1' => 'Mañana');
                    $preferencia = array('1' => 'Mañana','2' => 'Tarde');
                }
            }
        }
        
        if($html == null){
            $this->set(compact('flagError', 'msjError', 'turnosSelect', 'turnosDesc','listaCDR', 'preferencia','turnosPreferencia'));
            $this->render('/Tramites/listas/turnos_disponibles');
        }else{
            $dato['flagError'] = $flagError;
            $dato['msjError'] = $msjError;
            $dato['turnosSelect'] = $turnosSelect;
            $dato['turnosDesc'] = $turnosDesc;
            $dato['listaCDR'] = $listaCDR;
            $dato['preferencia'] = array('1' => 'Mañana');
            if($this->request->data['org_cod'] == "REGC"){
                $dato['preferencia'] = array('1' => 'Mañana','2' => 'Tarde');
            }


            return $dato;
        }
    }

    public function step_3(){
        $this->autoRender = false;
        
        //  ENVÍO LOS DATOS PARA VALIDAR DATOS PERSONALES
        $org_id = $this->request->data['org_id'];
        @$tipo_doc = $this->request->data['tipo_doc'];
        @$num_doc = $this->request->data['num_doc'];
        @$sexo = $this->request->data['sexo'];

        $tipo_documentos_lista = array(0 => '- Tipo Documento -',1 => 'DNI',2 => 'LE',3 => 'LC',4 => 'CI',10 => 'CUIT',11 => 'CUIL');
        $lista_sexo = array("X" => 'No Corresponde',"M" => 'Masculino', "F" => 'Femenino');
        
        $this->set(compact('org_id','tipo_doc','num_doc','sexo','tipo_documentos_lista','lista_sexo'));

        $this->render('/Tramites/step_3');
    }

    /**
     * [step_3_verifica_datos_personales]
     * @return [type] [description]
     */
    public function step_3_verifica_datos_personales(){
        
        if ($this->request->is(array('post', 'ajax'))) {

            set_time_limit(0);
            
            $this->autoRender = false;
            $this->layout = false;
            $sexo = $this->request->data['sexo'];
            $tipo = $this->request->data['tipo_doc'];
            
            $numero = $this->request->data['num_doc'];
            //  SACO LOS GUIONES DEL CUIT/CUIL
            if($tipo == 10 || $tipo == 11){
                $numero = str_replace("-","",$this->request->data['num_doc']);
            }
            
            $organismo_id = $this->request->data['organismo_id'];
            $multitramite = $this->request->data['multitramite'];

            $datos = array();

            $datos['Info'] = $this->get_datos_personales($organismo_id,$tipo,$numero,$sexo);
            
            //  BUSCO LOS DATOS DE LOCALIDAD,PROVINCIA Y DPTO
            $listaProvincias = $listaDepartamentos = $listaLocalidades = array();

            if($datos['Info']['Estado'] != "0"){
                $this->loadModel('TurnoProvincia');
                $listaProvincias = $this->TurnoProvincia->find('list', array('fields' => array('provincia_codigo','nombre')));
                if($datos['Info']['Datos']['Salcdptcgo'] != "0"){
                    $this->loadModel('TurnoDepartamento');
                    $listaDepartamentos = $this->TurnoDepartamento->find('list', array(
                        'conditions' => array('TurnoDepartamento.turno_provincia_codigo' => $datos['Info']['Datos']['Salcpciacgo']),
                        'fields' => array('departamento_codigo','nombre'))
                    );
                    if($datos['Info']['Datos']['Salcdiscgo'] != "0"){
                        $this->loadModel('TurnoLocalidad');
                        $listaLocalidades = $this->TurnoLocalidad->find('list', array(
                            'conditions' => array('TurnoLocalidad.turno_provincia_codigo' => $datos['Info']['Datos']['Salcpciacgo'],'TurnoLocalidad.turno_departamento_codigo' => $datos['Info']['Datos']['Salcdptcgo']),
                            'fields' => array('localidad_codigo','nombre'))
                        );
                    }
                }
            }
            
            $this->set(compact('tipo','sexo','multitramite', 'datos','listaProvincias','listaDepartamentos','listaLocalidades'));

            $this->render("/Tramites/listas/formulario_step_3");

        }
    }

    /**
     * [get_datos_personales VERIFICA SI EXISTE EL USUARIO Y MUESTRA LOS DATOS EN EL FORMULARIO]
     * @param  [type] $organismo_id [description]
     * @param  [type] $tipo         [description]
     * @param  [type] $numero       [description]
     * @param  [type] $sexo         [description]
     * @return [type]               [description]
     */
    private function get_datos_personales($organismo_id,$tipo,$numero,$sexo){

        if ($this->request->is(array('post', 'ajax'))) {

            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
               <soapenv:Header/>
               <soapenv:Body>
                  <cdr:WSCDR003check.Execute>
                     <cdr:Cdorgcod>'.$organismo_id.'</cdr:Cdorgcod>
                     <cdr:Cdpetipdoc>'.$tipo.'</cdr:Cdpetipdoc>
                     <cdr:Cdpenrodoc>'.$numero.'</cdr:Cdpenrodoc>
                     <cdr:Cdpesexo>'.$sexo.'</cdr:Cdpesexo>
                  </cdr:WSCDR003check.Execute>
               </soapenv:Body>
            </soapenv:Envelope>';
            //echo "Tipo: ".$tipo;
            $urlWS = $this->awscdr003checkPRD;

            $array = $this->curlConexion($urlWS,$post_string);
			//print_r($array);
            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                return 0;
                exit();
            }else{
            
                @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR003check.ExecuteResponse'];
                $result = array();

                if(!empty($array)){
                    if($array['Flagerror'] == 9){
                        $result['Datos'] = null;
                        $result['Estado'] = 0;
                        $result['Mensaje'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
                    }else{
                        foreach ($array as $key => $infoPersonal) {
                            
                            if (is_array($infoPersonal)) {
                                $infoPersonal = "";
                            }
                            $info[$key] = $infoPersonal;
                        }
                        $result['Datos'] = $info;
                        $result['Estado'] = 1;
                        $result['Mensaje'] = 'Datos encontrados.';
                    }
                }else{
                    $result['Estado'] = 0;
                    $result['Mensaje'] = 'No se encuentra Registrado en el Sistema.';
                }
            }
        } else {
            $result['Estado'] = 0;
            $result['Mensaje'] = 'Imposible realizar esta acción.';
        }

        return $result;
    }

    /**
     * [step_4 ACTUALIZAR DATOS, LISTAR PV, SINO GENERA TURNO PREVIO]
     * @return [type] [description]
     */
    public function step_4(){
        $this->autoRender = false;
        

        //  ARMO EL ARRAY CON LA INFO A ACTUALIZAR
        $info['org_id'] = $this->request->data['org_id'];       //  OrganismoId (Cdorgcod)
        $info['oficina'] = $this->request->data['oficina'];     //  OficinaId (Cdceidentif)
        $info['org_mul'] = $this->request->data['org_mul'];     //  OrganismoMultitramite (Multiple)
        $info['tur_pre'] = $this->request->data['tur_pre'];     //  TurnoPreferido (Cdtusegmento)
        $info['tra_cod'] = $this->request->data['linea_tramites'];     //  TramiteCodigo (Lineatramites)
        $info['pun_ven'] = $this->request->data['pun_ven'];     //  Punto de Ventas
        $info['pun_ven_sel'] = $this->request->data['pun_ven_sel'];     //  Punto de Ventas

        $info['tip_doc'] = $this->request->data['tip_doc'];
        $info['num_doc'] = $this->request->data['num_doc'];
        //  SACO LOS GUIONES DEL CUIT/CUIL
        if($info['tip_doc'] == 10 || $info['tip_doc'] == 11){
            $info['num_doc'] = str_replace("-","",$this->request->data['num_doc']);
        }
        $info['sexo'] = $this->request->data['sexo'];
        $info['apellido'] = $this->request->data['apellido'];
        $info['nombre'] = (isset($this->request->data['nombres']))?$this->request->data['nombres']:"";
        //  MODIFICO EL FORMATO DE LA FECHA
        @$info['fec_nac'] = (isset($this->request->data['fec_nac']))?$this->request->data['fec_nac']:"";
        @$fecNue = explode("/", $info['fec_nac']);
        @$info['fec_nac'] = $fecNue[2]."-".$fecNue[1]."-".$fecNue[0];
        $info['email'] = (isset($this->request->data['email']))?$this->request->data['email']:"";
        $info['telefono'] = (isset($this->request->data['telefono']))?$this->request->data['telefono']:"";
        $info['tel_cel'] = (isset($this->request->data['tel_cel']))?$this->request->data['tel_cel']:"";
        $info['provincia'] = (isset($this->request->data['provincia']))?$this->request->data['provincia']:"";
        $info['departamento'] = (isset($this->request->data['departamento']))?$this->request->data['departamento']:"";
        $info['localidad'] = (isset($this->request->data['localidad']))?$this->request->data['localidad']:"";
        $info['domicilio'] = (isset($this->request->data['domicilio']))?$this->request->data['domicilio']:"";
        $info['domicilio_numero'] = (isset($this->request->data['domicilio_numero']))?$this->request->data['domicilio_numero']:"";
        $info['codigo_postal'] = (isset($this->request->data['codigo_postal']))?$this->request->data['codigo_postal']:"";
        $info['tipo_formulario'] = $this->request->data['tipo'];

        //  SELECCIONO PTO DE VENTA
        if($info['pun_ven_sel'] == "SI"){
            $result = array();
            $result['Actualizacion']['Estado'] = 0; //  PARA QUE GENERE EL TURNO PROVISORIO
        }else{
            $res = $this->actualizarDatosPuntoVentas($info);
            $result = array();
            $result['Info'] = $info;
            $result['Actualizacion'] = $res;
        }

        //  VERIFICA SI TIENE PUNTO DE VENTA Y LO MUESTRO EN EL PASO 4
        if($result['Actualizacion']['Estado'] == 1 && count($result['Actualizacion']['Lista']) > 0){

        }else{
            $turno_provisorio = $this->turnoProvisorio($info);
            $result['Turno'] = $turno_provisorio;
        }

        $this->set(compact('result'));

        $this->render('/Tramites/step_4');
    }

    public function step_5(){
        set_time_limit(0);

        $this->autoRender = false;
        $this->layout = false;

        //  ARMO EL ARRAY CON LA INFO A ACTUALIZAR
        $info['org_id'] = $this->request->data['org_id'];       //  OrganismoId (Cdorgcod)
        $info['oficina'] = $this->request->data['oficina'];     //  OficinaId (Cdceidentif)
        $info['org_mul'] = $this->request->data['org_mul'];     //  OrganismoMultitramite (Multiple)
        $info['tur_pre'] = $this->request->data['seg_tur'];     //  TurnoPreferido (Cdtusegmento)
        $info['tra_cod'] = $this->request->data['tra_cod'];     //  TramiteCodigo (Lineatramites)

        $info['fec_tur'] = date("Y-m-d", strtotime($this->request->data['fec_tur']));     //  FechaTurno (Cdtufchturno)
        $info['num_tur'] = $this->request->data['num_tur'];     //  NumeroTurno (Cdtunroturno)
        $info['pun_ven'] = $this->request->data['pun_ven'];     //  NumeroTurno (Cdtunroturno)
        $info['tra_can'] = ($info['org_mul'] == 1)?"1":"1";

        $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
           <soapenv:Header/>
           <soapenv:Body>
              <cdr:WSCDR006a.Execute>
                 <cdr:Cdtuidentif>'.$info['oficina'].'</cdr:Cdtuidentif>
                 <cdr:Cdtufchturno>'.$info['fec_tur'].'</cdr:Cdtufchturno>
                 <cdr:Cdtusegmento>'.$info['tur_pre'].'</cdr:Cdtusegmento>
                 <cdr:Cdtunroturno>'.$info['num_tur'].'</cdr:Cdtunroturno>
                 <cdr:Multiple>'.$info['org_mul'].'</cdr:Multiple>
                 <cdr:Puntoventaefector>'.$info['pun_ven'].'</cdr:Puntoventaefector>
                 <cdr:Lineatramites>'.$info['tra_cod'].'</cdr:Lineatramites>
              </cdr:WSCDR006a.Execute>
           </soapenv:Body>
        </soapenv:Envelope>';

        $urlWS = $this->awscdr006aPRD;
        
        $array = $this->curlConexion($urlWS,$post_string);
        
        //  ERROR DE CONEXIÓN CON EL WS
        if($array['Estado'] == 0){
            
            return 0;
            exit();
        }else{
        
            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR006a.ExecuteResponse'];
            $result = array();
            $turno = array();
            $flagError = 1;
            $msjError =  $tipoError = "";
            $data['Turno'] = "";
            $data['Flag'] = $array['Flagerror'];
            if ($array['Flagerror'] == 9) {
                $data['Mensaje'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
                $data['CodError'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['CodMsg'];
                //echo $tipoError;
                //exit();
            } else {
                $data['Count']=count($array['Url_filename']);
                if(count($array['Url_filename']) > 0)
                    $data['PDF'] = $array['Url_filename'];

                $i = 0;
                foreach ($array['Mensajescdr']['MensajesCDR.MensajesCDRItem'] as $key => $value) {
                    if (is_numeric($key)) {
                        // if (!is_array($value['TextoMsg']))
                            $turno['Mensaje'][$i] = $value['TextoMsg'];

                    }else{
                        if($key == "TextoMsg")
                            $turno['Mensaje'][$i] = $value;
                        // $data['CodError'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['CodMsg'];
                    }
                    $i++;
                }

                $data['Turno'] = $turno;

                //  CONSTANCIA DE TURNO Y NOTIFICACIÓN VÍA MAIL (SOLO PARA REGC)
                if($info['org_id'] == "REGC"){
                    $pdfConstancia = $this->tramite_impresion_constancia("REGC",$info['oficina'],$info['fec_tur'],$info['tur_pre'],$info['num_tur']);
                    if(strlen($pdfConstancia['PDF'])>1){
                        $data['PDFconstancia'] = $pdfConstancia['PDF'];
                    }

                    $correo = $this->tramite_enviar_mail("REGC",$info['oficina'],$info['fec_tur'],$info['tur_pre'],$info['num_tur']);
                    if($correo['estado'] == 1){
                        $data['EmailNotificacion'] = $correo['mensaje'];
                    }
                }
            }
        }

        $this->set(compact('data'));
        $this->render('/Tramites/step_5');
    }

    /**
     * [listar_pro_dep_loc description]
     * @param  [type] $tipo    [description]
     * @param  [type] $pro_id  [description]
     * @param  [type] $dpto_id [description]
     * @return [type]          [description]
     */
    public function listar_pro_dep_loc($tipo,$pro_id = null,$dpto_id = null){
        if($tipo == "provincias"){
            $this->loadModel('TurnoProvincia');
            $lista = $this->TurnoProvincia->find('list', array('fields' => array('provincia_codigo','nombre')));

        }

        if($tipo == "departamentos"){
            $this->loadModel('TurnoDepartamento');
            $lista = $this->TurnoDepartamento->find('list', array(
                'conditions' => array('TurnoDepartamento.turno_provincia_codigo' => $pro_id),
                'fields' => array('departamento_codigo','nombre'))
            );
        }

        if($tipo == "localidades"){
            $this->loadModel('TurnoLocalidad');
            $lista = $this->TurnoLocalidad->find('list', array(
                'conditions' => array('TurnoLocalidad.turno_provincia_codigo' => $pro_id,'TurnoLocalidad.turno_departamento_codigo' => $dpto_id),
                'fields' => array('localidad_codigo','nombre'))
            );
        }
        $this->set(compact('tipo','lista'));
        $this->render('/Tramites/listas/select_pro_dpt_loc');
    }

    /**
     * [buscar_codigo_postal DEVUELVE EL CODIGO POSTAL DE LA LOCALIDAD SELECCIONADA]
     * @param  [type] $pro_id  [description]
     * @param  [type] $dpto_id [description]
     * @param  [type] $loca_id [description]
     * @return [type]          [description]
     */
    public function buscar_codigo_postal($pro_id,$dpto_id,$loca_id){
        $this->loadModel('TurnoLocalidad');
        $cp = $this->TurnoLocalidad->find('first', array(
            'conditions' => array('TurnoLocalidad.turno_provincia_codigo' => $pro_id,'TurnoLocalidad.turno_departamento_codigo' => $dpto_id,'TurnoLocalidad.localidad_codigo' => $loca_id),
            'fields' => array('cp'))
        );
        $this->autoRender = false;
        if(empty($cp)){
            return "0";
        }else{
            return $cp['TurnoLocalidad']['cp'];
        }
    }


    /**
     * [actualizaDatosPuntoVentas Actualiza los Datos Personales y si tiene ptos de Ventas los devuelve]
     * @param  [type] $info    [description]
     * @return [type]            [description]
     */
    private function actualizarDatosPuntoVentas($info){

            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
                <soapenv:Header/>
                    <soapenv:Body>
                        <cdr:WSCDR003a.Execute>
                            <cdr:Cdorgcod>'.$info['org_id'].'</cdr:Cdorgcod>
                            <cdr:Cdpetipdoc>'.$info['tip_doc'].'</cdr:Cdpetipdoc>
                            <cdr:Cdpenrodoc>'.$info['num_doc'].'</cdr:Cdpenrodoc>
                            <cdr:Cdpesexo>'.$info['sexo'].'</cdr:Cdpesexo>
                            <cdr:Cdpenacim>'.$info['fec_nac'].'</cdr:Cdpenacim>
                            <cdr:Cdpeapellido>'.$info['apellido'].'</cdr:Cdpeapellido>
                            <cdr:Cdpenombre>'.$info['nombre'].'</cdr:Cdpenombre>
                            <cdr:Cdpedomici>'.$info['domicilio'].'</cdr:Cdpedomici>
                            <cdr:Cdpenro>'.$info['domicilio_numero'].'</cdr:Cdpenro>
                            <cdr:Cdpecodpost>'.$info['codigo_postal'].'</cdr:Cdpecodpost>
                            <cdr:Salcpciacgo>'.$info['provincia'].'</cdr:Salcpciacgo>
                            <cdr:Salcdptcgo>'.$info['departamento'].'</cdr:Salcdptcgo>
                            <cdr:Salcdiscgo>'.$info['localidad'].'</cdr:Salcdiscgo>
                            <cdr:Cdpeteleffijo>'.$info['telefono'].'</cdr:Cdpeteleffijo>
                            <cdr:Cdpecelular>'.$info['tel_cel'].'</cdr:Cdpecelular>
                            <cdr:Cdpeemail>'.$info['email'].'</cdr:Cdpeemail>
                        </cdr:WSCDR003a.Execute>
                    </soapenv:Body>
                </soapenv:Envelope>';

            $urlWS = $this->awscdr003aPRD;

            $array = $this->curlConexion($urlWS,$post_string);
            
            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
                $result['flag'] = 0;
            }else{

                @$msj = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR003a.ExecuteResponse']['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
                @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR003a.ExecuteResponse']['Puntosventa']['PuntosVenta.PuntosVentaItem'];
                
                if(!empty($array)){
                    if ($array['Flagerror'] == 9) {
                        $result['mensaje'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
                        $result['flag'] = 2;
                    } else {
                        
                        $result = array();

                        $result['Estado'] = 1;
                        $result['Mensaje'] = $msj;
                        foreach ($array as $key => $ptoVenta) {
                            if (is_numeric($key)) {
                                $lista[$ptoVenta['CDPeVinc']] = $ptoVenta['CDPeDscVinc'];
                            }
                        }
                        $result['Lista'] = $lista;
                    }    
                }else{
                    $result['Estado'] = 0;
                    $result['Mensaje'] = 'No existen Puntos de Ventas Disponibles.';
                }
            }
        return $result;
    }


    /**
     * [turnoProvisorio GENERA EL TURNO PROVISORIO]
     * @param  [type] $info [description]
     * @return [type]       [description]
     */
    public function turnoProvisorio($info){

        set_time_limit(0);

        $this->autoRender = false;
        $this->layout = false;

        $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
            <soapenv:Header/>
                <soapenv:Body>
                    <cdr:WSCDR003b.Execute>
                        <cdr:Cdorgcod>'.$info['org_id'].'</cdr:Cdorgcod>
                        <cdr:Cdceidentif>'.$info['oficina'].'</cdr:Cdceidentif>
                        <cdr:Multiple>'.$info['org_mul'].'</cdr:Multiple>
                        <cdr:Cdtusegmento>'.$info['tur_pre'].'</cdr:Cdtusegmento>
                        <cdr:Cdpetipdoc>'.$info['tip_doc'].'</cdr:Cdpetipdoc>
                        <cdr:Cdpenrodoc>'.$info['num_doc'].'</cdr:Cdpenrodoc>
                        <cdr:Cdpesexo>'.$info['sexo'].'</cdr:Cdpesexo>
                        <cdr:Puntoventaefector>'.$info['pun_ven'].'</cdr:Puntoventaefector>
                        <cdr:Lineatramites>'.$info['tra_cod'].'</cdr:Lineatramites>
                    </cdr:WSCDR003b.Execute>
                </soapenv:Body>
            </soapenv:Envelope>';

        $urlWS = $this->awscdr003bPRD;

        $array = $this->curlConexion($urlWS,$post_string);
        
        //  ERROR DE CONEXIÓN CON EL WS
        if($array['Estado'] == 0){
            $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
            $result['flag'] = 0;
        }else{

            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR003b.ExecuteResponse'];

            $turno = array();
            $flagError = 1;
            $msjError =  $tipoError = "";
            $data['Turno'] = "";
            $data['Flag'] = $array['Flagerror'];
            if ($array['Flagerror'] == 9) {
                $flagError = 9;
                @$data['Mensaje'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
                @$data['CodError'] = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['CodMsg'];
                //echo $tipoError;
                //exit();
            } else {

                // echo CakeTime::format('2011-08-22 11:53:00', '%B %e, %Y %H:%M %p');
                // echo CakeTime::format('+2 days', '%c');
                $turno['FechaTurno'] = $array['Fechadelturno'];
                $turno['NumeroTurno'] = $array['Wturno'];
                $fecHor = explode("T", $array['Whhmm']);
                $turno['HoraTurno'] = date("H:i", strtotime($fecHor[1]));
                $turno['Segmento'] = $array['Wsegmento'];
                $i = 0;
                foreach ($array['Mensajescdr']['MensajesCDR.MensajesCDRItem'] as $key => $value) {
                    if (is_numeric($key)) {
                        if (!is_array($value['TextoMsg']))
                            $turno['Mensaje'][$i] = $value['TextoMsg'];

                        $i++;
                    }
                }

                $data['Turno'] = $turno;

                // //  GUARDO ESTA INFO PARA MOSTRARLA EN EL PASO 5
                // $this->Session->delete('InfoTurno');
                // $this->Session->write('InfoTurno', $data['Turno']);
            }

            // $this->set(compact('flagError', 'msjError', 'turno', 'tramite_texto'));
            // $this->render('/Turnos/ws03');
        }
        
        return $data;
    }

    /**
     * [tramite_impresion_constancia description]
     * @return [type] [impresión del comprobante de turno | SOLAMENTE PARA ORGANISMOS REGC]
     */
    private function tramite_impresion_constancia($codOrg = "REGC",$identif,$fecTur,$segmento,$nroTurno) {
        $this->autoRender = false;
        $this->layout = false;
        // $fecha = str_replace("-", "/", $fecTur);
        $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
            <soapenv:Header/>
                <soapenv:Body>
                    <cdr:WSCDR006b.Execute>
                        <cdr:Cdorgcod>' . $codOrg . '</cdr:Cdorgcod>
                        <cdr:Cdtuidentif>' . $identif . '</cdr:Cdtuidentif>
                        <cdr:Cdtufchturno>' . $fecTur . '</cdr:Cdtufchturno>
                        <cdr:Cdtusegmento>' . $segmento . '</cdr:Cdtusegmento>
                        <cdr:Cdtunroturno>' . $nroTurno . '</cdr:Cdtunroturno>
                    </cdr:WSCDR006b.Execute>
                </soapenv:Body>
            </soapenv:Envelope>';

        $urlWS = $this->awscdr006bPRD;

        $array = $this->curlConexion($urlWS,$post_string);

        $tramite = array();
        $flagError = 1;
        $msjError = "";
        $tramite['PDF'] = "";

        if($array['Estado'] == 0){
            $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
            $result['flag'] = 0;
        }else{
            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR006b.ExecuteResponse'];
            
            if ($array['Flagerror'] == 9) {
                $flagError = 9;
                $msjError = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];

            } else {
                if(count($array['Url_filename']) > 0)
                    $tramite['PDF'] = $array['Url_filename'];
            }
        }
        return $tramite;
    }


    /**
     * [tramite_enviar_mail description]
     * @return [type] [impresión del comprobante de turno | SOLAMENTE PARA ORGANISMOS REGC]
     */
    private function tramite_enviar_mail($codOrg = "REGC",$identif,$fecTur,$segmento,$nroTurno) {
        $this->autoRender = false;
        $this->layout = false;
        // $fecha = str_replace("-", "/", $fecTur);
        $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
            <soapenv:Header/>
                <soapenv:Body>
                    <cdr:WSCDR006c.Execute>
                        <cdr:Cdorgcod>' . $codOrg . '</cdr:Cdorgcod>
                        <cdr:Cdtuidentif>' . $identif . '</cdr:Cdtuidentif>
                        <cdr:Cdtufchturno>' . $fecTur . '</cdr:Cdtufchturno>
                        <cdr:Cdtusegmento>' . $segmento . '</cdr:Cdtusegmento>
                        <cdr:Cdtunroturno>' . $nroTurno . '</cdr:Cdtunroturno>
                    </cdr:WSCDR006c.Execute>
                </soapenv:Body>
            </soapenv:Envelope>';
            
        $urlWS = $this->awscdr006cPRD;

        $array = $this->curlConexion($urlWS,$post_string);
        
        $email = array();
        $flagError = 1;
        
        if($array['Estado'] == 0){
            $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
            $result['flag'] = 0;
        }else{
            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR006c.ExecuteResponse'];

            
            if ($array['Flagerror'] == 1) {
                $email['mensaje'] = "Se notificó vía e-mail la constancia del turno.";
                $email['estado'] = 1;
            }else{
                $email['mensaje'] = "";
                $email['estado'] = 9;
            }
        }

        return $email;
    }

    /**
     * [tramites_consulta description]
     * @return [type] [description]
     */
    public function tramites_consulta() {
        $this->autoRender = false;
        $this->layout = false;

        $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
            <soapenv:Header/>
                <soapenv:Body>
                    <cdr:WSCDR004.Execute>
                        <cdr:Cdpetipdoc>' . $this->request->data['tipo_doc'] . '</cdr:Cdpetipdoc>
                        <cdr:Cdpenrodoc>' . $this->request->data['num_doc'] . '</cdr:Cdpenrodoc>
                        <cdr:Cdpesexo>' . $this->request->data['sexo'] . '</cdr:Cdpesexo>
                    </cdr:WSCDR004.Execute>
                </soapenv:Body>
            </soapenv:Envelope>';
        
        $urlWS = $this->awscdr004PRD;

        $array = $this->curlConexion($urlWS,$post_string);

        if($array['Estado'] == 0){
            $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
            $result['flag'] = 0;
            return 0;
            exit();

        }else{

            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR004.ExecuteResponse'];

            $tramites = array();
            $flagError = 1;
            $msjError = "";

            if ($array['Flagerror'] == 9) {
                $flagError = 9;
                $msjError = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
            } else {
                $i = 0;
                foreach ($array['Turnosasignadosautogest']['TurnosAsignadosAutoGest.TurnosAsignadosAutoGestItem'] as $key => $value) {
                    if (is_numeric($key)) {
                        $tramites[$i] = $value;
                        $i++;
                    } else {
                        $indice = substr($key, 0, 1);
                        if ($indice != "0") {
                            $tramites[$i][$key] = $value;
                        }
                    }
                }
                
                //  VERIFICO SI TIENE IMPRESIÓN
                if(!empty($tramites)){
                    foreach ($tramites as $key => $tramite) {
                        $imp = $this->tramites_impresion($tramite['CDTuFchTurno'],$tramite['CDTuIdentif'],$tramite['CDTuSegmento'],$tramite['CDTuNroTurno']);
                        
                        if(strlen($imp['PDF'])>1){
                            $tramites[$key]['PDF'] = $imp['PDF'];
                        }


                        //  CONSULTA LA CONSTANCIA DEL TURNO (SOLO REGC)
                        if($tramite["CDOrgCod"] == "REGC"){

                            $pdfConstancia = $this->tramite_impresion_constancia("REGC",$tramite['CDTuIdentif'],$tramite['CDTuFchTurno'],$tramite['CDTuSegmento'],$tramite['CDTuNroTurno']);
                            
                            if(strlen($pdfConstancia['PDF'])>1){
                                $tramites[$key]['PDFconstancia'] = $pdfConstancia['PDF'];
                            }
                        }
                        
                    }
                }

                // private function tramite_impresion_constancia($codOrg = "REGC",$identif,$fecTur,$segmento,$nroTurno) {
            }
        }

        
        $this->set(compact('flagError', 'msjError', 'tramites'));
        $this->render('/Tramites/ver_tramites');
    }

    /**
     * [tramites_eliminar description]
     * @return [type] [description]
     */
    public function tramites_eliminar() {
        $this->autoRender = false;
        $this->layout = false;

        // if (!$this->Session->read('API.Api.ws_turno_activo')) {
        //     echo "1";
        //     exit();
        // }

        $fecha = str_replace("-", "/", $this->request->data['Cdtufchturno']);
        $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
            <soapenv:Header/>
                <soapenv:Body>
                   <cdr:WSCDR005.Execute>
                      <cdr:Cdtuidentif>' . $this->request->data['Cdtuidentif'] . '</cdr:Cdtuidentif>
                      <cdr:Cdtufchturno>' . $fecha . '</cdr:Cdtufchturno>
                      <cdr:Cdtusegmento>' . $this->request->data['Cdtusegmento'] . '</cdr:Cdtusegmento>
                      <cdr:Cdtunroturno>' . $this->request->data['Cdtunroturno'] . '</cdr:Cdtunroturno>
                   </cdr:WSCDR005.Execute>
                </soapenv:Body>
             </soapenv:Envelope>';

        $urlWS = $this->awscdr005PRD;

        $array = $this->curlConexion($urlWS,$post_string);
        
        if($array['Estado'] == 0){
            $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
            $result['flag'] = 0;
            return 0;
            exit();

        }else{

            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR005.ExecuteResponse'];

            $turnos = array();
            $flagError = 1;
            $msjError = "";

            if ($array['Flagerror'] == 9) {
                $flagError = 9;
                $msjError = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];
            } else {
                $i = 0;
                foreach ($array['Mensajescdr']['MensajesCDR.MensajesCDRItem'] as $key => $value) {
                    if ($key == "TextoMsg") {
                        $turnos['mensaje'][$i] = $value;
                        $i++;
                    }
                }
            }
        }

        $this->set(compact('flagError', 'msjError', 'turnos'));
        $this->render('/Tramites/listas/eliminar_tramite');
    }


    /**
     * [tramites_impresion description]
     * @return [type] [description]
     */
    private function tramites_impresion($fecTur,$identif,$segmento,$nroTurno) {
        $this->autoRender = false;
        $this->layout = false;

        $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
           <soapenv:Header/>
           <soapenv:Body>
              <cdr:WSCDR007.Execute>
                 <cdr:Cdtuidentif>' . $identif . '</cdr:Cdtuidentif>
                 <cdr:Cdtufchturno>' . $fecTur . '</cdr:Cdtufchturno>
                 <cdr:Cdtusegmento>' . $segmento . '</cdr:Cdtusegmento>
                 <cdr:Cdtunroturno>' . $nroTurno . '</cdr:Cdtunroturno>
              </cdr:WSCDR007.Execute>
           </soapenv:Body>
        </soapenv:Envelope>';

        $urlWS = $this->awscdr007PRD;

        $array = $this->curlConexion($urlWS,$post_string);

        $tramite = array();
        $flagError = 1;
        $msjError = "";
        $tramite['PDF'] = "";

        if($array['Estado'] == 0){
            $result['mensaje'] = "El servidor se encuentra suspendido. Intente luego. Disculpe las molestias.";
            $result['flag'] = 0;
        }else{
            @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR007.ExecuteResponse'];
            
            if ($array['Flagerror'] == 9) {
                $flagError = 9;
                $msjError = $array['Mensajescdr']['MensajesCDR.MensajesCDRItem']['TextoMsg'];

            } else {
                if(count($array['Url_filename']) > 0)
                    $tramite['PDF'] = $array['Url_filename'];
            }
        }
        return $tramite;
    }

   /**
     * [actualizar_tramites ACTUALIZA LA TBL turno_tramites para el sistema de TURNOS]
     * @return [type] [description]
     */
    public function actualizar_tramites_noajax() {
         $this->autoRender = false;
        //if ($this->request->is(array('post', 'ajax'))) {
       if (true) {     

            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
               <soapenv:Header/>
               <soapenv:Body>
                  <cdr:WSCDR001a.Execute>
                     <cdr:Codorganismo></cdr:Codorganismo>
                  </cdr:WSCDR001a.Execute>
               </soapenv:Body>
            </soapenv:Envelope>';

            $urlWS = $this->awscdr001aPRD;
            
            $array = $this->curlConexion($urlWS,$post_string);
			//print_r($array);
            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                
                return 0;
                //echo 'Error Conexion<br>';
                exit();
            }else{
            
                @$array = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR001a.ExecuteResponse']['Tramitescompleto']['TramitesCompleto.TramitesCompletoItem'];
                $result = array();
				
                //Debug 
                //print_r($result);
                //print_r($array);
				
                if(!empty($array)){
                    $this->loadModel('TurnoTramite');

                    $dataS = $this->TurnoTramite->getDataSource();
                    $dataS->begin();
                    $validaSQL = false;

                    //  ELIMINO TODA LA TABLA
                    $this->TurnoTramite->deleteAll(array('1 = 1'));
                    $cantTramites = 0;
					
                    //Debug
//                    $r = count($array);	
//                    echo "Antes del for each con $r registros<br>";
//                    $c = 0 ;
					
                    foreach ($array as $key => $tramite) {
						
                        //Debug 
//                        $c++;
//                        echo "Entro for each $c veces<br>";	
						

                        if (is_numeric($key)) {
                            //Debug
//                            echo "Cod Tramite: ".$tramite['CodTramite']."<br>";
//                            echo "Desc Tramite: ".$tramite['DscTramite']."<br>";
//                            echo "Cod Tramite: ".$tramite['RecomendTramite']."<br><br>";
							
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER = $this->TurnoTramite->find('first', array(
                                'conditions' => array('TurnoTramite.cod_tramite' => $tramite['CodTramite'])));
                            $TT = null;

                            // if(empty($VER)){
                            $this->TurnoTramite->create();
                            // }else{
                                // $TT['TurnoTramite']['id'] = $VER['TurnoTramite']['id'];
                            // }

                            $TT['TurnoTramite']['cod_organismo'] = $tramite['CodOrganismo'];
                            $TT['TurnoTramite']['cd_ce_identif'] = $tramite['CDCeIdentif'];
                            $TT['TurnoTramite']['cod_tramite'] = $tramite['CodTramite'];
                            $TT['TurnoTramite']['dsc_tramite'] = $tramite['DscTramite'];
                            $TT['TurnoTramite']['recomend_tramite'] = $tramite['RecomendTramite'];
                            $TT['TurnoTramite']['cd_tr_sector'] = $tramite['CDTRSector'];
                            $TT['TurnoTramite']['cd_tr_impre_boleta'] = $tramite['CDTRImpreBoleta'];
                            $TT['TurnoTramite']['cd_tr_imp_var'] = $tramite['CDTRImpVar'];
                            $TT['TurnoTramite']['cd_tr_grado'] = $tramite['CDTRGrado'];

                            if($this->TurnoTramite->save($TT)){
                                $cantTramites = $cantTramites +1;
                                $result['Tramites']['Exito'][$key]['CodTramite'] = $tramite['CodTramite'];
                                $validaSQL = true;
                            }else{
                                $result['Tramites']['Error'][$key]['CodTramite'] = $tramite['CodTramite'];
                            }
                        }
                    }
                    $result['Resultado'] = 'Base de Datos de Trámites Actualizado.';
                    $result['Tramites']['Cantidad'] = $cantTramites;
                    $result['Tramites']['Estado'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";


                    if ($validaSQL) {
                        $dataS->commit();
                    }else{
                        $dataS->rollback();
                        $result['Tramites']['Estado'] = "<strong style='color:red;'>ERROR AL ACTUALIZAR TABLAS</strong>";
                    }
                }else{
                    $result['Resultado'] = 'Error en la estructura XML.';
                }
            }
        } else {
            $result['Resultado'] = 'Imposible realizar esta acción.';
        }

        //return json_encode($result);
        $resp = json_encode($result);
        $this->set(compact('resp'));
        $this->render('/Tramites/actualizar_tramites_noajax');        
    }
    
    /**
     * [actualizar_organismos ACTUALIZA LA TBL turno_organismos para el sistema de TURNOS]
     * @return [type] [description]
     */
    public function actualizar_organismos_noajax() {
        $this->autoRender = false;
        //if ($this->request->is(array('post', 'ajax'))) {
        if (true) {              
            
            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cdr="cdr">
               <soapenv:Header/>
               <soapenv:Body>
                  <cdr:WSCDR001b.Execute/>
               </soapenv:Body>
            </soapenv:Envelope>';

            $urlWS = $this->awscdr001bPRD;
            
            $array = $this->curlConexion($urlWS,$post_string);

            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                
                return 0;
                exit();
            }else{
                
                $cantOrganismos = 0;
                $cantOficinas = 0;

                @$organismos = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR001b.ExecuteResponse']['Organismos']['Organismos.OrganismosItem'];
                @$oficinas = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSCDR001b.ExecuteResponse']['Organoficina']['OrganOficina.OrganOficinaItem'];
                $result = array();

                $result['Resultado'] = 'Base de Datos No Actualizada.';

                //  GUARDO LOS ORGANISMOS
                if(!empty($organismos)){
                    $this->loadModel('TurnoOrganismo');

                    $dataS = $this->TurnoOrganismo->getDataSource();
                    $dataS->begin();
                    $validaSQL = false;


                    //  ELIMINO TODA LA TABLA
                    $this->TurnoOrganismo->deleteAll(array('1 = 1'));

                    foreach ($organismos as $key => $dato) {

                        if (is_numeric($key)) {
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER = $this->TurnoOrganismo->find('first', array(
                                'conditions' => array('TurnoOrganismo.cd_cod_org' => $dato['CDOrgCod'])));
                            $TT = null;

                            $this->TurnoOrganismo->create();

                            $TT['TurnoOrganismo']['cd_cod_org'] = $dato['CDOrgCod'];
                            $TT['TurnoOrganismo']['cd_org_dsc'] = $dato['CDOrgDsc'];
                            $TT['TurnoOrganismo']['cd_org_tramites'] = $dato['CDOrgTramites'];
                            $TT['TurnoOrganismo']['cd_org_multiple'] = $dato['CDOrgMultiple'];
                            $TT['TurnoOrganismo']['cd_org_grado'] = $dato['CDOrgGrado'];

                            if($this->TurnoOrganismo->save($TT)){
                                $cantOrganismos = $cantOrganismos+1;
                                $result['Organismos']['Exito'][$key]['CDOrgCod'] = $dato['CDOrgCod'];
                                $validaSQL = true;
                            }else{
                                $result['Organismos']['Error'][$key]['CDOrgCod'] = $dato['CDOrgCod'];
                            }
                        }

                    }
                    $result['Resultado'] = 'Base de Datos de Organismos Actualizado.';
                    $result['Info']['Estado'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";
                    unset($TT);

                    if ($validaSQL) {
                        $dataS->commit();
                    }else{
                        $dataS->rollback();
                    }

                    //  GUARDO LAS OFICINAS
                    if(!empty($oficinas)){
                        $this->loadModel('TurnoOficina');

                        $dataS = $this->TurnoOficina->getDataSource();
                        $dataS->begin();
                        $validaSQL = false;

                        //  ELIMINO TODA LA TABLA
                        $this->TurnoOficina->deleteAll(array('1 = 1'));

                        foreach ($oficinas as $key1 => $dato1) {

                            if (is_numeric($key1)) {
                                //  VERIFICO SI EXISTE O NO EL TRÁMITE
                                $VER1 = $this->TurnoOficina->find('first', array(
                                    'conditions' => array('TurnoOficina.organismo_codigo' => $dato1['CDOrgCod'], 'TurnoOficina.cd_ce_identif' => $dato1['CDCeIdentif'])));
                                $TT = null;
                                
                                $this->TurnoOficina->create();

                                $TT['TurnoOficina']['organismo_codigo'] = trim($dato1['CDOrgCod']);
                                $TT['TurnoOficina']['cd_ce_identif'] = $dato1['CDCeIdentif'];
                                $TT['TurnoOficina']['cd_ce_telef'] = $dato1['CDCeTelef'];
                                $TT['TurnoOficina']['cd_ce_domici'] = $dato1['CDCeDomici'];
                                $TT['TurnoOficina']['cd_ce_denom'] = $dato1['CDCeDenom'];
                                
                                if($this->TurnoOficina->save($TT)){
                                    $result['Oficinas']['Exito'][$key1]['CDOrgCod'] = $dato1['CDOrgCod'];
                                    $cantOficinas = $cantOficinas+1;
                                    $validaSQL = true;
                                }else{
                                    $result['Oficinas']['Error'][$key1]['CDOrgCod'] = $dato1['CDOrgCod'];
                                }
                            }

                        }
                        $result['Resultado'] = $result['Resultado'].'. Base de Datos de Oficinas Actualizado.';

                        if ($validaSQL) {
                            $dataS->commit();
                        }else{
                            $dataS->rollback();
                        }
                    }else{
                        $result['Resultado'] = $result['Resultado'].'. Error en la estructura XML (Oficinas).';
                    }

                    $result['Organismos']['Cantidad'] = $cantOrganismos;
                    $result['Oficinas']['Cantidad'] = $cantOficinas;

                }else{
                    $result['Resultado'] = 'Error en la estructura XML (Organismos).';
                }

            }
        } else {
            $result['Resultado'] = 'Imposible realizar esta acción.';
        }

        //return json_encode($result);
        $resp = json_encode($result);
        $this->set(compact('resp'));
        $this->render('/Tramites/actualizar_organismos_noajax');           
    }


    /**
     * [actualizar_registros_titulos ACTUALIZA LA TBL turno_registros y turno_titulos para el sistema de TURNOS]
     * @return [type] [description]
     */
    public function actualizar_registros_titulos_noajax() {
        $this->autoRender = false;
        //if ($this->request->is(array('post', 'ajax'))) {
        if (true) {

            set_time_limit(0);

            $this->autoRender = false;
            $this->layout = false;

            $post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sam="SAMEPEv1">
               <soapenv:Header/>
               <soapenv:Body>
                  <sam:WSRegisTitulos.Execute/>
               </soapenv:Body>
            </soapenv:Envelope>';

            $urlWS = $this->awsregistitulosPRD;
            
            $array = $this->curlConexion($urlWS,$post_string);
            
            //  ERROR DE CONEXIÓN CON EL WS
            if($array['Estado'] == 0){
                
                return 0;
                exit();
            }else{
                
                //  SELECCIONO LAS OFICINAS
                @$registros = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSRegisTitulos.ExecuteResponse']['Sdtregistros']['SDTRegistros.SDTRegistrosItem'];
                @$titulos = $array['Rest']['SOAP-ENV:Envelope']['SOAP-ENV:Body']['WSRegisTitulos.ExecuteResponse']['Sdttitulos']['SDTtitulos.SDTtitulosItem'];
                $result = array();

                $result['Resultado'] = 'Base de Datos No Actualizada.';
                
                $cantTitulos = 0;
                $cantRegistros = 0;

                //  GUARDO LOS ORGANISMOS
                if(!empty($registros)){
                    $this->loadModel('TurnoRegistro');

                    $dataS = $this->TurnoRegistro->getDataSource();
                    $dataS->begin();
                    $validaSQL = false;

                    //  ELIMINO TODA LA TABLA
                    $this->TurnoRegistro->deleteAll(array('1 = 1'));

                    foreach ($registros as $key => $dato) {

                        if (is_numeric($key)) {
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER = $this->TurnoRegistro->find('first', array(
                                'conditions' => array('TurnoRegistro.ms_reg_cod' => $dato['MSRegCod'])));
                            $TT = null;
                            $this->TurnoRegistro->create();

                            $TT['TurnoRegistro']['ms_reg_cod'] = $dato['MSRegCod'];
                            $TT['TurnoRegistro']['ms_reg_desc'] = $dato['MSRegDsc'];

                            $cantRegistros = $cantRegistros+1;

                            if($this->TurnoRegistro->save($TT)){
                                $result['Registros']['Exito'][$key]['MSRegCod'] = $dato['MSRegCod'];
                                $validaSQL = true;
                            }else{
                                $result['Registros']['Error'][$key]['MSRegCod'] = $dato['MSRegCod'];
                            }
                        }

                    }

                    $result['Resultado'] = 'Base de Datos de Registros Actualizado.';
                    $result['Info']['EstadoRegistros'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";

                    unset($TT);

                    if ($validaSQL) {
                        $dataS->commit();
                    }else{
                        $dataS->rollback();
                    }
                }else{
                    $result['Resultado'] = 'Error en la estructura XML (Registros).';
                }


                //  GUARDO LAS OFICINAS
                if(!empty($titulos)){
                    $this->loadModel('TurnoTitulo');

                    $dataS = $this->TurnoTitulo->getDataSource();
                    $dataS->begin();
                    $validaSQL = false;

                    //  ELIMINO TODA LA TABLA
                    $this->TurnoTitulo->deleteAll(array('1 = 1'));

                    foreach ($titulos as $key1 => $dato1) {

                        if (is_numeric($key1)) {
                            //  VERIFICO SI EXISTE O NO EL TRÁMITE
                            $VER1 = $this->TurnoTitulo->find('first', array(
                                'conditions' => array('TurnoTitulo.registro_codigo' => $dato1['MsRegCod'],'TurnoTitulo.ms_tit_cod' => $dato1['MSTitCod'])));
                            $TT = null;
                            $this->TurnoTitulo->create();

                            $TT['TurnoTitulo']['registro_codigo'] = trim($dato1['MsRegCod']);
                            $TT['TurnoTitulo']['ms_tit_cod'] = $dato1['MSTitCod'];
                            $TT['TurnoTitulo']['ms_tit_dsc'] = $dato1['MSTitDsc'];
                            $TT['TurnoTitulo']['ms_tit_grado'] = $dato1['MsTitGrado'];

                            $cantTitulos = $cantTitulos+1;
                            if($this->TurnoTitulo->save($TT)){
                                $validaSQL = true;
                            }else{

                            }

                        }
                    }

                    $result['Resultado'] = $result['Resultado'].'. Base de Datos de Titulos Actualizado.';
                    $result['Info']['EstadoTitulos'] = "<strong style='color:green;'>ACTUALIZACIÓN EXITOSA</strong>";

                    if ($validaSQL) {
                        $dataS->commit();
                    }else{
                        $dataS->rollback();
                    }
                }else{
                    $result['Resultado'] = $result['Resultado'].'. Error en la estructura XML (Titulos).';
                    $result['Info']['EstadoTitulos'] = "<strong style='color:red;'>ERROR AL ACTUALIZAR TABLAS</strong>";
                }

                $result['Titulos']['Cantidad'] = $cantTitulos;
                $result['Registros']['Cantidad'] = $cantRegistros;
            }
        } else {
            $result['Resultado'] = 'Imposible realizar esta acción.';
        }


        //return json_encode($result);
        $resp = json_encode($result);
        $this->set(compact('resp'));
        $this->render('/Tramites/actualizar_registros_titulos_noajax'); 
    }
	
}

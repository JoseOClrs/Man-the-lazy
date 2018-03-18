<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Principal;


class PrincipalController extends AbstractActionController
{
    public function principalAction()
    {
            if (isset($_SESSION['auth'])) {

            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
            $principalModel = new Principal($this->dbAdapter);
  
            if ($this->getRequest()->isXmlHttpRequest()) {
                //para AJAX
            } else if ($this->getRequest()->isPost()) {
                //Desde formulario POST
                //Recuperar los datos de los campos del formulario
                $datosFormularios = $this->request->getPost()->toArray();
                $datosFormularios['usuario'] = $_SESSION['usuario'];              
                $datosFormularios['Fecha'] = date('Y-m-d');
               
          $proyeccion	 = $datosFormularios['Proyeccion'];
                $comprobarDatos = $proyeccion;
       
                //echo '<pre>'; print_r($datosFormularios); exit;
          
          
          
           if ($comprobarDatos == '') {

                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/principal");
                } else {

                    if ($principalModel->agregarNuevo($datosFormularios) == 0) {
                        //En caso de error al guardar
                    } else {
                        //En caso de guardado correcto

                     //   echo "<script type='text/javascript'>alert('Se guardo correctanmente');</script>";
                        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/principal");
                    }
                }// fin if de comprobacion 
            } else {
                //Normal GET


                return new ViewModel();
            }
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }
    
    
    
    
    public function crearpersonaAction() {
        if (isset($_SESSION['auth'])) {
            if ($this->getRequest()->isXmlHttpRequest()) {
                //para AJAX
            } else if ($this->getRequest()->isPost()) {
                //Desde formulario POST
                //Recuperar los datos de los campos del formulario
                $datosFormularios = $this->request->getPost()->toArray();
                $datosFormularios['estado'] = "activo";
                
//            $datosFormularios['fecha'] = date('Y-m-d H:i:s');
//            unset($datosFormularios['estado']);
//
//                         echo '<pre>';
//                       print_r($datosFormularios);
//                  exit;


                $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');


                $personasModel = new Personas($this->dbAdapter);


                $nombre = $datosFormularios['nombre'];
                $comprobarDatos = $nombre;

//          echo'<pre>';
//          print_r($comprobarDatos);
//           exit;
//          echo'<pre>';
//          print_r($datosFormularios['nombre'] );
//           exit;
//           
                if ($comprobarDatos == '') {

                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/persona/crearpersona");
                } else {

                    if ($personasModel->agregarNuevo($datosFormularios) == 0) {
                        //En caso de error al guardar
                    } else {
                        //En caso de guardado correcto




                        echo "<script type='text/javascript'>alert('Se guardo correctanmente');</script>";
                        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/persona");
                    }
                }// fin if de comprobacion 
            } else {
                //Normal GET


                return new ViewModel();
            }
        } else {
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
    }
}

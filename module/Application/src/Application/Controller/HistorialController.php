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
use Application\Model\Historial;

class HistorialController extends AbstractActionController {

    public function historialAction() {
        if (isset($_SESSION['auth'])) {

            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

            $historialModel = new Historial($this->dbAdapter);
            $historial = $historialModel->getAll();
               $jsonobjet = \Zend\Json\Json::encode($historial);
                     
//            echo '<pre>';
//         print_r($historial);          
//         exit;  
                return new ViewModel(array('historial' => $historial,'json'=>$jsonobjet));
            }
    
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
        }
          public function historialmovilAction() {
 

            $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

            $historialModel = new Historial($this->dbAdapter);
            $historial = $historialModel->getAll();
            
            $jsonobjet = \Zend\Json\Json::encode($historial);
//            echo '<pre>';   print_r($historial);   exit;  
            
               print_r($jsonobjet);   exit;  
            
            
             return new ViewModel(array('json'=>$jsonobjet));
            
        }
    }



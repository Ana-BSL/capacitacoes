<?php

namespace common\controllers;

use yii\web\Controller;
use yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controllers
 *
 * @author smsti01
 */
abstract class BaseController extends Controller{
  
    const SUPER_ADMIN_ROLE="SuperAdmin";
    const ADMIN_ROLE="admin";
    //const MENU_FRONTEND_PATH="/opt/lampp/htdocs/tuiva/frontend/themes/lte/layouts/menu";
    
    
    public function init()
    {
        parent::init();
    }
    
    /**
     * Deve retornar o nome a ser utilizado no método factoryActionName().
     */
    protected function getModelName() {
        return yii::$app->controller->id;
    }

    
    /**
     * Devolve o nome da action mais o modelo para verificar o acesso.
     * Segue o seguinte padrão: id da action +  o nome fornecido pelo método getModelName()
     */
    public function factoryActionName() {
        //$this->get
        
        return $this->getModelName().yii::$app->controller->action->id;
    }

    /**
     * Verifica o acesso a action usando o metodo factoryActionName().
     */
    protected function CheckAcess() {
       if(!Yii::$app->user->can($this->factoryActionName())){
           $this->redirect('permission-denied');
       }
    }
    
    public function actionPermissionDenied(){
        return $this->render('@common/views/base/deny');
    }
    
    private static function hasRole($role) {
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        if(array_key_exists($role,$roles)){
            return true;
        }
        return false;
    }
    
    public static function isAdmin() {
        return BaseController::hasRole(BaseController::ADMIN_ROLE);
    }
    public static function getMenu($m=null) {
         $path = Yii::$app->basePath.'/themes/lte/layouts/menu';
         $menu=[];
         $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
         foreach ($roles as $key=>$value) {
             if(file_exists($path.'/'.$key.'.php')){
                 $menu[] = require($path.'/'.$key.'.php');
             }
         }
         if($m!=null){
             $menu = array_merge($m,$menu);
         }
         return $menu;
    }
}

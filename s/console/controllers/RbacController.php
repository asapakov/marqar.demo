<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;
        
        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...
        
        // Создадим роли админа и опросника
        $admin = $auth->createRole('admin');
        $surveyer = $auth->createRole('surveyer');
        
        // запишем их в БД
        $auth->add($admin);
        $auth->add($surveyer);
        
        // Создаем разрешения. Например, просмотр админки viewAdminPage и takeSurvey
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';
        
        $takeSurveys = $auth->createPermission('takeSurvey');
        $takeSurveys->description = 'Провести опрос';
        
        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($takeSurveys);
        
        // Теперь добавим наследования. Для роли surveyer мы добавим разрешение takeSurveys,
        // а для админа добавим наследование от роли surveyer и еще добавим собственное разрешение viewAdminPage
        
        // Роли «Редактор новостей» присваиваем разрешение «Редактирование новости»
        $auth->addChild($surveyer,$takeSurveys);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $surveyer);
        
        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1); 
        
        // Назначаем роль editor пользователю с ID 2
        $auth->assign($surveyer, 2);
    }
}
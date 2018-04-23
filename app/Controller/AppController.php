<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = [
        'RequestHandler',
        'Session',
        'Flash',
        'Cookie',
        'Auth' => [
                'loginRedirect' => ['controller' => 'users', 'action' => 'myaccount'],
            'logoutRedirect' => ['controller' => 'promotion_codes', 'action' => 'idnex'],
            'authenticate' => [
                'Form' => ['userModel' => 'User',
                    'contain' => [
                        'UserRole' => ['fields' => ['id', 'title', 'alias']],
                    ],
                    'fields' => ['username' => 'email'],
                    'scope' => ['status' => 1]
                ],
            ],
            'authorize' => ['Controller']
        ],
    ];
    var $helpers = ['Form', 'Time', 'Html', 'Session'];
    var $counter = 0;

    /**
     * before rendering callback
     */
    public function beforeFilter()
    {
        // Controller autorization is the simplest form.
        $this->Auth->flash = ['element' => 'auth/info','key' => 'auth','params' => []];
        $this->Auth->allow('index', 'display', 'login', 'logout');
        $this->set('actLang', $this->_getLangCode(2));
    }

    /**
     * Custom isAuthorized() method. Needed only when Auth->authorize is set to 'controller'
     *
     * @return boolean
     */
    public function isAuthorized($user = null) {
        //var_dump($user);

        //debug($this->action);
        //debug($this->Auth);
        //debug($this->Auth->user());
        //reset Aut redirect, so it is always    redirected to dashboard, not to "remembered" page.
        //$this->Session->write('Auth.redirect', null);
        //$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard', 'prefix' => 'admin', 'admin' => true);
        //debug($this->permissions[$this->action]);
        $userRole = $this->Auth->user('UserRole.alias');

        if ($userRole == 'admin') {
            $this->set("isDirector", true);
            $this->Session->write('Auth.User.isDirector', true);
            //if user is director allow all actions
            return true;
        }

        if(!empty($this->permissions[$this->action])) {
            $this->set("isDirector", false);
            $this->Session->write('Auth.User.isDirector', false);
            if($this->permissions[$this->action] == '*') {
                return true;
            }
            if (in_array($userRole, $this->permissions[$this->action])) {
                return true;
            }
        }
        $this->set("isDirector", false);
        $this->Session->write('Auth.User.isDirector', false);
        $this->Auth->authError = __('You can not access this part of the page.');
        return false;
    }


    /**
     * returnts current active language either 2 or 3 letter code
     *
     * @param int $lng  :   lenght of code example: 2 - en, 3 - eng
     * @return string
     */
    protected function _getLangCode($lng = 2) {
        if (empty($this->modelClass)) {
            App::uses('User', 'Model');
            $MyUser = new User();
            return $MyUser->_getActiveLang($lng);
        } else {
            return $this->{$this->modelClass}->_getActiveLang($lng);
        }

    }


}

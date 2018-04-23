<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
    
    /* define permissions - key = action, value - array of groups, '*' means all groups*/
    public $permissions = [
        'myaccount' => '*'
    ];

    /**
    * Components
    *
    * @var array
    * @access public
    */
	public $components = [
        'Email',
        'Paginator',
    ];

    /**
    * beforeFilter
    *
    * @return void
    * @access public
    */
	public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(
            'login',
            'logout',
            'register',
            'navigationitems'
        );
	}

    /**
     * returns navigation items
     *
     * @return array
     */
    public function navigationitems() {
        if (!empty($this->request->params['requested'])) {
            $navs = array();
            $navs['usermenu'] = $this->User->getUserMenu();
            return $navs;

        }
    }

    /**
     * user registration
     *
     * @return CakeResponse|null
     */
    public function register() {
        
        if ($this->request->is('post'))
        {
            $res = $this->User->register($this->request->data);
            if ($res['success'] === true) {
                $this->Flash->success($res['msg']);
                //redirect to thankypu page
                return $this->redirect(array('controller' => 'promotion_codes', 'action' => 'index'));
            }
            $this->Flash->error($res['msg']);
        }
    }


    /**
     * handle user login
     *
     * @param string $type
     * @return CakeResponse|null
     */
    public function login($type='user') {
        if ($this->request->is('post')) {
            $isActive = $this->User->_isActivated($this->request->data);
            if ($this->Auth->login()) {

                if ($isActive) {
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error('Your email was not been verified, check your Inbox for email verification message.');
                }
                //die();
            }
            $this->Flash->error('Incorrect emial or password!');
        }
    }

    /**
     * logout method
     *
     * @return CakeResponse|null
     */
    public function logout() {
        $this->Session->destroy();
        return $this->redirect($this->Auth->logout());
    }

    /**
     * display my account
     */
    public function myaccount() {

    }
}
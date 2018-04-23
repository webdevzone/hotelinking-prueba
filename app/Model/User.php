<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * user status values:
 *
 * 0 - new registerd user, not activation code used
 * 1 - normal active user, activation code used (activation_date > 0)
 *
 * 3 - forgottpassword used
 *
 * 99 - user deactivated by admin
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'email';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = [
        'first_name' => [
            'notBlank' => [
                'rule' => ['notBlank'],
                'message' => 'Enter your first name',
            ],

        ],
        'last_name' => [
            'notBlank' => [
                'rule' => ['notBlank'],
                'message' => 'Enter valid surname',
            ],

        ],
        'password' => [
            'alphaNumeric' => [
                'rule'     => 'alphaNumeric',
                'message'  => 'Minimum 6 alfanumeric characters is required',
                'last' => true,
            ],
            'minLength' => [
                'rule' => ['minLength', '6'],
                'message'  => 'Minimum 6 alfanumeric characters is required',
                'last' => true,
            ],
        ],
        '_password' => [
			'rule' => 'validIdentical',
	    ],
        'email' => [
            'unique' => [
                'rule'    => 'isUnique',
                'message' => 'This email is already used.'
            ],
            'email' => [
                'rule' => ['email', true],
                'message' => 'Enter valid email',
            ],
            'notBlank' => [
                'rule' => ['notBlank'],
                'message' => 'Enter valid email',
            ],

        ],
        'agree_tos' => [
            'notBlank' => [
                'rule' => ['comparison', '!=', 0],//'checkAgree',
                'message' => 'You have to agree TOS',
                'allowEmpty' => false,
                'required' => true,
                'on' => 'register', // Limit validation to 'create' or 'update' operations
            ],
        ],

    ];


    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

    /**
    * belongsTo associations
    *
    * @var array
    */
	public $belongsTo = array(
		'UserRole' => array(
			'className' => 'UserRole',
			'foreignKey' => 'user_role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    /**
     * hasMany associations
     *
     * @var array
     */
	public $hasMany = array(
		'PromotionCode' => array(
			'className' => 'PromotionCode',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
		),
	);








    /**
    * _identical
    *
    * @param string $check
    * @return boolean
    * @deprecated Protected validation methods are no longer supported
    */
    protected function _identical($check) {
        return $this->validIdentical($check);
    }

    /**
    * validIdentical
    *
    * @param string $check
    * @return boolean
    */
	public function validIdentical($check) {
		if (isset($this->data['User']['password'])) {
			if ($this->data['User']['password'] != $check['_password']) {
				return __('Passwords does not matc. Please fix error and try again.');
			}
		}
		return true;
	}

    /**
     * getUserRolesOptions method
     *
     * returns available user roles list
     *
     * @param array $type : if we want to get only certain roles, user array with selected types (admin,member, guest)
     *                      refer to user_roles table for additional aliases
     * @return array
     */
    public function getUserRolesOptions($type = []) {
        $cond = ['UserRole.id > ' => 0 ];
        if (!empty($type)) {
            $cond['UserRole.alias'] = $type;
        }
        $rs = $this->UserRole->find('list', ['conditions' => $cond,]);
        return $rs;
    }


    /**
     * generates random string for user activation
     *
     * @return string
     */
    public function generateActivationKey() {
        $key = $this->generateRandomString(15);
        //check if string exists
        $rs = $this->find('first', [
            'recursive' => -1,
            'fields' => ['id'],
            'conditions' => ['activation_key' => $key],
        ]);
        if (!empty($rs)) {
            $this->generateActivationKey();
        }
        return $key;
    }

    /**
     * generates random string for forgot password
     *
     * @return string
     */
    public function generateForgotpasswordKey() {
        $key = $this->generateRandomString(20);
        //check if string exists
        $rs = $this->find('first', [
            'recursive' => -1,
            'fields' => ['id'],
            'conditions' => ['forgotpassword_key' => $key],
        ]);
        if (!empty($rs)) {
            $this->generateForgotpasswordKey();
        }
        return $key;
    }


    /**
     * returns user data
     *
     * @param $id   :   given user id
     * @return array
     */
    public function getUserDetails($id)
    {
        $rs = $this->find('first', [
            'recursive' => -1,
            'conditions' => ['User.id' => $id],
            'contain' => [
                'UserRole' => ['fields' => ['id', 'title', 'alias']],
                'PromotionCode',
            ],
        ]);
        return $rs;
    }

    /**
     * method for registering new users.
     *
     * @param $data :   user data received from registration form
     * @return array
     */
    public function register($data)
    {
        $rs = [];
        $this->set($data);
        //debug($this->validationErrors);
        if ($this->validates()) {
            //debug($this->validationErrors);
            $data['User']['user_role_id'] = 2;
            $data['User']['activation_key'] = $this->generateActivationKey();
            $data['User']['status'] = 1; //for this set we set the user active instantly
            $data['User']['is_active '] = 1; //for this set we set the user active instantly
            //save user
            $this->create();
            $user = $this->save($data);
            if ($user) {
                $rs['success'] = true;
                $rs['msg'] = __('Your user account was successfuly created.');
                $rs['msgclass'] = 'alert alert-success';
            } else {
                $rs['success'] = false;
                $rs['msg'] = __('There was an error creating your uer account.');
                $rs['msgclass'] = 'alert alert-danger';
            }

        } else {
            $rs['success'] = false;
            $rs['msg'] = __('User account was not created, fix errors and try again.');
            $rs['msgclass'] = 'alert alert-danger';
        }
        return $rs;
    }

    /**
     * check if user is registered
     *
     * @param $data :   user data to check, must contain user email.
     * @return bool
     */
    public function _isActivated($data)
    {
        $rs = $this->find('first', [
            'recursive' => -1,
            'conditions' => ['User.email' => $data['User']['email']]
        ]);
        //debug($rs);
        if (!empty($rs)) {
        	if ($rs['User']['status'] == 1) {
            	return true;
        	}
    	}
        return false;
    }

    /**
     * returns user menu depending on login state  myaccount,logout VS login,register
     *
     * @return array
     */
    public function getUserMenu()
    {
        $user = AuthComponent::user();
        $userIsLoggedIn = false;
        if (!empty($user))
        {
            $userIsLoggedIn = true;
            $userDT = $this->find('first', array(
                'conditions' => array('User.id' => $user['id'])
            ));
        }
        //debug($user);

        $menu = array();
        if ($userIsLoggedIn)
        {
            //debug($user);
            if ($userDT['User']['user_role_id'] == 4 || $userDT['User']['user_role_id'] == 6)
            {
                $name = $userDT['User']['first_name'].' '.$userDT['User']['last_name'].' ('.$userDT['UserDetail']['company_name'].')';
                $url = array('controller' => 'users', 'action' => 'emyaccount', 'ext' => 'html');
            }
            else
            {
                $name = $userDT['User']['first_name'].' '.$userDT['User']['last_name'];
                $url = array('controller' => 'users', 'action' => 'myaccount', 'ext' => 'html');
            }
            $menu['myacountname'] = array(
                'label' => '<i class="fa fa-user"></i> <span class="email hidden-xs">'.$name.'</span>',
                'url' => $url,
                'isActive' => false,
                'class' =>'loggedin btn btn-success navbar-btn',
                'title' => __('Logged-in').' '.$name,
            );
            $menu['logout'] = array(
                'label' => '<i class="fa fa-power-off"></i> <span class="hidden-xs">'.__('Logout').'</span>',
                'url' => array('controller' => 'users', 'action' => 'logout', 'ext' => 'html'),
                'isActive' => false,
                'class' =>'logout btn btn-dark navbar-btn',
            );
        }
        else
        {
            $menu['register'] = array(
                'label' => __('Register'),
                'url' => array('controller' => 'users', 'action' => 'register', 'ext' => 'html'),
                'isActive' => false,
                'class' =>'btn btn-warning register'
            );
            $menu['login'] = array(
                'label' => __('Log-in'),
                'url' => array('controller' => 'users', 'action' => 'login', 'ext' => 'html'),
                'isActive' => false,
                'class' =>'btn btn-danger navbar-btn',
                'title' => __('Simple login in app')
            );
        }
        return $menu;
    }


}
<?php
//debug($_SESSION);
//debug($this->here);
//debug($this->request->params['ident']);
$actLang = $this->Session->read('Config.language');
//temp fix for remote server, removing the ?url part from the redirect string
$redirect = $this->Session->read('Auth.redirect');
$redirect = strstr($redirect, '?', true);
if ($redirect === false)
{
    $redirect = $this->Session->read('Auth.redirect');
}
//debug($redirect);

$ver = 'CakePHP '.Configure::version();
$year = Configure::read('Config.author.projectstart');
if ($year < date('Y'))
{
    $year = $year.' - '.date('Y');
}

$copyNote = ' &copy; '.$year;
$copyNote .= ' | '.$ver;

echo $this->Form->create('User', array(
    'url' => array('controller' => 'users', 'action' => 'login', 'admin' => true, 'prefix' => 'admin'),
    'inputDefaults' => array(
        'div' => 'form-group',
        'error' => ['attributes' => ['wrap' => 'div', 'class' => 'invalid-feedback']],
        'required' => false,
    ),
    'class' => 'form-signin',

));

$prependUser = '<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fal fa-user"></i></span></div>';
$prependPswd = '<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fal fa-key"></i></span></div>';
?>
<h2 class="form-signin-heading"><?= __('Please, log-in'); ?></h2>
<?php
echo $this->Session->flash('auth', ['element' => 'error']);

echo $this->Form->input('email', [
    'label' => ['text' => __('E-mail'), 'class' => 'sr-only'],
    'type' => 'text',
    'placeholder' => __('E-mail'),
    'div' => 'form-group mb-3',
    'class' => 'form-control',
]);

echo $this->Form->input('password', [
    'label' => ['text' => __('Password'), 'class' => 'sr-only'],
    'type' => 'password',
    'placeholder' => __('Password'),
    'div' => 'form-group mb-3',
    'class' => 'form-control',
]);



echo '<button class="btn btn-lg btn-secondary btn-block" type="submit">'.__d('admin', 'Log in').'</button>';



echo  $this->Html->link(__('Register'),
    ['controller' => 'users', 'action' => 'register', 'ext' => 'html'],
    ['class' => 'btn btn-link']
);

echo $this->Form->end();
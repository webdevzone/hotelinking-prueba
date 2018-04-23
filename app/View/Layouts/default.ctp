<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$siteName = __('devzone');
$siteurl_for_layout = (!isset($siteurl_for_layout)) ? Router::url( $this->here, true ) : $siteurl_for_layout;
if (!isset($desc_for_layout)) {
    $desc_for_layout = __('');
}
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());

$pageJS = [
    Configure::read('Config.assets').'jquery/3.3.1/jquery-3.3.1.min.js',
    Configure::read('Config.assets').'popper/1.12.9/popper.min.js',
    Configure::read('Config.assets').'bootstrap/4.0/js/bootstrap.min.js',
	//'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',
	//'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
	//'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
	'frontend.js',
];
$pageCss = [
	Configure::read('Config.assets').'bootstrap/4.0/css/bootstrap.min.css',
	//'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'style'
];

$this->Html->css($pageCss, null, ['block' => 'css']);
?>
<!doctype html>
<html lang="<?=$actLang?>">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
        $this->Html->meta(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=9, IE=edge,chrome=1'], null, ['block' => 'meta']);
        $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'],null, ['block' => 'meta']);
        $this->Html->meta(['http-equiv' => 'content-language', 'content' => $this->Session->read('Config.language')],null, ['block' => 'meta']);
        $this->Html->meta(['name' => 'description', 'content' => $desc_for_layout],null, ['block' => 'meta']);

		echo $this->Html->meta('icon');



		echo $this->fetch('meta');
        echo $this->Html->meta('icon');
        echo $this->fetch('css');
        echo $this->fetch('cssapp');
        echo $this->fetch('script');
	?>
</head>
<body>
    <?php
    $menuItems = $this->requestAction('users/navigationitems');
    echo $this->element('navigation/main', ['items' => $menuItems]);
    ?>


    <main role="main" class="container mt-5">
        <?php
            echo $this->Flash->render();
            echo $this->fetch('content');
        ?>
    </main><!-- /.container -->

    <footer class="footer">
        <div class="container">
            <hr>
            <span class="text-muted">
                <?php
                echo $this->Html->link(
                    $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
                    'https://cakephp.org/',
                    array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
                );
                echo $cakeVersion;
                ?>
            </span>
        </div>
    </footer>
    <?php
    $this->Html->script($pageJS, ['block' => 'scriptBottomRequired','defer' => false]);
    echo $this->fetch('scriptBottomRequired');
    echo '<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
                 <!--[if lt IE 9]>';
    echo $this->Html->script('http://assets.koode.eu/html5shiv/html5shiv');
    echo $this->Html->script('http://assets.koode.eu/respond/respond');
    echo '<![endif]-->';
    echo $this->fetch('scriptBottom');

    ?>
</body>
</html>

<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public $actsAs = ['Containable'];
    public $validationDomain = 'validation_errors';


    public function _getActiveLang($len = 3)
    {
        App::uses('CakeSession', 'Model/Datasource');
        App::uses('L10n','I18n');
        $lng = CakeSession::read('Config.language');
        if ($lng == null) {
            $lng = Configure::read('Config.language');
        }
        $L10n = new L10n();
        $newLocale = $L10n->map($lng);
        if ($len == 2) {
            switch ($lng) {
                case "eng":
                default :
                    $lng = 'en';
            }
        } else {
            if (strlen($newLocale) == 3) {
                $lng  = $newLocale;
            }
        }
        return $lng;
    }

    /**
     * returns random alphanumeric string
     *
     * @param int $length   :   lenght of the string
     * @return string
     */
    public function generateRandomString ($length = 8){
        // inicializa variables
        $password = "";
        $i = 0;
        $possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHJKLMNQRSTVWXYZ";
        // agrega random
        while ($i < $length){
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }
}

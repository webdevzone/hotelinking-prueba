<?php
App::uses('AppController', 'Controller');
/**
 * PromotionCodes Controller
 *
 * @property PromotionCode $PromotionCode
 * @property PaginatorComponent $Paginator
 */
class PromotionCodesController extends AppController {

    /* define permissions - key = action, value - array of groups, '*' means all groups*/
    public $permissions = [
        'add' => '*',
        'redeem' => '*',
    ];
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
	}


	public function redeem($id = null) {
        $user_id = $this->Auth->user('id');
        if (!$this->PromotionCode->exists($id)) {
            throw new NotFoundException(__('Invalid Promotion code ID'));
        }
        $rs = $this->PromotionCode->find('first', [
            'recursive' => -1,
            'conditions' => ['user_id' => $user_id, 'id' => $id],
        ]);
        if (!empty($rs)) {
            $dt = [
                'id' => $id,
                'is_redeemed' => true,
                'redeemed' => date('Y-m-d H:i:s')
            ];
            if ($this->PromotionCode->save($dt)) {
                $this->Flash->success(__('The promotion code has been been redeemed.'));
                return $this->redirect(array('controller' => 'users', 'action' => 'myaccount'));
            } else {
                $this->Flash->error(__('The promotion code could not be redeemed. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('The promotion code could not be redeemed.'));
        }
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {

        $user_id = $this->Auth->user('id');

        //generate random discount value
        $discount = mt_rand(0, 99);

        $dt = [
            'user_id' => $user_id,
            'title' => __('Sample promotion code (%s)', [$discount]),
            'token' => $this->PromotionCode->generatePromotionCode(),
            'discount' => $discount
        ];
        $this->PromotionCode->set($dt);
        //debug($this->validationErrors);

        $this->PromotionCode->create();
        if ($this->PromotionCode->save($dt)) {
            $this->Flash->success(__('The promotion code has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The promotion code could not be saved. Please, try again.'));
        }

	}
}

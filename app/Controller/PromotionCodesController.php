<?php
App::uses('AppController', 'Controller');
/**
 * PromotionCodes Controller
 *
 * @property PromotionCode $PromotionCode
 * @property PaginatorComponent $Paginator
 */
class PromotionCodesController extends AppController {

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
		$this->PromotionCode->recursive = 0;
		$this->set('promotionCodes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PromotionCode->exists($id)) {
			throw new NotFoundException(__('Invalid promotion code'));
		}
		$options = array('conditions' => array('PromotionCode.' . $this->PromotionCode->primaryKey => $id));
		$this->set('promotionCode', $this->PromotionCode->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PromotionCode->create();
			if ($this->PromotionCode->save($this->request->data)) {
				$this->Flash->success(__('The promotion code has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The promotion code could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PromotionCode->exists($id)) {
			throw new NotFoundException(__('Invalid promotion code'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PromotionCode->save($this->request->data)) {
				$this->Flash->success(__('The promotion code has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The promotion code could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PromotionCode.' . $this->PromotionCode->primaryKey => $id));
			$this->request->data = $this->PromotionCode->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PromotionCode->id = $id;
		if (!$this->PromotionCode->exists()) {
			throw new NotFoundException(__('Invalid promotion code'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PromotionCode->delete()) {
			$this->Flash->success(__('The promotion code has been deleted.'));
		} else {
			$this->Flash->error(__('The promotion code could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

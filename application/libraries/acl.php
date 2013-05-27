<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author LAHAXE Arnaud
 * Cree le 25 mai 2013
 */
 
class acl{

	private $ci;
	private static $cacheAcl = array();

	public function __construct(){
		$this->ci =& get_instance();   
		$this->ci->load->model('action_model');
		$this->ci->load->model('group_action_model');
	}

	public function isAllow($ctrl="",$ssctrl=""){
		if(getUser('admin'))return true;

		$allow = true;
		$pathToTest = $this->genPath($ctrl,$ssctrl);
		if(isset(self::$cacheAcl[$pathToTest]))
			return self::$cacheAcl[$pathToTest];

		$allowSS = $this->ci->group_action_model->isAllow($pathToTest,getUser('groups'));
		if($allowSS){
			$allow = true;
		}else{
			$exist = $this->ci->action_model->count(array('path'=>$pathToTest));
			$allowCtrl =  $this->ci->group_action_model->isAllow($this->genCtrl($ctrl).'/*',getUser('groups'));
			$allow = $allowCtrl && $exist == 0;
		}

		self::$cacheAcl[$pathToTest]=$allow;
		return $allow;
	}

	public function editAction($id_action, $ctrl="",$ssctrl=""){
		$pathToTest = $this->genPath($ctrl,$ssctrl);
		return $this->ci->action_model->update($id_action, array('path'=> $pathToTest));
	}

	public function rmAction($id_action){
		$this->ci->group_action_model->deleteWhere(array('id_action'=>$id_action));
		return $this->ci->action_model->delete($id_action);
	}

	public function addAction($nom, $ctrl="",$ssctrl=""){
		$pathToTest = $this->genPath($ctrl,$ssctrl);
		return $this->ci->action_model->insert(array('path'=> $pathToTest,'description'=>$nom));
	}

	public function addPerm($id_action, $id_group){
		return $this->ci->group_action_model->insert(array('id_action'=>$id_action,'id_group'=>$id_group));
	}

	public function addPermPublic($id_action){
				return $this->ci->group_action_model->insert(array('id_action'=>$id_action,'id_group'=>'-1'));

	}

	public function rmPerm($id_perm){
		return $this->ci->group_action_model->delete($id_perm);
	}


	private function genPath($ctrl,$ssctrl){
		$pathToTest = $this->genCtrl($ctrl);
		if(!empty($ssctrl)){
			$pathToTest .='/'. $ssctrl;
		}else if ( ! ($this->ci->uri->segment(2) === FALSE)) {
			$pathToTest .='/'. $this->ci->uri->segment(2);
		}
		return strtolower($pathToTest);
	}
	

	private function genCtrl($ctrl){
		$pathToTest = "";
		if(!empty($ctrl)){
			$pathToTest = $ctrl;
		}else if ( ! ($this->ci->uri->segment(1) === FALSE)) {
			$pathToTest = $this->ci->uri->segment(1);
		}
		return $pathToTest;
	}

}
<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

if (!function_exists('getUser')) {
	function getUser($label) {
		$ctrl = CI_Controller::get_instance();
		$tab = $ctrl->config->item('user_data');

		return $tab[$label];
	}
}

if (!function_exists('setUser')) {
	function setUser($label, $value) {
		$ctrl = CI_Controller::get_instance();
		$tab = $ctrl->config->item('user_data');
		$tab[$label] = $value;
		$ctrl->config->set_item('user_data', $tab);
	}
}

if (!function_exists('in_group')) {
	function in_group($group) {

		return CI_Controller::get_instance()->ion_auth->in_group($group);
	}
}

if (!function_exists('isAllow')) {
	function isAllow($ctrl, $ssctrl = "*") {

		return CI_Controller::get_instance()->acl->isAllow($ctrl, $ssctrl);
	}
}
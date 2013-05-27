<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AclHook{
	
	private $ci;
	
	public function __construct(){
		$this->ci = &get_instance();
	}

	public function exec(){
		if($this->ci->ion_auth->logged_in()){
				$user = $this->ci->ion_auth->user()->row();
				setUser('username', $user->username);
				setUser('id', $user->id);
				setUser('email', $user->email);
				setUser('admin', $this->ci->ion_auth->is_admin());
				setUser('logged', true);
				$groupUser = $this->ci->ion_auth->get_users_groups(getUser('id'))->result();
				$group = array();
				foreach($groupUser as $tmp) 
					$group[] = $tmp->id;
				setUser('groups',$group);
				
		}else{
			setUser('logged', false);
		}
		
		if($this->ci->uri->segment(1) != "auth")
			if(!$this->ci->acl->isAllow()){
				$this->ci->session->set_flashdata('message', "Vous n'avez pas acces à cette page");
				redirect("auth/login/redirect");
			}		
	}

}
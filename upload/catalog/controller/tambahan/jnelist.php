<?php
class ControllerTambahanJnelist extends Controller {
	public function index() {
		$this->load->model('tambahan/jne');
		$this->data['data'] = $this->model_tambahan_jne->getJne();
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/tambahan/jnelist.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/tambahan/jnelist.tpl';
		} else {
			$this->template = 'default/template/tambahan/jnelist.tpl';
		}
		
		$this->response->setOutput($this->render());
	}
}
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
		$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
		);
		
		$this->response->setOutput($this->render());
	}
}
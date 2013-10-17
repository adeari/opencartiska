<?php  
class ControllerModuleTrackingJne extends Controller {
	protected function index() {
		$this->language->load('module/trackingjne');

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['entry_resi'] = $this->language->get('entry_resi');
        $this->data['text_button'] = $this->language->get('text_button');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/trackingjne.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/trackingjne.tpl';
		} else {
			$this->template = 'default/template/module/trackingjne.tpl';
		}
		
		$this->render();
	}
}
?>

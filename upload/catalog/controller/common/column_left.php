<?php  
class ControllerCommonColumnLeft extends Controller {
	protected function index() {
		$this->load->model('design/layout');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('catalog/information');

		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
			if (strcmp($route,'common/home')==0)	$route = 'product/category';
		} else {
			$route = 'product/category';
		}


		$module_data = array();

		$this->load->model('setting/extension');

		$extensions = $this->model_setting_extension->getExtensions('module');
		
		$moduleChoos = 'category';
		$modules = $this->config->get($moduleChoos.'_module');
		$module_data[0] = array(
				'code'       => $moduleChoos,
				'setting'    => $modules,
				'sort_order' => 0
		);
		

		$sort_order = array();
		 
		foreach ($module_data as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $module_data);

		$this->data['modules'] = array();

		foreach ($module_data as $module) {
			$module = $this->getChild('module/' . $module['code'], $module['setting']);
				
			if ($module) {
				$this->data['modules'][] = $module;
			}
		}
		
		$this->data['showFBAcc']=showFBIT;
		$this->data['pinBB'] = $this->config->get('config_pinBB');
		$this->data['waNum'] = $this->config->get('config_whatsApp');
		$this->data['SMSnum'] = $this->config->get('config_SMS');
		$this->data['YMid'] = $this->config->get('config_YM');
		
		$this->language->load('information/contact');
		$this->data['contact_us'] = $this->language->get('text_location');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/column_left.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/column_left.tpl';
		} else {
			$this->template = 'default/template/common/column_left.tpl';
		}

		$this->render();
	}
}
?>
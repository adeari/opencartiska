<?php  
class ControllerCommonColumnRight extends Controller {
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
		$moduleChoos = 'trackingjne';
		$modules = $this->config->get($moduleChoos.'_module');
		$module_data[1] = array(
				'code'       => $moduleChoos,
				'setting'    => $modules,
				'sort_order' => 1
		);		
		$sort_order = array(); 
		
		$module_data[0] = array(
				'code'       => 'loginright',
				'setting'    => '',
				'sort_order' => 0
		);	
	  
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
		
		$this->data['keranjangBelanja'] = $this->getChild('module/cart/lihat');
		
		$this->data['showFBAcc']=showFBIT;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/column_right.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/column_right.tpl';
		} else {
			$this->template = 'default/template/common/column_right.tpl';
		}
								
		$this->render();
	}
}
?>

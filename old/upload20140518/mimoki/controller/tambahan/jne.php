<?php   
class ControllerTambahanJne extends Controller {   
	private $error = array();
	public function index() {
		$this->language->load('catalog/filter');

		$this->document->setTitle('Resi JNE');
		
		$this->load->model('tambahan/jne');
		
		$this->getList();
	}
	
	public function insert() {
		$this->language->load('catalog/filter');
	
		$this->document->setTitle('Resi JNE');
	
		$this->load->model('tambahan/jne');
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {			
			if ($this->model_tambahan_jne->addJne($this->request->post)) {
				$this->session->data['success'] = 'Success: You have modified JNE!';
				$this->redirect($this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			} else {
				$this->error['warning'] = 'Nomor resi '.$this->request->post['noresi'].' sudah ada';
			}
		}
	
		$this->getForm();
	}
	
	protected function getForm() {
		$this->data['heading_title'] = 'Resi JNE';
	
		$this->data['entry_group'] = $this->language->get('entry_group');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
	
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_filter'] = $this->language->get('button_add_filter');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
		
		
		if (isset($this->request->get['tanggal'])) {
			$this->data['tanggal'] = $this->request->get['tanggal'];
		} else {
			$this->data['tanggal'] = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
		}
		
		if (isset($this->request->post['nama'])) {
			$this->data['nama'] = $this->request->post['nama'];
		} else {
			$this->data['nama'] = '';
		}

		if (isset($this->request->post['kurir'])) {
			$this->data['kurir'] = $this->request->post['kurir'];
		} else {
			$this->data['kurir'] = '';
		}
		
		$forEdit = false;
		if (isset($this->request->get['noresi'])) {
			$this->data['noresi'] = $this->request->get['noresi'];
			$forEdit = true;
		} else if (isset($this->request->post['noresi'])) {
			$this->data['noresi'] = $this->request->post['noresi'];
		} else {
			$this->data['noresi'] = '';
		}
		$this->data['isEdited'] = $forEdit;
		if ($forEdit) {
			$takeDAta = $this->model_tambahan_jne->get1Data($this->data['noresi']);
			foreach ($takeDAta as $takeDAta1) {
				$this->data['kurir'] = $takeDAta1['kurir'];
				$this->data['nama'] = $takeDAta1['nama'];
				$this->data['tanggal'] = $takeDAta1['tanggal'];
			}
		}
	
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
		if (isset($this->error['group'])) {
			$this->data['error_group'] = $this->error['group'];
		} else {
			$this->data['error_group'] = array();
		}
	
		if (isset($this->error['filter'])) {
			$this->data['error_filter'] = $this->error['filter'];
		} else {
			$this->data['error_filter'] = array();
		}
	
		$url = '';
	
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
	
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
	
		$this->data['breadcrumbs'] = array();
	
		$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
		);
	
		$this->data['breadcrumbs'][] = array(
				'text'      => 'JNE',
				'href'      => $this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
		);
	
		if (!isset($this->request->get['noresi'])) {
			$this->data['action'] = $this->url->link('tambahan/jne/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('tambahan/jne/update', 'token=' . $this->session->data['token'] . '&noresi=' . $this->request->get['noresi'] . $url, 'SSL');
		}
	
		$this->data['cancel'] = $this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
		if (isset($this->request->get['filter_group_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$filter_group_info = $this->model_catalog_filter->getFilterGroup($this->request->get['filter_group_id']);
		}
	
		$this->data['token'] = $this->session->data['token'];
	
		$this->load->model('localisation/language');
	
	
		if (isset($this->request->post['filter_group_description'])) {
			$this->data['filter_group_description'] = $this->request->post['filter_group_description'];
		} elseif (isset($this->request->get['filter_group_id'])) {
			$this->data['filter_group_description'] = $this->model_catalog_filter->getFilterGroupDescriptions($this->request->get['filter_group_id']);
		} else {
			$this->data['filter_group_description'] = array();
		}
	
		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($filter_group_info)) {
			$this->data['sort_order'] = $filter_group_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}
	
		if (isset($this->request->post['filters'])) {
			$this->data['filters'] = $this->request->post['filter'];
		} elseif (isset($this->request->get['filter_group_id'])) {
			$this->data['filters'] = $this->model_catalog_filter->getFilterDescriptions($this->request->get['filter_group_id']);
		} else {
			$this->data['filters'] = array();
		}
	
		$this->template = 'tambahan/jne_form.tpl';
		$this->children = array(
				'common/header',
				'common/footer'
		);
	
		$this->response->setOutput($this->render());
	}
  	
	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'fgd.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
			
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => 'JNE',
			'href'      => $this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('tambahan/jne/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('tambahan/jne/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		 
		$this->data['filters'] = array();
		
		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$jne_total = $this->model_tambahan_jne->getTotalFilterGroups();
		
		$results = $this->model_tambahan_jne->getFilterGroups();
		$this->data['jne'] =  array();
		
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('tambahan/jne/update', 'token=' . $this->session->data['token'] . '&noresi=' . $result['noresi'] . $url, 'SSL')
			);

			$this->data['jne'][] = array(
				'nama' => $result['nama'],
				'noresi'            => $result['noresi'],
				'tanggal'      => $result['tanggal'],
				'kurir'      => $result['kurir'],
				'selected'        => isset($this->request->post['selected']) && in_array($result['noresi'], $this->request->post['selected']),
				'action'          => $action
			);
		}

		$this->data['heading_title'] = 'Resi JNE';
		//tanggal dd/mm/yyyy, nama , resi , kurir jne ATO apa gituh
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		
		$this->data['column_group'] = $this->language->get('column_group');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');	

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_name'] = $this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . '&sort=fgd.name' . $url, 'SSL');
		$this->data['sort_sort_order'] = $this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . '&sort=fg.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $jne_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'tambahan/jne.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	public function update() {
		$this->language->load('catalog/filter');
	
		$this->document->setTitle('Resi JNE');
	
		$this->load->model('tambahan/jne');
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_tambahan_jne->editJne($this->request->get['noresi'], $this->request->post);
				
			$this->session->data['success'] = 'Success: You have modified JNE!';
	
			$url = '';
				
			$this->redirect($this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getForm();
	}
	
	public function delete() {
		$this->language->load('catalog/filter');

		$this->document->setTitle('Resi JNE');
 		
		$this->load->model('tambahan/jne');
		
		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $noresi) {
				$this->model_tambahan_jne->deleteJne($noresi);
			}
			
			$this->session->data['success'] = 'Success: You have modified JNE!';
			
			$url = '';			
			
			$this->redirect($this->url->link('tambahan/jne', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
}
?>
<?php 
class ControllerModuleLoginright extends Controller {

	public function index() {
		$showLoginRightOn = true;
		if ($this->customer->isLogged())
			$showLoginRightOn = false;
		if ($showLoginRightOn) {
			if (isset($this->request->get['route'])) {
				$route = (string)$this->request->get['route'];
				if (strcmp($route,'account/login')==0
				|| strcmp($route,'checkout/checkout')==0
				)	
					$showLoginRightOn = false;;
			}
		}
		if ($showLoginRightOn) {
			$this->language->load('account/login');
			$this->language->load('module/fbconnect');
			require_once(DIR_SYSTEM . 'vendor/facebook-sdk/facebook.php');
			$this->data['action'] = $this->url->link('account/login', '', 'SSL');
			$this->data['register'] = $this->url->link('account/register', '', 'SSL');
			$this->data['text_returning_customer'] = $this->language->get('text_returning_customer');
			$this->data['entry_email'] = $this->language->get('entry_email');
			$this->data['entry_password'] = $this->language->get('entry_password');
			$this->data['text_forgotten'] = $this->language->get('text_forgotten');
			$this->data['forgotten'] = $this->url->link('account/forgotten', '', 'SSL');
			$this->data['button_login'] = $this->language->get('button_login');

			if (isset($this->request->post['email'])) {
				$this->data['email'] = $this->request->post['email'];
			} else {
				$this->data['email'] = '';
			}

			$this->fbconnect = new Facebook(array(
					'appId'  => $this->config->get('fbconnect_apikey'),
					'secret' => $this->config->get('fbconnect_apisecret'),
			));
			$this->data['fbconnect_url'] = $this->fbconnect->getLoginUrl(
					array(
							'scope' => 'email,user_birthday,user_location,user_hometown',
							'redirect_uri'  => $this->url->link('account/fbconnect', '', 'SSL')
					)
			);

			if (isset($this->request->post['password'])) {
				$this->data['password'] = $this->request->post['password'];
			} else {
				$this->data['password'] = '';
			}

			if($this->config->get('fbconnect_button_' . $this->config->get('config_language_id'))){
				$this->data['fbconnect_button'] = html_entity_decode($this->config->get('fbconnect_button_' . $this->config->get('config_language_id')));
			}
			else $this->data['fbconnect_button'] = $this->language->get('heading_title');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/loginRight.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/loginRight.tpl';
			} else {
				$this->template = 'default/template/module/loginRight.tpl';
			}
			$this->render();
		}
	}
}
?>
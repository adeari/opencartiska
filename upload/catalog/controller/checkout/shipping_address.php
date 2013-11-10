<?php 
class ControllerCheckoutShippingAddress extends Controller {

	public function index() {
		$this->language->load('checkout/checkout');

		$this->data['text_address_existing'] = $this->language->get('text_address_existing');
		$this->data['text_address_new'] = $this->language->get('text_address_new');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');

		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_zone'] = $this->language->get('entry_zone');

		$this->data['button_continue'] = $this->language->get('button_continue');
			
		if (isset($this->session->data['shipping_address_id'])) {
			$this->data['address_id'] = $this->session->data['shipping_address_id'];
		} else {
			$this->data['address_id'] = $this->customer->getAddressId();
		}

		$this->load->model('account/address');

		$this->data['addresses'] = $this->model_account_address->getAddresses();

		if (isset($this->session->data['shipping_postcode'])) {
			$this->data['postcode'] = $this->session->data['shipping_postcode'];
		} else {
			$this->data['postcode'] = '';
		}

		if (isset($this->session->data['shipping_country_id'])) {
			$this->data['country_id'] = $this->session->data['shipping_country_id'];
		} else {
			$this->data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->session->data['shipping_zone_id'])) {
			$this->data['zone_id'] = $this->session->data['shipping_zone_id'];
		} else {
			$this->data['zone_id'] = '';
		}

		$this->load->model('localisation/country');

		$this->data['countries'] = $this->model_localisation_country->getCountries();

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/shipping_address.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/checkout/shipping_address.tpl';
		} else {
			$this->template = 'default/template/checkout/shipping_address.tpl';
		}

		$this->response->setOutput($this->render());
	}

	public function index1() {
		$this->language->load('checkout/checkout');
		$metode_shipping = $this->request->post['shipping_method'];
		$this->data['button_continue'] = $this->language->get('button_continue');
		if (strcmp($metode_shipping,'pickup.pickup')==0) {
			$this->data['ambilsendiriinfo'] = $this->language->get('ambilsendiriinfo');
			$this->data['SMSnum'] =$this->config->get('config_SMS');
			$this->template = 'default/template/checkout/shipping_addressa.tpl';
		} else {
			$this->language->load('checkout/checkout');

			$this->data['text_address_existing'] = $this->language->get('text_address_existing');
			$this->data['text_address_new'] = $this->language->get('text_address_new');
			$this->data['text_select'] = $this->language->get('text_select');
			$this->data['text_none'] = $this->language->get('text_none');

			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_company'] = $this->language->get('entry_company');
			$this->data['entry_address_1'] = $this->language->get('entry_address_1');
			$this->data['entry_address_2'] = $this->language->get('entry_address_2');
			$this->data['entry_postcode'] = $this->language->get('entry_postcode');
			$this->data['entry_city'] = $this->language->get('entry_city');
			$this->data['entry_country'] = $this->language->get('entry_country');
			$this->data['entry_zone'] = $this->language->get('entry_zone');
				
				
			$this->data['jenispengiriman'] = $this->language->get('jenispengiriman');
			$this->data['kesendiri'] = $this->language->get('kesendiri');
			$this->data['kelain'] = $this->language->get('kelain');
			$this->data['tujuan'] = $this->language->get('tujuan');
			$this->data['text_modify'] = $this->language->get('text_modify');

			$this->data['button_continue'] = $this->language->get('button_continue');

			if (isset($this->session->data['shipping_address_id'])) {
				$this->data['address_id'] = $this->session->data['shipping_address_id'];
			} else {
				$this->data['address_id'] = $this->customer->getAddressId();
			}

			$this->load->model('account/address');

			$this->data['addresses'] = $this->model_account_address->getAddresses();
			
			if (isset($this->session->data['address_1'])) {
				$this->data['address_1'] = $this->session->data['address_1'];
			} else {
				$this->data['address_1'] = '';
			}
			
			if (isset($this->session->data['kecamatan'])) {
				$this->data['kecamatan'] = $this->session->data['kecamatan'];
			} else {
				$this->data['kecamatan'] = '';
			}
			
			if (isset($this->session->data['city'])) {
				$this->data['city'] = $this->session->data['city'];
			} else {
				$this->data['city'] = '';
			}

			if (isset($this->session->data['shipping_postcode'])) {
				$this->data['postcode'] = $this->session->data['shipping_postcode'];
			} else {
				$this->data['postcode'] = '';
			}

			if (isset($this->session->data['shipping_country_id'])) {
				$this->data['country_id'] = $this->session->data['shipping_country_id'];
			} else {
				$this->data['country_id'] = $this->config->get('config_country_id');
			}

			if (isset($this->session->data['shipping_zone_id'])) {
				$this->data['zone_id'] = $this->session->data['shipping_zone_id'];
			} else {
				$this->data['zone_id'] = '';
			}
				
			$this->data['guest_name'] = $this->session->data['guest']['name'];
			$this->data['nohp'] = $this->session->data['guest']['hp'];
			$this->data['entry_address'] = $this->language->get('entry_address');
			$this->data['entry_kecamatan'] = $this->language->get('entry_kecamatan');
			$this->data['pengirim'] = $this->language->get('pengirim');

			$this->load->model('localisation/country');

			$this->data['countries'] = $this->model_localisation_country->getCountries();

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/shipping_addressb.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/checkout/shipping_addressb.tpl';
			} else {
				$this->template = 'default/template/checkout/shipping_address.tpl';
			}


		}
		$this->response->setOutput($this->render());
	}

	public function validateb() {
		$this->language->load('checkout/checkout');

		$json = array();

		// Validate if shipping is required. If not the customer should not have reached this page.
		if (!$this->cart->hasShipping()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		// Validate minimum quantity requirments.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$json['redirect'] = $this->url->link('checkout/cart');

				break;
			}
		}

		if (!$json) {
			if (isset($this->request->post['shipping_address']) && $this->request->post['shipping_address'] == 'existing') {
				$this->load->model('account/address');

				if (empty($this->request->post['address_id'])) {
					$json['error']['warning'] = $this->language->get('error_address');
				} elseif (!in_array($this->request->post['address_id'], array_keys($this->model_account_address->getAddresses()))) {
					$json['error']['warning'] = $this->language->get('error_address');
				}

				if (!$json) {
					$this->session->data['shipping_address_id'] = $this->request->post['address_id'];

					// Default Shipping Address
					$this->load->model('account/address');

					$address_info = $this->model_account_address->getAddress($this->request->post['address_id']);

					if ($address_info) {
						$this->session->data['shipping_country_id'] = $address_info['country_id'];
						$this->session->data['shipping_zone_id'] = $address_info['zone_id'];
						$this->session->data['shipping_postcode'] = $address_info['postcode'];
					} else {
						unset($this->session->data['shipping_country_id']);
						unset($this->session->data['shipping_zone_id']);
						unset($this->session->data['shipping_postcode']);
					}

					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}
			}


			if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 32)) {
				$json['error']['name'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['hp']) < 3) || (utf8_strlen($this->request->post['hp']) > 32)) {
				$json['error']['hp'] = $this->language->get('error_hp');
			}

			if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
				$json['error']['city'] = $this->language->get('error_city');
			}
			
			if (strcmp($this->request->post['jenispengiriman'],'lain')==0)  {				
				if ((utf8_strlen($this->request->post['namapengirim']) < 1) || (utf8_strlen($this->request->post['namapengirim']) > 32)) {
					$json['error']['iname'] = $this->language->get('error_name');
				}
				
				if ((utf8_strlen($this->request->post['hppengirim']) < 3) || (utf8_strlen($this->request->post['hppengirim']) > 32)) {
					$json['error']['ihp'] = $this->language->get('error_hp');
				}
			}

			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);


			if ($this->request->post['country_id'] == '') {
				$json['error']['country'] = $this->language->get('error_country');
			}

			if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
				$json['error']['zone'] = $this->language->get('error_zone');
			}

			if (!$json) {
				// Default Shipping Address
				$this->session->data['guest']['address_1'] = $this->request->post['address_1'];
				$this->session->data['guest']['kecamatan'] = $this->request->post['kecamatan'];
				$this->session->data['guest']['city'] = $this->request->post['city'];
				$this->session->data['guest']['zone_id'] = $this->request->post['zone_id'];
				
				$this->session->data['guest']['shipping_address'] = true;
				$this->session->data['guest']['shipping']['name'] = $this->request->post['name'];
				$this->session->data['guest']['shipping']['hp'] = $this->request->post['hp'];
				$this->session->data['guest']['shipping']['address_1'] = $this->request->post['address_1'];
				$this->session->data['guest']['shipping']['kecamatan'] = $this->request->post['kecamatan'];
				$this->session->data['guest']['shipping']['city'] = $this->request->post['city'];
				$this->session->data['guest']['shipping']['country_id'] = $this->request->post['country_id'];
				$this->session->data['guest']['shipping']['postcode'] = $this->request->post['postcode'];
				$this->session->data['guest']['shipping']['zone_id'] = $this->request->post['zone_id'];
				
				$this->session->data['guest']['payment']['name'] = $this->request->post['name'];
				$this->session->data['guest']['payment']['address_1'] = $this->request->post['address_1'];
				$this->session->data['guest']['payment']['postcode'] = $this->request->post['postcode'];
				$this->session->data['guest']['payment']['city'] = $this->request->post['city'];
				$this->session->data['guest']['payment']['country_id'] = $this->request->post['country_id'];
				$this->session->data['guest']['payment']['zone_id'] = $this->request->post['zone_id'];
				
				if (strcmp($this->request->post['jenispengiriman'],'lain')==0)  {
					$this->session->data['guest']['shipping']['namapengirim'] = $this->request->post['namapengirim'];
					$this->session->data['guest']['shipping']['hppengirim'] = $this->request->post['hppengirim'];
				} else {
					$this->session->data['guest']['shipping']['namapengirim'] = '';
					$this->session->data['guest']['shipping']['hppengirim'] = '';
				}
				
				$this->load->model('localisation/zone');					
				$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);
				
				if ($zone_info) {
					$this->session->data['guest']['shipping']['zone'] = $zone_info['name'];
					$this->session->data['guest']['shipping']['zone_code'] = $zone_info['code'];
				} else {
					$this->session->data['guest']['shipping']['zone'] = '';
					$this->session->data['guest']['shipping']['zone_code'] = '';
				}
				
				$this->load->model('account/address');

				$this->session->data['shipping_address_id'] = $this->model_account_address->addAddressb($this->request->post);
				$this->session->data['shipping_country_id'] = $this->request->post['country_id'];
				$this->session->data['shipping_zone_id'] = $this->request->post['zone_id'];
				$this->session->data['shipping_postcode'] = $this->request->post['postcode'];
				

				unset($this->session->data['shipping_method']);
				unset($this->session->data['shipping_methods']);
			}
		}

		$this->response->setOutput(json_encode($json));

	}

	public function validate() {
		$this->language->load('checkout/checkout');

		$json = array();

		// Validate if customer is logged in.
		if (!$this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate if shipping is required. If not the customer should not have reached this page.
		if (!$this->cart->hasShipping()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		// Validate minimum quantity requirments.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$json['redirect'] = $this->url->link('checkout/cart');

				break;
			}
		}

		if (!$json) {
			if (isset($this->request->post['shipping_address']) && $this->request->post['shipping_address'] == 'existing') {
				$this->load->model('account/address');

				if (empty($this->request->post['address_id'])) {
					$json['error']['warning'] = $this->language->get('error_address');
				} elseif (!in_array($this->request->post['address_id'], array_keys($this->model_account_address->getAddresses()))) {
					$json['error']['warning'] = $this->language->get('error_address');
				}

				if (!$json) {
					$this->session->data['shipping_address_id'] = $this->request->post['address_id'];

					// Default Shipping Address
					$this->load->model('account/address');

					$address_info = $this->model_account_address->getAddress($this->request->post['address_id']);

					if ($address_info) {
						$this->session->data['shipping_country_id'] = $address_info['country_id'];
						$this->session->data['shipping_zone_id'] = $address_info['zone_id'];
						$this->session->data['shipping_postcode'] = $address_info['postcode'];
					} else {
						unset($this->session->data['shipping_country_id']);
						unset($this->session->data['shipping_zone_id']);
						unset($this->session->data['shipping_postcode']);
					}

					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}
			}

			if ($this->request->post['shipping_address'] == 'new') {
				if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
					$json['error']['name'] = $this->language->get('error_name');
				}

				if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
					$json['error']['address_1'] = $this->language->get('error_address_1');
				}

				if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
					$json['error']['city'] = $this->language->get('error_city');
				}

				$this->load->model('localisation/country');

				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

				if ($country_info && $country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
					$json['error']['postcode'] = $this->language->get('error_postcode');
				}

				if ($this->request->post['country_id'] == '') {
					$json['error']['country'] = $this->language->get('error_country');
				}

				if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
					$json['error']['zone'] = $this->language->get('error_zone');
				}

				if (!$json) {
					// Default Shipping Address
					$this->load->model('account/address');

					$this->session->data['shipping_address_id'] = $this->model_account_address->addAddress($this->request->post);
					$this->session->data['shipping_country_id'] = $this->request->post['country_id'];
					$this->session->data['shipping_zone_id'] = $this->request->post['zone_id'];
					$this->session->data['shipping_postcode'] = $this->request->post['postcode'];

					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}
?>
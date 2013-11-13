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
		$this->language->load('payment/authorizenet_aim');
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		
		$this->language->load('checkout/checkout');
		$metode_shipping = $this->request->post['shipping_method'];
		$this->data['text_modify'] = $this->language->get('text_modify');
		
		
		if (strcmp($metode_shipping,'pickup.pickup')==0) {
			$this->data['ambilsendiriinfo'] = $this->language->get('ambilsendiriinfo');
			$this->data['SMSnum'] =$this->config->get('config_SMS');
			$this->template = 'default/template/checkout/shipping_addressa.tpl';
			$shipping = explode('.', $metode_shipping);			
			$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
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
				
				if ($country_info) {
					$this->session->data['guest']['shipping']['country'] = $country_info['name'];
					$this->session->data['guest']['shipping']['iso_code_2'] = $country_info['iso_code_2'];
					$this->session->data['guest']['shipping']['iso_code_3'] = $country_info['iso_code_3'];
					$this->session->data['guest']['shipping']['address_format'] = $country_info['address_format'];
				} else {
					$this->session->data['guest']['shipping']['country'] = '';
					$this->session->data['guest']['shipping']['iso_code_2'] = '';
					$this->session->data['guest']['shipping']['iso_code_3'] = '';
					$this->session->data['guest']['shipping']['address_format'] = '';
				}
				
				$this->session->data['guest']['payment']['name'] = $this->request->post['name'];
				$this->session->data['guest']['payment']['address_1'] = $this->request->post['address_1'];
				$this->session->data['guest']['payment']['postcode'] = $this->request->post['postcode'];
				$this->session->data['guest']['payment']['city'] = $this->request->post['city'];
				$this->session->data['guest']['payment']['country_id'] = $this->request->post['country_id'];
				$this->session->data['guest']['payment']['zone_id'] = $this->request->post['zone_id'];
				if ($zone_info) {
					$this->session->data['guest']['payment']['zone'] = $zone_info['name'];
					$this->session->data['guest']['payment']['zone_code'] = $zone_info['code'];
				} else {
					$this->session->data['guest']['payment']['zone'] = '';
					$this->session->data['guest']['payment']['zone_code'] = '';
				}
				
				if ($country_info) {
					$this->session->data['guest']['payment']['country'] = $country_info['name'];
					$this->session->data['guest']['payment']['iso_code_2'] = $country_info['iso_code_2'];
					$this->session->data['guest']['payment']['iso_code_3'] = $country_info['iso_code_3'];
					$this->session->data['guest']['payment']['address_format'] = $country_info['address_format'];
				} else {
					$this->session->data['guest']['payment']['country'] = '';
					$this->session->data['guest']['payment']['iso_code_2'] = '';
					$this->session->data['guest']['payment']['iso_code_3'] = '';
					$this->session->data['guest']['payment']['address_format'] = '';
				}
				
				
				
				
				$this->load->model('localisation/country');
					
				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
					
				
				
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
	
	public function validatec() {
		$this->language->load('checkout/checkout');

		$json = array();

		// Validate if shipping is required. If not the customer should not have reached this page.
		if (!$this->cart->hasShipping()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate if shipping address has been set.
		$this->load->model('account/address');

		if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
			$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
		} elseif (isset($this->session->data['guest'])) {
			if (!empty($this->session->data['guest']['shipping']))
				$shipping_address = $this->session->data['guest']['shipping'];
		}

		if (!empty($shipping_address)) {
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

			
		}
		
		
		
		
		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();
		
		$this->load->model('setting/extension');
			
		$sort_order = array();
			
		$results = $this->model_setting_extension->getExtensions('total');
			
		foreach ($results as $key => $value) {
			$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
		}
			
		array_multisort($sort_order, SORT_ASC, $results);
			
		foreach ($results as $result) {
			if ($this->config->get($result['code'] . '_status')) {
				$this->load->model('total/' . $result['code']);
		
				$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
			}
		}
			
		$sort_order = array();
		
		foreach ($total_data as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}
		
		array_multisort($sort_order, SORT_ASC, $total_data);
		
		$this->language->load('checkout/checkout');
			
		$data = array();
			
		$data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		$data['store_id'] = $this->config->get('config_store_id');
		$data['store_name'] = $this->config->get('config_name');
			
		if ($data['store_id']) {
			$data['store_url'] = $this->config->get('config_url');
		} else {
			$data['store_url'] = HTTP_SERVER;
		}
			
		if ($this->customer->isLogged()) {
			$data['customer_id'] = $this->customer->getId();
			$data['customer_group_id'] = $this->customer->getCustomerGroupId();
			$data['firstname'] = $this->customer->getFirstName();
			$data['lastname'] = $this->customer->getLastName();
			$data['email'] = $this->customer->getEmail();
			$data['telephone'] = $this->customer->getTelephone();
			$data['fax'] = $this->customer->getFax();
				
			$this->load->model('account/address');
		
			$payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
		} elseif (isset($this->session->data['guest'])) {
			$data['customer_id'] = 0;
			$data['customer_group_id'] = $this->session->data['guest']['customer_group_id'];
			$data['name'] = $this->session->data['guest']['name'];
			$data['email'] = $this->session->data['guest']['email'];
			$data['telephone'] = $this->session->data['guest']['telephone'];
			$data['bb'] = $this->session->data['guest']['bb'];
			$data['wa'] = $this->session->data['guest']['wa'];
			$data['hp'] = $this->session->data['guest']['hp'];
			$data['lainnya'] = $this->session->data['guest']['another_contact'];
			$data['fax'] = $this->session->data['guest']['fax'];
				
			if (strcmp($this->session->data['shipping_method']['code'],'pickup.pickup')==0) {
				$data['kecamatan'] = '';
			} else {
				$data['kecamatan'] = $this->session->data['guest']['kecamatan'];
			}
		
			$payment_address = $this->session->data['guest']['payment'];
		}
			
			
			
		if (isset($this->session->data['guest'])) {
			$data['name'] = $payment_address['name'];
				$data['payment_address_1'] = '';
				$data['payment_city'] = '';
				$data['payment_postcode'] = '';
			$data['payment_zone'] = $payment_address['zone'];
			$data['payment_zone_id'] = $payment_address['zone_id'];
			$data['payment_country'] = $payment_address['country'];
			$data['payment_country_id'] = $payment_address['country_id'];
			$data['payment_address_format'] = $payment_address['address_format'];
		} else {
			$data['payment_firstname'] = $payment_address['firstname'];
			$data['payment_lastname'] = $payment_address['lastname'];
			$data['payment_company'] = $payment_address['company'];
			$data['payment_company_id'] = $payment_address['company_id'];
			$data['payment_tax_id'] = $payment_address['tax_id'];
			$data['payment_address_1'] = $payment_address['address_1'];
			$data['payment_address_2'] = $payment_address['address_2'];
			$data['payment_city'] = $payment_address['city'];
			$data['payment_postcode'] = $payment_address['postcode'];
			$data['payment_zone'] = $payment_address['zone'];
			$data['payment_zone_id'] = $payment_address['zone_id'];
			$data['payment_country'] = $payment_address['country'];
			$data['payment_country_id'] = $payment_address['country_id'];
			$data['payment_address_format'] = $payment_address['address_format'];
		}
		
		
		$this->language->load('payment/cod');
		$data['payment_method'] = $this->language->get('text_title');
		$data['payment_code'] = 'cod';
		
		if ($this->cart->hasShipping()) {
			if ($this->customer->isLogged()) {
				$this->load->model('account/address');
					
				$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
			} elseif (isset($this->session->data['guest'])) {
				$shipping_address = $this->session->data['guest']['shipping'];
			}
		
			if (isset($this->session->data['guest'])) {
				$data['name'] = $shipping_address['name'];
					$data['shipping_address_1'] = '';
					$data['shipping_city'] = '';
					$data['shipping_postcode'] = '';
					$data['shipping_kecamatan'] = '';
				$data['shipping_zone'] = $shipping_address['zone'];
				$data['shipping_zone_id'] = $shipping_address['zone_id'];
				$data['shipping_country'] = $shipping_address['country'];
				$data['shipping_country_id'] = $shipping_address['country_id'];
				$data['shipping_address_format'] = $shipping_address['address_format'];
					
					
				if (isset($shipping_address['namapengirim'])) {
					$data['namapengirim'] = $shipping_address['namapengirim'];
				} else {
					$data['namapengirim'] = '';
				}
					
				if (isset($shipping_address['hppengirim'])) {
					$data['hppengirim'] = $shipping_address['hppengirim'];
				} else {
					$data['hppengirim'] = '';
				}
					
			} else {
				$data['shipping_firstname'] = $shipping_address['firstname'];
				$data['shipping_lastname'] = $shipping_address['lastname'];
				$data['shipping_company'] = $shipping_address['company'];
				$data['shipping_address_1'] = $shipping_address['address_1'];
				$data['shipping_address_2'] = $shipping_address['address_2'];
				$data['shipping_city'] = $shipping_address['city'];
				$data['shipping_postcode'] = $shipping_address['postcode'];
				$data['shipping_zone'] = $shipping_address['zone'];
				$data['shipping_zone_id'] = $shipping_address['zone_id'];
				$data['shipping_country'] = $shipping_address['country'];
				$data['shipping_country_id'] = $shipping_address['country_id'];
				$data['shipping_address_format'] = $shipping_address['address_format'];
			}
			$this->language->load('shipping/pickup');
			$data['shipping_method'] = $this->language->get('text_description');
			$data['shipping_code'] = 'pickup.pickup';
		} else {
			$data['shipping_firstname'] = '';
			$data['shipping_lastname'] = '';
			$data['shipping_company'] = '';
			$data['shipping_address_1'] = '';
			$data['shipping_address_2'] = '';
			$data['shipping_city'] = '';
			$data['shipping_postcode'] = '';
			$data['shipping_zone'] = '';
			$data['shipping_zone_id'] = '';
			$data['shipping_country'] = '';
			$data['shipping_country_id'] = '';
			$data['shipping_address_format'] = '';
			$data['shipping_method'] = '';
			$data['shipping_code'] = '';
		}
			
		$product_data = array();
		
		foreach ($this->cart->getProducts() as $product) {
			$option_data = array();
		
			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['option_value'];
				} else {
					$value = $this->encryption->decrypt($option['option_value']);
				}
					
				$option_data[] = array(
						'product_option_id'       => $option['product_option_id'],
						'product_option_value_id' => $option['product_option_value_id'],
						'option_id'               => $option['option_id'],
						'option_value_id'         => $option['option_value_id'],
						'name'                    => $option['name'],
						'value'                   => $value,
						'type'                    => $option['type']
				);
			}
		
			$product_data[] = array(
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => $option_data,
					'download'   => $product['download'],
					'quantity'   => $product['quantity'],
					'subtract'   => $product['subtract'],
					'price'      => $product['price'],
					'total'      => $product['total'],
					'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
					'reward'     => $product['reward']
			);
		}
		
		
		
		// Gift Voucher
		$voucher_data = array();
			
		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $voucher) {
				$voucher_data[] = array(
						'description'      => $voucher['description'],
						'code'             => substr(md5(mt_rand()), 0, 10),
						'to_name'          => $voucher['to_name'],
						'to_email'         => $voucher['to_email'],
						'from_name'        => $voucher['from_name'],
						'from_email'       => $voucher['from_email'],
						'voucher_theme_id' => $voucher['voucher_theme_id'],
						'message'          => $voucher['message'],
						'amount'           => $voucher['amount']
				);
			}
		}
		
		$data['products'] = $product_data;
		$data['vouchers'] = $voucher_data;
		$data['totals'] = $total_data;
		$data['comment'] = '';
		$data['total'] = $total;
			
		if (isset($this->request->cookie['tracking'])) {
			$this->load->model('affiliate/affiliate');
		
			$affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);
			$subtotal = $this->cart->getSubTotal();
		
			if ($affiliate_info) {
				$data['affiliate_id'] = $affiliate_info['affiliate_id'];
				$data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
			} else {
				$data['affiliate_id'] = 0;
				$data['commission'] = 0;
			}
		} else {
			$data['affiliate_id'] = 0;
			$data['commission'] = 0;
		}
			
		$data['language_id'] = $this->config->get('config_language_id');
		$data['currency_id'] = $this->currency->getId();
		$data['currency_code'] = $this->currency->getCode();
		$data['currency_value'] = $this->currency->getValue($this->currency->getCode());
		$data['ip'] = $this->request->server['REMOTE_ADDR'];
			
		if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
			$data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
		} elseif(!empty($this->request->server['HTTP_CLIENT_IP'])) {
			$data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
		} else {
			$data['forwarded_ip'] = '';
		}
			
		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
		} else {
			$data['user_agent'] = '';
		}
			
		if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
			$data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
		} else {
			$data['accept_language'] = '';
		}
		
		$this->load->model('checkout/order');
			
		if (isset($this->session->data['guest'])) {
			$this->session->data['order_id'] = $this->model_checkout_order->addOrderGuest($data);
		} else {
			$this->session->data['order_id'] = $this->model_checkout_order->addOrder($data);
		}
		
		
		
		
		
		$this->session->data['order_id'] = $this->model_checkout_order->addOrderGuest($data);

		$json['success'] = $this->url->link('checkout/success', '', 'SSL');
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
<?php 
class ControllerCheckoutShippingMethod extends Controller {
	public function index() {
		$this->language->load('checkout/checkout');

		$this->load->model('account/address');

		$shipSelected = false;
		$showRupiah = true;
		if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
			$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
		} elseif (isset($this->session->data['guest'])) {
			$showRupiah = false;
			if (isset($this->session->data['guest']['shipping'])) {
				$shipping_address = $this->session->data['guest']['shipping'];
			}
		}


		if (!empty($shipping_address)) {
			$quote_data = array();

			$this->load->model('setting/extension');

			$results = $this->model_setting_extension->getExtensions('shipping');
			$myJNe = 'jne';
			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')
				&& strcmp($result['code'],$myJNe)!=0
				) {
					$this->load->model('shipping/' . $result['code']);

					$quote = $this->{'model_shipping_' . $result['code']}->getQuote($shipping_address);

					if ($quote) {
						$quote_data[$result['code']] = array(
								'title'      => $quote['title'],
								'quote'      => $quote['quote'],
								'sort_order' => $quote['sort_order'],
								'error'      => $quote['error']
						);
					}
				}
			}

			$products = $this->cart->getProducts();
			$weight = 0;
			foreach ($products as $product) {
				try {
					$weight += doubleval($product['weight']);
				} catch (Exception  $err){
				}
			}
			if ($weight>0) $weight*=1000;
			else $weight = 1000;

			$this->load->model('shipping/'.$myJNe);
			$apiOngkir = $this->{'model_shipping_' .$myJNe}->getApikey();
			$quote = $this->{'model_shipping_' .$myJNe}->getQuote($shipping_address);
			$this->load->language('shipping/jne');


			$getdata = http_build_query(
					array(
							'API-Key' => $apiOngkir,
							'from' => 'surabaya',
							'to'=> $shipping_address['city'],
							'weight'=> $weight,
							'courier'=>'jne',
							'format'=>'json'
					)
			);
			$opts = array('http' =>
					array(
							'method'  => 'POST',
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $getdata,
					)
			);
			$context  = stream_context_create($opts);

			$result = file_get_contents('http://api.ongkir.info/cost/find' , false, $context);
			$dataJson = json_decode($result, TRUE);

			if (!isset($dataJson['price'])) {
				$getdata = http_build_query(
						array(
								'API-Key' => $apiOngkir,
								'from' => $shipping_address['city'],
								'to'=> 'surabaya',
								'weight'=> $weight,
								'courier'=>'jne',
								'format'=>'json'
						)
				);
				$opts = array('http' =>
						array(
								'method'  => 'POST',
								'header'  => 'Content-type: application/x-www-form-urlencoded',
								'content' => $getdata,
						)
				);
				$context  = stream_context_create($opts);
					
				$result = file_get_contents('http://api.ongkir.info/cost/find' , false, $context);
				$dataJson = json_decode($result, TRUE);
			}

			$firrr = true;
			$i=1;
			foreach ($dataJson['price'] as $mimi) {
				$jne_cost = $mimi['value'];
				$quteTax = array(
						'code'           => 'jne.jne'.$i,
						'title'        => $mimi['service'],
						'cost'         => $jne_cost,
						'tax_class_id' => $this->config->get('jne_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($jne_cost, $this->config->get('jne_tax_class_id'), $this->config->get('config_tax')))
				);
				if ($firrr) {
					$quteTax1 = array(
							$myJNe =>$quteTax
					);
					$firrr= false;
				} else {
					array_push($quteTax1,$quteTax);
				}
				$i++;
			}


			if ($quote) {
				$quote_data[$myJNe] = array(
						'title'      => $quote['title'],
						'quote'      => $quteTax1,
						'sort_order' => $quote['sort_order'],
						'error'      => false
				);
			}


			$sort_order = array();

			foreach ($quote_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $quote_data);

			$this->session->data['shipping_methods'] = $quote_data;
		}
			
		$this->data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$this->data['text_comments'] = $this->language->get('text_comments');
		$this->data['text_checkout_payment_method'] = $this->language->get('text_checkout_payment_method');
		$this->data['text_checkout_confirm'] = $this->language->get('text_checkout_confirm');
		$this->data['text_checkout_payment_method1'] = $this->language->get('text_checkout_payment_method1');
		$this->data['text_checkout_confirm1'] = $this->language->get('text_checkout_confirm1');

		$this->data['button_continue'] = $this->language->get('button_continue');

		if (empty($this->session->data['shipping_methods'])) {
			$this->data['error_warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
		} else {
			$this->data['error_warning'] = '';
		}
			
		if (isset($this->session->data['shipping_methods'])) {
			$this->data['shipping_methods'] = $this->session->data['shipping_methods'];
		} else {
			$this->data['shipping_methods'] = array();
		}

		if (isset($this->session->data['shipping_method']['code'])) {
			$this->data['code'] = $this->session->data['shipping_method']['code'];
		} else {
			$this->data['code'] = '';
		}

		if (isset($this->session->data['comment'])) {
			$this->data['comment'] = $this->session->data['comment'];
		} else {
			$this->data['comment'] = '';
		}

		$this->data['showRupiah'] = $showRupiah;
		$this->data['shipSelected'] = $shipSelected;
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/shipping_method.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/checkout/shipping_method.tpl';
		} else {
			$this->template = 'default/template/checkout/shipping_method.tpl';
		}

		$this->response->setOutput($this->render());
	}


	public function trut() {
		$this->language->load('checkout/checkout');

		$this->load->model('account/address');

		$shipSelected = false;
		$showRupiah = true;
		if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
			$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
		} elseif (isset($this->session->data['guest'])) {
			$showRupiah = false;
			if (isset($this->session->data['guest']['shipping'])) {
				$shipping_address = $this->session->data['guest']['shipping'];
			}
		}



		// Shipping Methods
		$quote_data = array();
		$this->language->load('checkout/checkout');


		$this->data['text_checkout_payment_method'] = $this->language->get('text_checkout_payment_method');
		$this->data['text_checkout_confirm'] = $this->language->get('text_checkout_confirm');
		$this->data['text_checkout_payment_method1'] = $this->language->get('text_checkout_payment_method1');
		$this->data['text_checkout_confirm1'] = $this->language->get('text_checkout_confirm1');



		$this->load->model('setting/extension');

		$results = $this->model_setting_extension->getExtensions('shipping');
		foreach ($results as $result) {
			if ($this->config->get($result['code'] . '_status')) {
				$this->load->model('shipping/' . $result['code']);

				$quote = $this->{'model_shipping_' . $result['code']}->getQuote(null);

				if ($quote) {
					$quote_data[$result['code']] = array(
							'title'      => $quote['title'],
							'quote'      => $quote['quote'],
							'sort_order' => $quote['sort_order'],
							'error'      => $quote['error']
					);
				}
			}
		}

		$sort_order = array();

		foreach ($quote_data as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $quote_data);

		$this->session->data['shipping_methods'] = $quote_data;

		if (isset($this->session->data['shipping_methodThio'])) {
			$shipSelected = true;
			$this->data['selecShipii'] = $this->session->data['shipping_methodThio'];
		}
			
		$this->data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$this->data['text_comments'] = $this->language->get('text_comments');
		$this->data['text_checkout_payment_method'] = $this->language->get('text_checkout_payment_method');
		$this->data['text_checkout_confirm'] = $this->language->get('text_checkout_confirm');
		$this->data['text_checkout_payment_method1'] = $this->language->get('text_checkout_payment_method1');
		$this->data['text_checkout_confirm1'] = $this->language->get('text_checkout_confirm1');

		$this->data['button_continue'] = $this->language->get('button_continue');

		if (empty($this->session->data['shipping_methods'])) {
			$this->data['error_warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
		} else {
			$this->data['error_warning'] = '';
		}
			
		if (isset($this->session->data['shipping_methods'])) {
			$this->data['shipping_methods'] = $this->session->data['shipping_methods'];
		} else {
			$this->data['shipping_methods'] = array();
		}

		if (isset($this->session->data['shipping_method']['code'])) {
			$this->data['code'] = $this->session->data['shipping_method']['code'];
		} else {
			$this->data['code'] = '';
		}

		if (isset($this->session->data['comment'])) {
			$this->data['comment'] = $this->session->data['comment'];
		} else {
			$this->data['comment'] = '';
		}

		$this->data['showRupiah'] = $showRupiah;
		$this->data['shipSelected'] = $shipSelected;
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/shipping_methoda.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/checkout/shipping_methoda.tpl';
		} else {
			$this->template = 'default/template/checkout/shipping_methoda.tpl';
		}

		$this->response->setOutput($this->render());
	}

	public function inep() {
		$this->language->load('checkout/checkout');

		$this->load->model('account/address');

		$shipSelected = false;
		$showRupiah = true;
		if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
			$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
		} elseif (isset($this->session->data['guest'])) {
			$showRupiah = false;
			if (isset($this->session->data['guest']['shipping'])) {
				$shipping_address = $this->session->data['guest']['shipping'];
			}
		}


		if ($shipping_address) {
			$quote_data = array();

			$this->load->model('setting/extension');

			$results = $this->model_setting_extension->getExtensions('shipping');
			$myJNe = 'jne';

			$products = $this->cart->getProducts();
			$weight = 0;
			foreach ($products as $product) {
				try {
					$weight += doubleval($product['weight']);
				} catch (Exception  $err){
				}
			}
			if ($weight>0) $weight*=1000;
			else $weight = 1000;

			$this->load->model('shipping/'.$myJNe);
			$apiOngkir = $this->{'model_shipping_' .$myJNe}->getApikey();
			$quote = $this->{'model_shipping_' .$myJNe}->getQuote($shipping_address);
			$this->load->language('shipping/jne');


			$getdata = http_build_query(
					array(
							'API-Key' => $apiOngkir,
							'from' => 'surabaya',
							'to'=> $shipping_address['city'],
							'weight'=> $weight,
							'courier'=>'jne',
							'format'=>'json'
					)
			);
			$opts = array('http' =>
					array(
							'method'  => 'POST',
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $getdata,
					)
			);
			$context  = stream_context_create($opts);

			$result = file_get_contents('http://api.ongkir.info/cost/find' , false, $context);
			$dataJson = json_decode($result, TRUE);

			if (!isset($dataJson['price'])) {
				$getdata = http_build_query(
						array(
								'API-Key' => $apiOngkir,
								'from' => $shipping_address['city'],
								'to'=> 'surabaya',
								'weight'=> $weight,
								'courier'=>'jne',
								'format'=>'json'
						)
				);
				$opts = array('http' =>
						array(
								'method'  => 'POST',
								'header'  => 'Content-type: application/x-www-form-urlencoded',
								'content' => $getdata,
						)
				);
				$context  = stream_context_create($opts);
					
				$result = file_get_contents('http://api.ongkir.info/cost/find' , false, $context);
				$dataJson = json_decode($result, TRUE);
			}

				
			if (isset($dataJson['price'])) {
				$firrr = true;
				$i=1;
				foreach ($dataJson['price'] as $mimi) {
					$jne_cost = $mimi['value'];
					$quteTax = array(
							'code'           => 'jne.jne'.$i,
							'title'        => $mimi['service'],
							'cost'         => $jne_cost,
							'tax_class_id' => $this->config->get('jne_tax_class_id'),
							'text'         => $this->currency->format($this->tax->calculate($jne_cost, $this->config->get('jne_tax_class_id'), $this->config->get('config_tax')))
					);
					if ($firrr) {
						$quteTax1 = array(
								$myJNe =>$quteTax
						);
						$firrr= false;
					} else {
						array_push($quteTax1,$quteTax);
					}
					$i++;
				}


				if ($quote) {
					$quote_data[$myJNe] = array(
							'title'      => $quote['title'],
							'quote'      => $quteTax1,
							'sort_order' => $quote['sort_order'],
							'error'      => false
					);
				}


				$sort_order = array();

				foreach ($quote_data as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $quote_data);

				$this->session->data['shipping_methods'] = $quote_data;
			} else {
				$this->session->data['shipping_methods'] = null;
			}
		}
			
		$this->data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$this->data['text_comments'] = $this->language->get('text_comments');
		$this->data['text_checkout_payment_method'] = $this->language->get('text_checkout_payment_method');
		$this->data['text_checkout_confirm'] = $this->language->get('text_checkout_confirm');
		$this->data['text_checkout_payment_method1'] = $this->language->get('text_checkout_payment_method1');
		$this->data['text_checkout_confirm1'] = $this->language->get('text_checkout_confirm1');
		$this->data['text_modify'] = $this->language->get('text_modify');


		$this->data['button_continue'] = $this->language->get('button_continue');

		if (empty($this->session->data['shipping_methods'])) {
			$this->data['error_warning'] = sprintf($this->language->get('warning_jne'),$shipping_address['city']);
		} else {
			$this->data['error_warning'] = '';
		}
			
		if (isset($this->session->data['shipping_methods'])) {
			$this->data['shipping_methods'] = $this->session->data['shipping_methods'];
		} else {
			$this->data['shipping_methods'] = array();
		}

		if (isset($this->session->data['shipping_method']['code'])) {
			$this->data['code'] = $this->session->data['shipping_method']['code'];
		} else {
			$this->data['code'] = '';
		}

		if (isset($this->session->data['comment'])) {
			$this->data['comment'] = $this->session->data['comment'];
		} else {
			$this->data['comment'] = '';
		}

		$this->data['showRupiah'] = $showRupiah;
		$this->data['shipSelected'] = $shipSelected;
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/shipping_methodb.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/checkout/shipping_methodb.tpl';
		} else {
			$this->template = 'default/template/checkout/shipping_methodb.tpl';
		}

		$this->response->setOutput($this->render());
	}

	public function validate() {
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

			if (!$json&&isset($this->request->post['shipping_method'])) {
				$shippingMethode1 = $this->request->post['shipping_method'];
				$shippingMethode2 = $shippingMethode1;
				if (strcmp(substr($shippingMethode1,0,strlen($shippingMethode1)-1),'jne.jne')==0) {
					$shippingMethode1 = 'jne.jne';

					if (!isset($shippingMethode1)) {
						$json['error']['warning'] = $this->language->get('error_shipping');
					} else {
						$shipping = explode('.', $shippingMethode1);
						$pilih1 = 'jne';
						if (strcmp(substr($shippingMethode2,strlen($shippingMethode2)-1,1),'1')!=0)
						{
							$pilih1 = intval(substr($shippingMethode2,strlen($shippingMethode2)-1,1));
							$pilih1-=2;
						}
						if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$pilih1])) {
							$json['error']['warning'] = $this->language->get('error_shipping');
						}
					}

					if (!$json) {
						$shipping = explode('.', $this->request->post['shipping_method']);

						$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$pilih1];

						$this->session->data['comment'] = strip_tags($this->request->post['comment']);
					}
				} else {
						$shipping = explode('.', $this->request->post['shipping_method']);

						if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
							$json['error']['warning'] = $this->language->get('error_shipping');
						}

					if (!$json) {
						$shipping = explode('.', $this->request->post['shipping_method']);

						$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];

						$this->session->data['comment'] = strip_tags($this->request->post['comment']);
					}
				}
			} else
				$json['error']['warning'] = $this->language->get('error_shipping');
		}

		$this->response->setOutput(json_encode($json));


	}

	public function validatetust() {
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

		if (empty($this->request->post['shipping_method'])) {
			$json['error']['warning'] = $this->language->get('error_shipping');
		} else {
			$shipping = explode('.', $this->request->post['shipping_method']);
			$this->session->data['shipping_methodThio'] = $this->request->post['shipping_method'];
			$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
		}

		$this->response->setOutput(json_encode($json));


	}
}
?>
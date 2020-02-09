<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model('Index_model');
		$this->load->model('Page_model');
		$this->load->model('Master_model');
		// $this->load->model('Customer_model');
		// $this->load->model('Product_model');
		$this->load->model('Login_model');

	}

	public function home()
	{
		$this->data['page']='home';
		// $this->data['sliders']= $this->Index_model->getSliders();
		// // pr($this->Index_model->getSliders());exit;
		// $this->data['f_products']= $this->Index_model->getFProducts();
		// $this->data['n_products']= $this->Index_model->getNProducts();
		// $this->data['home_banners']= unserialize(urldecode($this->Master_model->getTexts('texts','banners')));
		// $this->data['home_sections']= unserialize(urldecode($this->Master_model->getTexts('texts','home_sections')));
	    // pr($this->Index_model->getSliders());exit;
		$this->load->view('layout/default',$this->data);
	}
	public function page($page_slug)
	{
		$page_id=getPageIdBySlug($page_slug);
		if ($this->data['row']= $this->Page_model->getPage($page_id)) {
			$this->data['page']='pages';
		}else{
			$this->data['page']='error';	
		}
		$this->data['cat_banners']= unserialize(urldecode($this->Master_model->getTexts('texts','banners')));
		$this->data['home_sections']= unserialize(urldecode($this->Master_model->getTexts('texts','home_sections')));
		
		$this->data['p_3fproducts']= $this->Product_model->get3StatusFProducts();
		
		$this->load->view('layout/default',$this->data);
	}

	public function login()
	{	
		$this->data['page']='login';
		$this->load->view('layout/default',$this->data);

		if ($vals=$this->input->post()) {
			
			if (!empty($vals['email']) && !empty($vals['password'])) {


				if ($this->Login_model->isExistCustomer($vals['email'])) {


					if ($row=$this->Login_model->authenticateCustomer($vals['email'],$vals['password'])){
						$this->session->set_userdata('cus_id',$row->cus_id);
						$this->session->set_userdata('cus_type',$row->cus_type);
						$c_product = $this->session->userdata('c_product');
						if (!empty($c_product)) {
							$this->load->model('Cart_model');
							$customer_id = $this->session->userdata('cus_id');
							$this->Cart_model->save($c_product,$customer_id);
							$this->session->unset_userdata('c_product');

						}
						$cs_name=getCustomerSludById($this->session->userdata('cus_id'));
						$st_name=$site_info_data['site_name'];
						setMsg('success','Hello! <strong>'. getCustomerById($this->session->userdata('cus_id')).'</strong>,From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.');
						redirect(base_url($cs_name.'/dashboard'),'refresh');

					}else{
						setMsg('error','Invalid Email or Password');
						redirect('login','refresh');
					}


				}else{
					setMsg('error','No customer with this email');
					redirect('login','refresh');
				}

			}else{
				setMsg('error','Please enter Email and Password');
				redirect('login','refresh');
			}
		}


	}

	public function contact()
	{	
		$this->data['page']='contact';
		$ar_map=$this->Master_model->getSpecCol('siteadmin','site_id','1','site_contact_map');
		$this->data['map'] = $ar_map;
		$this->load->view('layout/default',$this->data);

	}


	
	public function quick_login()
	{	
		$this->data['page']='login';
		$this->load->view('login',$this->data);
		if ($vals=$this->input->post()) {
			
			if (!empty($vals['username']) && !empty($vals['password'])) {


				if ($this->Login_model->isExistAdmin($vals['username'])) {


					if ($row=$this->Login_model->authenticate($vals['username'],$vals['password'])){
						$this->session->set_userdata('site_id',$row->site_id);
						$this->session->set_userdata('site_type','super_admin');
						redirect('apanel','refresh');

					}else{
						setMsg('error','Invalid Username and Password');
					}


				}else{
					setMsg('error','No Admin or Dealer with this username');
				}

			}else{
				setMsg('error','Please enter Username and Password');
			}
		}


	}


	public function create_account()
	{	
		$this->data['page']='create_account';
		$this->load->view('layout/default',$this->data);
		$post = $this->input->post();
		if ($vals = $this->input->post()) {

			if (!empty($vals['cus_fname']) && !empty($vals['cus_lname']) && !empty($vals['cus_email']) && !empty($vals['cus_cpassword']) && !empty($vals['cus_password']) && !empty($vals['cus_city']) && !empty($vals['cus_state']) && !empty($vals['cus_country']) && !empty($vals['cus_street'])) {
				if (!filter_var($vals['cus_email'], FILTER_VALIDATE_EMAIL)) {
					setMsg('error', 'Invalid email. Please check');
					redirect(base_url('create_account'));
				} else {



					if (isset($post['g-recaptcha-response']) && !empty($post['g-recaptcha-response'])) {
                    //your site secret key
						$secret = '6Lf_nWwUAAAAAN_QKbYWwwf0r6DDWct52DoYzETF';
						$ch = curl_init();

						curl_setopt_array($ch, [
							CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
							CURLOPT_POST => true,
							CURLOPT_POSTFIELDS => [
								'secret' => $secret,
								'response' => $post['g-recaptcha-response'],
								'remoteip' => $_SERVER['REMOTE_ADDR']
							],
							CURLOPT_RETURNTRANSFER => true
						]);

						$output = curl_exec($ch);
						curl_close($ch);

						$responseData = json_decode($output);

						if ($responseData->success) {
							$signal = 'ok';
						}


						if ($signal == 'ok') {
							unset($vals['g-recaptcha-response']);
							unset($post['g-recaptcha-response']);
							$vals['cus_name'] = toSlugUrl($vals['cus_fname'].' '.$vals['cus_lname']);

							if ($this->Customer_model->isAlreadyExist($vals['cus_email'] ,$vals['cus_phone'])) {
								$this->data['post'] = $vals;
								setMsg('error', 'Customer already exists for this email or phone');
								redirect(base_url('create_account'));

							} else {
								if ($vals['cus_password'] == $vals['cus_cpassword']){
									unset($vals['cus_cpassword']);
									$vals['cus_password'] = md5($vals['cus_password']);
									if ($row = $this->Customer_model->save($vals)) {
										setMsg('success', 'Thank you for registering');
										redirect(base_url('create_account'), 'refresh');

									}
								}else{
									$this->data['post'] = $vals;
									setMsg('error', 'Password and its confirmation not matched.');
									redirect(base_url('create_account'));
								}
							}
						}
						else{
							$this->data['post'] = $vals;
							setMsg('error', 'Invalid captcha  reCAPTCHA box.');
							redirect(base_url('create_account'));

						}

					}else{
						$this->data['post'] = $vals;
						setMsg('error', 'Invalid captcha, Please click on the reCAPTCHA box.');
						redirect(base_url('create_account'));

					}
				}

			} else {
				$this->data['post'] = $vals;
				setMsg('error', 'Please enter all required fields');
				redirect(base_url('create_account'));
			}

		}



	}





	public function search()
	{
		$cat=$this->input->get('cat');
		$query=$this->input->get('query');

		if ($query=='') {
			$this->data['s_products']=$this->Index_model->searchCat($cat);
		}else{
			$this->data['s_products']=$this->Index_model->searchQuery($cat,$query);

		}
		$this->data['page']='search';
		$this->load->view('layout/default',$this->data);

	}



	public function logout()
	{	

		$this->session->unset_userdata('cus_id');
		$this->session->unset_userdata('cus_type');
		$this->session->unset_userdata('c_product');

		redirect('login','refresh');
	}

	public function settings() {
		$this->isLogged();
		$this->data['pageView'] =  '/settings';
		$this->data['enable_editor'] = TRUE;
		$this->load->model('Master_model');
		pr($vals);exit;

		if ($vals = $this->input->post()) {
			if ($this->input->post('site_name') != '' || $this->input->post('site_email') !='') {


				$this->Master_model->save('siteadmin', $vals, 'site_id', '1');
				setMsg('success', 'Settings has been updated successfully.');
				redirect(base_url() .  '/settings', 'refresh');
				exit;
			}
		}


		$this->data['row'] = $this->Master_model->getRow('siteadmin', 'site_id', '1');
		$gt_id = $this->session->user_data('d_id');
		$this->data['row'] = $this->Master_model->getRow('dealers', 'd_id', $gt_id);
		pr($settings);

		$this->load->view('/includes/siteMaster', $this->data);
	}

	public function change_password() {
		$this->isLogged();
		$this->data['pageView'] = '/change_password';
		$this->load->model('Master_model');

		if ($vals = $this->input->post()) {
			if ($vals['site_opswd'] != '' && $vals['site_pswd'] != '') {
				if ($vals['site_pswd'] == $vals['site_cpswd']):
					$this->load->model('Admin');
					if ($this->Admin->checkOldPswd($vals['site_opswd'])):
						$new_vals['site_password'] = md5($vals['site_pswd']);
						$this->Admin->saveSettings($new_vals);
						setMsg('success', 'Password has been changed successfully.');
						redirect(base_url() . '/change_password', 'refresh');
						exit;
					else:
						setMsg('error', 'Invalid old password.');
						redirect(base_url() . '/change_password', 'refresh');
						exit;
					endif;
				else:
					setMsg('error', 'Password and its confirmation not matched.');
					redirect(base_url() . '/change_password', 'refresh');
					exit;
				endif;
			}
		}
		$this->load->view('/includes/siteMaster', $this->data);
	}

	private function isLogin() {
		if ($this->session->userdata('admin_id') > 0 || $this->session->userdata('d_id') > 0) {
			redirect('/logout', 'refresh');
			exit;
		}
	}

	public function checklogin() {
		$this->session->set_userdata('admin_id', $this->data['settings']->site_id);
		$this->session->set_userdata('admin_type', 'SuperAdmin');
		redirect('/index', 'refresh');
	}

	public function test_login() {
		$this->session->set_userdata('admin_id', '1');
		$this->session->set_userdata('admin_type', 'SuperAdmin');
		redirect('/index', 'refresh');
		exit;
	}

	public function get_carts(){
		$cs_id=$this->session->userdata('cus_id');
		$result=getCart($cs_id);
		echo json_encode($result);
		exit;
	}

	public function get_carts_count(){
		$cs_id=$this->session->userdata('cus_id');
		$carts_count=getCartCount($cs_id);
		$result['carts_count']=$carts_count;
		echo json_encode($result);
		exit;
	}
	public function get_cart_price(){
		$cs_id=$this->session->userdata('cus_id');
		$carts_count=getCartPrice($cs_id);
		$result['cart_price']=$carts_count;
		echo json_encode($result);
		exit;
	}

}



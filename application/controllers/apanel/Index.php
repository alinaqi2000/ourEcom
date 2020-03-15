<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MY_Admin
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->model('Admin_model');
		$this->load->model('Master_model');
		// $this->load->helper('cookie');
	}

	public function home()
	{
		// pr($this->session->userdata());exit;
		// echo $this->input->cookie('themeMode', true);
		// exit;

		$this->isLogged();
		$this->data['page'] = 'home';
		$this->load->view(ADMIN . '/layout/default', $this->data);
	}

	public function dark_mode()
	{
		$mode = $this->input->post('mode');
		$dark = $this->input->post('dark');
		$light = $this->input->post('light');
		$getMode = $this->session->userdata('themeMode');
		if ($getMode == 'light' || empty($getMode)) {
			$this->session->set_userdata('themeMode', 'dark');
			$this->session->set_userdata('themeSheet', $dark);

			$themeColor['mode'] = 'dark';
		} else {
			$this->session->set_userdata('themeMode', 'light');
			$this->session->set_userdata('themeSheet', $light);

			$themeColor['mode'] = 'light';
		}

		echo json_encode($themeColor);
		exit;
	}
	public function side_mode()
	{
		// $mode = $this->input->post('mode');
		$getMode = $this->session->userdata('sideMode');
		if ($getMode == 'open' || empty($getMode)) {
			$this->session->set_userdata('sideMode', 'closed');
			$sideMode['mode'] = 'open';
		} else {
			$this->session->set_userdata('sideMode', 'open');
			$sideMode['mode'] = 'closed';
		}

		echo json_encode($sideMode);
		exit;
	}


	public function login()
	{
		$this->data['page'] = 'login';
		$this->load->view('apanel/layout/default', $this->data);
		if ($vals = $this->input->post()) {

			if (!empty($vals['username']) && !empty($vals['password'])) {


				if ($this->Login_model->isExistAdmin($vals['username'])) {


					if ($row = $this->Login_model->authenticate($vals['username'], $vals['password'])) {
						$this->session->set_userdata('site_id', $row->site_id);
						if ($row->site_type == 'super_admin') {
							$this->session->set_userdata('site_type', 'super_admin');
						} else {
							$this->session->set_userdata('site_type', 'local_admin');
						}

						if (!$this->session->userdata('gotUrl')) {
							$gotUrl = base_url(ADMIN . '/home');
						} else {
							$gotUrl = $this->session->userdata('gotUrl');
							$this->session->unset_userdata('gotUrl');
						}

						redirect($gotUrl, 'refresh');
					} else {
						setMsg('error', 'Invalid Username or Password');
						redirect('apanel/login', 'refresh');
					}
				} else {
					setMsg('error', 'No Admin with this username');
					redirect('apanel/login', 'refresh');
				}
			} else {
				setMsg('error', 'Please enter Username and Password');
				redirect('apanel/login', 'refresh');
			}
		}
	}
	public function logout()
	{

		$this->session->unset_userdata('site_id');
		$this->session->unset_userdata('d_id');
		$this->session->unset_userdata('site_type');
		$this->session->set_userdata('sideMode');

		redirect('apanel/login', 'refresh');
	}


	public function site_themes()
	{
		$this->isLoggedAdmin();
		$this->data['page'] =  'site_themes';
		$this->load->view('apanel/layout/default', $this->data);


		if ($vals = $this->input->post()) {
			if (is_array($vals)) {

				if (isset($_FILES["sidebar_banner"]["name"]) && $_FILES["sidebar_banner"]["name"] != "") {
					$image = upload_image('./uploads/apanel/media/', 'sidebar_banner');
					if (!empty($image['file_name'])) {
						$vals['sidebar_banner'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}

				$new_vals['site_theme_data'] = serialize($vals);
				if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', '1')) {
					setMsg('success', 'Theme settings updated successfully');
				}
			} else {
				setMsg('error', 'Please enter all fields');
			}
			redirect(base_url(ADMIN) .  '/site_themes', 'refresh');
		}
	}

	public function home_sections()
	{
		$this->isLoggedAdmin();
		$this->data['page'] =  'home_sections';
		$home_texts = unserialize(urldecode($this->Master_model->getTexts('texts', 'home_sections')));
		$this->data['row'] = $home_texts;
		$this->load->view('apanel/layout/default', $this->data);


		if ($vals = $this->input->post()) {
			if (is_array($vals)) {


				$new_vals['txt_data'] = serialize($vals);
				if ($this->Master_model->saveTexts('texts', 'home_sections', $new_vals)) {
					setMsg('success', 'Home Sections saved successfully');
				}
			} else {
				setMsg('error', 'Please enter all fields');
			}
			redirect(base_url(ADMIN) .  '/home_sections', 'refresh');
		}
	}
	public function banners()
	{
		$this->isLoggedAdmin();
		$this->data['page'] =  'banners';
		$home_texts = unserialize(urldecode($this->Master_model->getTexts('texts', 'banners')));
		$this->data['row'] = $home_texts;
		$this->load->view('apanel/layout/default', $this->data);


		if ($vals = $this->input->post()) {
			if (is_array($vals)) {

				if (isset($_FILES["s1_banner"]["name"]) && $_FILES["s1_banner"]["name"] != "") {
					$image = upload_image('./uploads/banners/', 's1_banner');
					if (!empty($image['file_name'])) {
						$vals['s1_banner'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}
				if (isset($_FILES["s2_banner"]["name"]) && $_FILES["s2_banner"]["name"] != "") {
					$image = upload_image('./uploads/banners/', 's2_banner');
					if (!empty($image['file_name'])) {
						$vals['s2_banner'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}
				if (isset($_FILES["s3_banner"]["name"]) && $_FILES["s3_banner"]["name"] != "") {
					$image = upload_image('./uploads/banners/', 's3_banner');
					if (!empty($image['file_name'])) {
						$vals['s3_banner'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}
				if (isset($_FILES["p_banner"]["name"]) && $_FILES["p_banner"]["name"] != "") {
					$image = upload_image('./uploads/banners/', 'p_banner');
					if (!empty($image['file_name'])) {
						$vals['p_banner'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}
				if (isset($_FILES["ctop_banner"]["name"]) && $_FILES["ctop_banner"]["name"] != "") {
					$image = upload_image('./uploads/banners/', 'ctop_banner');
					if (!empty($image['file_name'])) {
						$vals['ctop_banner'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}
				$new_vals['txt_data'] = serialize($vals);
				if ($this->Master_model->saveTexts('texts', 'banners', $new_vals)) {
					setMsg('success', 'Home Sections saved successfully');
				}
			} else {
				setMsg('error', 'Please enter all fields');
			}
			redirect(base_url(ADMIN) .  '/banners', 'refresh');
		}
	}
	public function manage_admins()
	{
		$this->isLoggedAdmin();
		$this->data['page'] =  'manage_admins';
		$this->data['rows'] =  $this->Master_model->getRows('tbl_siteadmin', 'site_id <> 1');
		$this->load->view('apanel/layout/default', $this->data);
	}
	public function add_admin()
	{
		$this->isLoggedAdmin();
		$this->data['page'] =  'manage_admins';
		$this->data['mode'] =  'add';
		$this->load->view('apanel/layout/default', $this->data);
		if ($this->session->userdata('site_id') == '1') {
			if ($vals = $this->input->post()) {
				if (is_array($vals)) {

					if ($vals['imgType'] == 'gallery') {

						copy('./uploads/gallery/' . $vals['admin_image'], './uploads/apanel/admin/' . $vals['admin_image']);
					} elseif ($vals['imgType'] == 'browse') {
						if (isset($_FILES["admin_image"]["name"]) && $_FILES["admin_image"]["name"] != "") {
							$image = upload_image('./uploads/apanel/admin/', 'admin_image');
							if (!empty($image['file_name'])) {
								$vals['admin_image'] = $image['file_name'];
							} else {
								setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
							}
						}
					}
					unset($vals['imgType']);
					unset($vals['passY']);
					$new_vals['site_type'] = $vals['site_type'];
					$new_vals['site_login'] = $vals['site_login'];
					$new_vals['site_pswd'] = md5($vals['site_pswd']);
					unset($vals['site_pswd']);
					unset($vals['site_login']);
					unset($vals['site_type']);
					$new_vals['site_admin_data'] = serialize($vals);

					if ($row = $this->Master_model->save('siteadmin', $new_vals)) {
						setMsg('success', 'Admin added successfully');

						redirect(base_url(ADMIN) .  '/manage_admins', 'refresh');
					}
				} else {
					setMsg('error', 'Please enter all fields');
					redirect(base_url(ADMIN) .  '/manage_admins', 'refresh');
				}
			}
		} else {
			setMsg('error', 'You are not eligible for using this feature.');
			redirect(base_url() . ADMIN . '/manage_admins', 'refresh');
		}
	}
	public function edit_admin($edit_id)
	{
		$this->isLoggedAdmin();
		$this->data['page'] =  'manage_admins';
		$this->data['mode'] =  'edit';
		$this->data['row'] = $this->Master_model->getRow('tbl_siteadmin', 'site_id', $edit_id);
		$this->load->view('apanel/layout/default', $this->data);
		$gotAdmin = $this->Master_model->getRow('tbl_siteadmin', 'site_id', $edit_id);
		if ($this->session->userdata('site_id') == '1') {
			if ($vals = $this->input->post()) {
				if (isset($_REQUEST['delImage'])) {
					if (is_array($vals)) {
						if ($vals['passY'] != 1) {

							unset($vals['site_pswd']);
							if (empty($this->Admin_model->isAlreadyExistEdit($vals['site_login'], $edit_id))) {

								if (!empty($vals['admin_image'])) {
									$got = "./uploads/apanel/admin/" . $vals['admin_image'];
									unset($vals['admin_image']);
									unlink($got);
								}
								$new_vals['site_type'] = $vals['site_type'];
								$new_vals['site_login'] = $vals['site_login'];
								unset($vals['imgType']);
								unset($vals['site_login']);
								unset($vals['site_type']);
								$new_vals['site_admin_data'] = serialize($vals);

								if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', $edit_id)) {
									setMsg('success', 'Admin Updated successfully');

									redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
								}
							} else {
								setMsg('error', 'An admin already exists with this username.');

								redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
							}
						} else {
							$new_vals['site_pswd'] = md5($vals['site_pswd']);
							if ($gotAdmin->site_pswd != $new_vals['site_pswd'] && $gotAdmin->site_pswd != $vals['site_pswd']) {
								unset($vals['site_pswd']);
								if (empty($this->Admin_model->isAlreadyExistEdit($vals['site_login'], $edit_id))) {

									if (!empty($vals['admin_image'])) {
										$got = "./uploads/apanel/admin/" . $vals['admin_image'];
										unset($vals['admin_image']);
										unlink($got);
									}
									$new_vals['site_type'] = $vals['site_type'];
									$new_vals['site_login'] = $vals['site_login'];
									unset($vals['imgType']);
									unset($vals['site_login']);
									unset($vals['site_type']);
									$new_vals['site_admin_data'] = serialize($vals);

									if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', $edit_id)) {
										setMsg('success', 'Admin Updated successfully');

										redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
									}
								} else {
									setMsg('error', 'An admin already exists with this username.');

									redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
								}
							} else {
								setMsg('error', 'Please change admin password');
								redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
							}
						}
						unset($vals['passY']);
					} else {
						setMsg('error', 'Please enter all fields');
						redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
					}
				} else {
					if (is_array($vals)) {
						if ($vals['passY'] != 1) {

							unset($vals['site_pswd']);
							if (empty($this->Admin_model->isAlreadyExistEdit($vals['site_login'], $edit_id))) {

								if ($vals['imgType'] == 'gallery') {

									copy('./uploads/gallery/' . $vals['admin_image'], './uploads/apanel/admin/' . $vals['admin_image']);
								} elseif ($vals['imgType'] == 'browse') {
									if (isset($_FILES["admin_image"]["name"]) && $_FILES["admin_image"]["name"] != "") {
										$image = upload_image('./uploads/apanel/admin/', 'admin_image');
										if (!empty($image['file_name'])) {
											$vals['admin_image'] = $image['file_name'];
										} else {
											setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
										}
									}
								}
								unset($vals['imgType']);
								$new_vals['site_type'] = $vals['site_type'];
								$new_vals['site_login'] = $vals['site_login'];

								unset($vals['site_login']);
								unset($vals['site_type']);
								$new_vals['site_admin_data'] = serialize($vals);

								if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', $edit_id)) {
									setMsg('success', 'Admin Updated successfully');

									redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
								}
							} else {
								setMsg('error', 'An admin already exists with this username.');

								redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
							}
						} else {
							$new_vals['site_pswd'] = md5($vals['site_pswd']);
							if ($gotAdmin->site_pswd != $new_vals['site_pswd'] && $gotAdmin->site_pswd != $vals['site_pswd']) {
								unset($vals['site_pswd']);
								if (empty($this->Admin_model->isAlreadyExistEdit($vals['site_login'], $edit_id))) {

									if ($vals['imgType'] == 'gallery') {

										copy('./uploads/gallery/' . $vals['admin_image'], './uploads/apanel/admin/' . $vals['admin_image']);
									} elseif ($vals['imgType'] == 'browse') {
										if (isset($_FILES["admin_image"]["name"]) && $_FILES["admin_image"]["name"] != "") {
											$image = upload_image('./uploads/apanel/admin/', 'admin_image');
											if (!empty($image['file_name'])) {
												$vals['admin_image'] = $image['file_name'];
											} else {
												setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
											}
										}
									}
									unset($vals['imgType']);
									$new_vals['site_type'] = $vals['site_type'];
									$new_vals['site_login'] = $vals['site_login'];

									unset($vals['site_login']);
									unset($vals['site_type']);
									$new_vals['site_admin_data'] = serialize($vals);

									if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', $edit_id)) {
										setMsg('success', 'Admin Updated successfully');

										redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
									}
								} else {
									setMsg('error', 'An admin already exists with this username.');

									redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
								}
							} else {
								setMsg('error', 'Please change admin password');
								redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
							}
						}
						unset($vals['passY']);
					} else {
						setMsg('error', 'Please enter all fields');
						redirect(base_url(ADMIN) .  '/manage_admins/edit/' . $edit_id, 'refresh');
					}
				}
			}
		} else {
			setMsg('error', 'You are not eligible for using this feature.');
			redirect(base_url() . ADMIN . '/manage_admins', 'refresh');
		}
	}
	function admin_delete($del_id)
	{
		$this->isLoggedAdmin();
		if ($this->session->userdata('site_id') == '1') {
			$this->Master_model->delete('tbl_siteadmin', 'site_id', $del_id);
			setMsg('success', 'Admin has been deleted successfully.');
			redirect(base_url() . ADMIN . '/manage_admins', 'refresh');
		} else {
			setMsg('error', 'You are not eligible for using this feature.');
			redirect(base_url() . ADMIN . '/manage_admins', 'refresh');
		}
	}



	public function admin_profile()
	{
		$this->isLogged();
		$this->data['page'] =  'admin_profile';
		$this->load->view('apanel/layout/default', $this->data);
		$st_id = $this->session->userdata('site_id');

		if ($vals = $this->input->post()) {
			// echo $this->input->post('delImage');
			// exit;
			if (isset($_REQUEST['delImage'])) {
				if (is_array($vals)) {
					// $this->input->get_post('some_data');

					if (empty($this->Admin_model->isAlreadyExistEdit($vals['site_login'], $st_id))) {

						if (!empty($vals['admin_image'])) {
							$got = "./uploads/apanel/admin/" . $vals['admin_image'];
							unset($vals['admin_image']);
							unlink($got);
						}
						unset($vals['imgType']);
						$new_vals['site_login'] = $vals['site_login'];
						unset($vals['site_login']);
						$new_vals['site_admin_data'] = serialize($vals);
						if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', $st_id)) {
							setMsg('success', 'Admin settings updated successfully');
						}
					} else {
						setMsg('error', 'An admin already exists with this username.');
					}
				} else {
					setMsg('error', 'Please enter all fields');
				}
			} else {
				if (is_array($vals)) {
					if (empty($this->Admin_model->isAlreadyExistEdit($vals['site_login'], $st_id))) {
						if ($vals['imgType'] == 'gallery') {

							copy('./uploads/gallery/' . $vals['admin_image'], './uploads/apanel/admin/' . $vals['admin_image']);
						} elseif ($vals['imgType'] == 'browse') {
							if (isset($_FILES["admin_image"]["name"]) && $_FILES["admin_image"]["name"] != "") {
								$image = upload_image('./uploads/apanel/admin/', 'admin_image');
								if (!empty($image['file_name'])) {
									$vals['admin_image'] = $image['file_name'];
								} else {
									setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
								}
							}
						}
						unset($vals['imgType']);
						$new_vals['site_login'] = $vals['site_login'];
						unset($vals['site_login']);
						$new_vals['site_admin_data'] = serialize($vals);
						if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', $st_id)) {
							setMsg('success', 'Admin settings updated successfully');
						}
					} else {
						setMsg('error', 'An admin already exists with this username.');
					}
				} else {
					setMsg('error', 'Please enter all fields');
				}
			}
			redirect(base_url(ADMIN) .  '/admin_profile', 'refresh');
		}
	}
	public function site_contact()
	{
		$this->isLoggedAdmin();
		$setng = $this->Master_model->getSpecCol('siteadmin', 'site_id', '1', 'site_contact_data');
		$arr = unserialize(urldecode($setng));
		stripcslashes($arr);
		$ar_map = $this->Master_model->getSpecCol('siteadmin', 'site_id', '1', 'site_contact_map');
		$this->data['rows'] = $arr;
		$this->data['map'] = htmlentities($ar_map);
		$this->data['page'] =  'site_contact';
		$this->load->view('apanel/layout/default', $this->data);


		if ($vals = $this->input->post()) {
			if ($this->input->post('contact_email') != '' || $this->input->post('contact_phone') != '') {

				$new_vals['site_contact_map'] = $vals['contact_map'];
				unset($vals['contact_map']);
				$new_vals['site_contact_data'] = serialize($vals);
				if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', '1')) {
					setMsg('success', 'Contact settings updated successfully');
				}
			} else {
				setMsg('error', 'Please enter all fields');
			}
			redirect(base_url(ADMIN) .  '/site_contact', 'refresh');
		}
	}


	public function site_social()
	{
		$this->isLoggedAdmin();
		$setng = $this->Master_model->getSpecCol('siteadmin', 'site_id', '1', 'site_social_data');
		$arr = unserialize(urldecode($setng));
		stripcslashes($arr);
		$this->data['rows'] = $arr;
		$this->data['page'] =  'site_social';
		$this->load->view('apanel/layout/default', $this->data);


		if ($vals = $this->input->post()) {
			$new_vals['site_social_data'] = serialize($vals);
			if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', '1')) {
				setMsg('success', 'Social settings updated successfully');
			}

			redirect(base_url(ADMIN) .  '/site_social', 'refresh');
		}
	}
	public function site_settings()
	{
		$this->isLoggedAdmin();
		$setng = $this->Master_model->getSpecCol('siteadmin', 'site_id', '1', 'site_info_data');
		$arr = unserialize(urldecode($setng));
		stripcslashes($arr);
		$this->data['rows'] = $arr;

		if ($vals = $this->input->post()) {
			if (!empty($vals['site_name'])) {



				if (isset($_FILES["site_logo"]["name"]) && $_FILES["site_logo"]["name"] != "") {
					$image = upload_image('./uploads/logo/', 'site_logo');
					if (!empty($image['file_name'])) {
						$vals['site_logo'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}
				if (isset($_FILES["sec_logo"]["name"]) && $_FILES["sec_logo"]["name"] != "") {
					$image = upload_image('./uploads/logo/', 'sec_logo');
					if (!empty($image['file_name'])) {
						$vals['sec_logo'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}

				if (isset($_FILES["site_favicon"]["name"]) && $_FILES["site_favicon"]["name"] != "") {
					$image = upload_image('./uploads/logo/', 'site_favicon');
					if (!empty($image['file_name'])) {
						$vals['site_favicon'] = $image['file_name'];
					} else {
						setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
					}
				}
				$new_vals['site_info_data'] = serialize($vals);
				if ($row = $this->Master_model->save('siteadmin', $new_vals, 'site_id', '1')) {
					setMsg('success', 'Site settings updated successfully');
				}
			} else {
				setMsg('error', 'Please enter all fields');
			}

			redirect(base_url(ADMIN) . '/site_settings', 'refresh');
		}


		$this->data['page'] = 'site_settings';
		$this->load->view('apanel/layout/default', $this->data);
	}


	public function change_pswd()
	{
		$this->isLogged();
		$this->data['page'] = 'change_password';
		$this->load->view('apanel/layout/default', $this->data);

		if ($vals = $this->input->post()) {
			$st_id = $this->session->userdata('site_id');
			if ($vals['site_opswd'] != '' && $vals['site_pswd'] != '') {
				if ($vals['site_pswd'] == $vals['site_cpswd']) :
					if ($this->Admin_model->checkOldPswd($st_id, $vals['site_opswd'])) :
						$new_vals['site_pswd'] = md5($vals['site_pswd']);
						$this->Admin_model->saveSettings($new_vals, $st_id);
						setMsg('success', 'Password has been changed successfully.');
						redirect(base_url(ADMIN) . '/change_pswd', 'refresh');
						exit;
					else :
						setMsg('error', 'Invalid old password.');
						redirect(base_url(ADMIN) . '/change_pswd', 'refresh');
						exit;
					endif;
				else :
					setMsg('error', 'Password and its confirmation not matched.');
					redirect(base_url(ADMIN) . '/change_pswd', 'refresh');
					exit;
				endif;
			}
		}
	}

	private function isLogin()
	{
		if ($this->session->userdata('admin_id') > 0 || $this->session->userdata('d_id') > 0) {
			redirect('/logout', 'refresh');
			exit;
		}
	}

	public function checklogin()
	{
		$this->session->set_userdata('admin_id', $this->data['settings']->site_id);
		$this->session->set_userdata('admin_type', 'SuperAdmin');
		redirect('/index', 'refresh');
	}

	public function test_login()
	{
		$this->session->set_userdata('admin_id', '1');
		$this->session->set_userdata('admin_type', 'SuperAdmin');
		redirect('/index', 'refresh');
		exit;
	}
}

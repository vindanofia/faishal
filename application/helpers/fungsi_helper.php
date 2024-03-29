<?php

function check_already_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if ($user_session) {
		redirect('Admin/dashboard');
	}
}

function check_not_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if (!$user_session) {
		redirect('auth/login');
	}
}

function check_admin()
{
	$ci = &get_instance();
	$ci->load->library('fungsi');
	if ($ci->fungsi->user_login()->id_role != 1) {
		redirect('Admin/dashboard');
	}
}

function indo_currency($value)
{
	return 'Rp. ' . number_format($value, 0, ",", ".");
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('activities_m');
  }

	public function index()
	{
		$activities = $this->activities_m->activities();
		$trtd = '
		<tr>
			<td><a href="{profile}">{fullname}</a></td>
			<td>{title} <span class="badge badge-secondary">{score}pt</span></td>
			<td>{solved_time}</td>
		</tr>';

		$table = '';
		foreach ($activities as $row) {
			$row = array(
				'fullname' => $row['fullname'],
				'title' => $row['title'],
				'score' => $row['score'],
				'solved_time' => $row['solved_time'],
				'profile' => base_url('profile/').$row['id']
			);
			$table .= $this->parser->parse_string($trtd, $row, TRUE);
		}
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo; Activities',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'dashboard/activities',
			'activities' => $table
		);
		$this->parser->parse('layout', $data);
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scoreboard extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('scoreboard_m');
  }

	public function index()
	{
		$solvers = $this->scoreboard_m->solvers();
		$trtd = '
		<tr>
			<td>{rank}</td>
			<td><a href="{profile}">{fullname}</a></td>
			<td>{score}pt</td>
			<td>{created_at}</td>
		</tr>';

		$i = 1;
		$table = '';
		foreach ($solvers as $row) {
			$row = array(
				'rank' => $i++,
				'fullname' => $row['fullname'],
				'score' => $row['score'],
				'created_at' => $row['created_at'],
				'profile' => base_url('profile/').$row['id']
			);
			$table .= $this->parser->parse_string($trtd, $row, TRUE);
		}
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo; Scoreboard',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'dashboard/scoreboard',
			'solvers' => $table
		);
		$this->parser->parse('layout', $data);
	}

}

<?php
class Functions {

	function __construct() {
        $this->_ci = & get_instance();
		// $this->_ci->load->model('m_users');
		// $this->m_users =& $this->_ci->m_users;
    }
	
	public function check_session() {
		$this->_ci->load->library('tank_auth');
		if(!$this->_ci->tank_auth->is_logged_in()) {
			redirect('/');
		}
	}
	
	public function format_date($date, $format='d/m/Y') {
		return date($format, strtotime($date));
	}
	
	public function get_message($msg) {
		switch($msg) {
			case 'INSERT_SUCCESS': return "Data successfully added"; break;
			case 'UPDATE_SUCCESS': return "Data successfully updated"; break;
			case 'DELETE_SUCCESS': return "Data successfully deleted"; break;
		}
	}

	public function get_status_issue($code) {
		switch ($code) {
			case 1: return '<span class="label label-danger">not solved</span>'; break;
			case 2: return '<span class="label label-warning">in progress</span>'; break;
			case 3: return '<span class="label label-success">solved</span>'; break;
			default: return '<span class="label label-default">no status</span>'; break;
		}
	}

	public function get_month($index, $type='short') {
		$month = array(
			'short' => array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"),
			'long' => array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December")
		);
		return $month[$type][$index];
	}

	public function convert_date($format, $year, $month, $day) {
		
		$data = array(
			'Y' => $year,
			'y' => $year < 200 ? '0'.($year - 2000) : $year - 2000,
			'F' => get_month($month - 1),
			'M' => get_month($month - 1, 'long'),
			'n' => $month,
			'm' => $month < 10 ? '0'.$month : $month,
			'd' => $day < 0 ? '0'.$day : $day,
			'j' => $day
		);
		
		return strtr($format, $data);
	}

	public function format_time($format, $timestamp=0) {
		if($timestamp == 0) $timestamp = time();
		$newformat = strtr($format, array('F'=> '%1', 'M'=> '%2'));	
		$adate = explode(',', date('n,'.$newformat, $timestamp), 2);
		$s = $adate[1];
		if($newformat != $format) {
			$am = (int)$adate[0];		
			$F = get_month($am-1);
			$M = get_month($am-1, 'long');
			$s = strtr($s, array('%1'=>$F, '%2'=>$M));
		}
		return $s;
	}

	public function prepare_duedate($duedate) {

		$date_format = array(
			'default' => 'j/m/Y',
			'short_format' => 'F j, y',
			'long_format' => 'j M, y',		
			'days_ago' => '%d days ago',
			'in_days' => 'in % days'		
		);	
		
		# class for css, # str for view, # formatted for title, # timestamp for real format
		$a = array('class' => '', 'str' => '', 'formatted' => '', 'timestamp' => 0);
		if($duedate == '') { return $a; } # kembalikan nilai kosong jika tidak ada duedate
		
		$ad = explode('-', $duedate);
		$at = explode('-', date('Y-m-d'));
		
		$a['timestamp'] = mktime(0,0,0, $ad[1], $ad[2], $ad[0]);
		
		$diff = mktime(0,0,0,$ad[1],$ad[2],$ad[0]) - mktime(0,0,0,$at[1],$at[2],$at[0]);

		if($diff < -604800 && $ad[0] == $at[0])	{ $a['class'] = 'past'; $a['str'] = convert_date($date_format['short_format'], (int)$ad[0], (int)$ad[1], (int)$ad[2]); }
		elseif($diff < -604800)	{ $a['class'] = 'past'; $a['str'] = convert_date($date_format['short_format'], (int)$ad[0], (int)$ad[1], (int)$ad[2]); }
		elseif($diff < -86400)		{ $a['class'] = 'past'; $a['str'] = sprintf($date_format['days_ago'], ceil(abs($diff)/86400)); }	
		elseif($diff < 0)			{ $a['class'] = 'past'; $a['str'] = "yesterday"; }
		elseif($diff < 86400)		{ $a['class'] = 'today'; $a['str'] = "today"; }
		elseif($diff < 172800)		{ $a['class'] = 'today'; $a['str'] = "tommorow"; }	
		elseif($diff < 691200)		{ $a['class'] = 'soon'; $a['str'] = sprintf($date_format['in_days'],ceil($diff/86400)); }
		elseif($ad[0] == $at[0])	{ $a['class'] = 'future'; $a['str'] = convert_date($date_format['short_format'], (int)$ad[0], (int)$ad[1], (int)$ad[2]); }
		else						{ $a['class'] = 'future'; $a['str'] = convert_date($date_format['short_format'], (int)$ad[0], (int)$ad[1], (int)$ad[2]); }

		$a['formatted'] = format_time($date_format['default'], $a['timestamp']);

		return $a;
	}
}
?>
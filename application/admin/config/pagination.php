<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Profiler Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Profiler
| data are displayed when the Profiler is enabled.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/profiling.html
|
*/

$config['full_tag_open'] = '<div class="pager fr" >';

$config['full_tag_close'] = '</div>';
//
$config['first_link'] = '<span>First</span>';
//$config['first_tag_open'] = '<span class="nav">';
//$config['first_tag_close'] = '</span>';
$config['first_class'] = 'class="first"';

$config['last_link'] = '<span>Last</span>';
//$config['last_tag_open'] = '<span class="nav">';
//$config['last_tag_close'] = '</span>';
$config['last_class'] = 'class="last"';


$config['next_link'] = '<span>Next</span>';
//$config['next_tag_open'] = '<span class="nav">';
//$config['next_tag_close'] = '</span>';
$config['next_class'] = 'class="next"';

$config['prev_link'] = '<span>Previous</span>';
//$config['prev_tag_open'] = '<span >';
//$config['prev_tag_close'] = '</span>';
$config['prev_class'] = 'class="previous"';

$config['cur_tag_open'] = '<span >';
$config['cur_tag_close'] = '</span>';
//$config['anchor_class'] = 'active';

//$config['num_tag_open'] = '<span class="pages">';
//$config['num_tag_close'] = '</span>';
$config['start_tag_open'] = '<span class="nav">';
$config['start_tag_close'] = '</span>';

$config['numbers_tag_open'] = '<span class="pages">';
$config['numbers_tag_close'] = '</span>';

$config['end_tag_open'] = '<span class="nav">';
$config['end_tag_close'] = '</span>';


$config['cur_class'] = 'class="active"';
/* End of file profiler.php */
/* Location: ./application/config/profiler.php */
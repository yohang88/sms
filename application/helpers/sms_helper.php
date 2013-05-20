<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Global Constant //
define('DS', '/');
define('PATHSPOOL',	'/var/spool/sms');

define('PATHSENT',	    PATHSPOOL . DS . 'sent');
define('PATHINCOMING',	PATHSPOOL . DS . 'incoming');
define('PATHCHECKED',	PATHSPOOL . DS . 'checked');
define('PATHOUTGOING',	PATHSPOOL . DS . 'outgoing');
define('PATHSCHEDULED',	PATHSPOOL . DS . 'scheduled');
define('PATHREPORT',	PATHSPOOL . DS . 'report');
define('PATHFAILED',	PATHSPOOL . DS . 'failed');

function nice_date($str, $option=NULL)
{
    // convert the date to unix timestamp
    list($date, $time) = explode(' ', $str);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minute, $second) = explode(':', $time);

    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    $now = time();
    $blocks = array(
    array('name'=>'tahun', 'amount' => 60*60*24*365),
    array('name'=>'bulan', 'amount' => 60*60*24*31),
    array('name'=>'minggu', 'amount' => 60*60*24*7),
    array('name'=>'hari', 'amount' => 60*60*24),
    array('name'=>'jam', 'amount' => 60*60),
    array('name'=>'menit', 'amount' => 60),
    array('name'=>'detik', 'amount' => 1)
    );

    if($timestamp > $now) $string_type = ' lagi';
    else $string_type = ' yang lalu';

    $diff = abs($now-$timestamp);

    if($diff < 60)
    {
        return "Kurang dari satu menit yang lalu";
    }
    else
    {
        $levels = 1;
        $current_level = 1;
        $result = array();
        foreach($blocks as $block)
        {
            if ($current_level > $levels) { break; }
            if ($diff/$block['amount'] >= 1)
            {
                $amount = floor($diff/$block['amount']);
                $plural = '';
                //if ($amount>1) {$plural='s';} else {$plural='';}
                $result[] = $amount.' '.$block['name'].$plural;
                $diff -= $amount*$block['amount'];
                $current_level+=1;
            }
        }
        $res = implode(' ',$result).''.$string_type;
        return $res;
    }
}

function field($validation, $database = NULL, $last = ''){
  $value = ($validation != NULL) ? $validation : ( ($database != NULL) ? $database : $last);
  return $value;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function generateSMSFilename($number, $date) {
    $filename = "";
    return $filename;
}

if ( ! function_exists('is_ajax')) {
    function is_ajax() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }
}

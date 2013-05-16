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
    array('name'=>lang('kalkun_year'), 'amount' => 60*60*24*365),
    array('name'=>lang('kalkun_month'), 'amount' => 60*60*24*31),
    array('name'=>lang('kalkun_week'), 'amount' => 60*60*24*7),
    array('name'=>lang('kalkun_day'), 'amount' => 60*60*24),
    array('name'=>lang('kalkun_hour'), 'amount' => 60*60),
    array('name'=>lang('kalkun_minute'), 'amount' => 60),
    array('name'=>lang('kalkun_second'), 'amount' => 1)
    );

    if($timestamp > $now) $string_type = ' remaining';
    else $string_type = ' '.lang('kalkun_ago');

    $diff = abs($now-$timestamp);

    if($diff < 60)
    {
        return "Less than a minute ago";
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

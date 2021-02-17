<?php

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');		
	global $DB;		
			$user=$_GET['user'];
			$course=$_GET['course'];
			$video=$_GET['video'];
			$state=$_GET['state'];
		 $time_state=(int)$_GET['temp'];
		 
		
		 $records = $DB->get_records_sql('SELECT time_state From {youtube} where user='.$user.' ORDER BY id DESC LIMIT 1 ' );
foreach($records as $record){
    
    $timestat=(int)$record->time_state;
   $statt=$record->state;
   $temp='';
   if( $state==-1 )  $temp='unstarted' ;
   if( $state==0 )  $temp='ended' ;
if( $state==1 )  $temp='playing' ;
if( $state==2 )  $temp='paused' ;
if( $state==3 )  $temp='buffering' ;
if( $state==4 )  $temp='video cued' ;

if(   $time_state > $timestat) $temp='jumpforward' ;
if(    $time_state < $timestat )$temp='jumpbackward' ;



}
		 $record=new stdClass();

$record->user=$user;
$record->course=$course;
$record->video=$video;


$record->time_state=$time_state;

$record->state=$temp;

//$record->event_state=date('Y-m-d H:i:s');
$record->time_occurred=date('Y-m-d H:i');


$id=$DB->insert_record('youtube',$record);
	

?>


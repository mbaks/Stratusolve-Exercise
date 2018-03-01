<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script
if ( !empty($_POST)) {

 	$file = file_get_contents('Task_Data.txt');
 	$data = json_decode($file, true);
 	
 	$last_task    = end($data);
 	$last_task_id = $last_task['TaskId'];
 	
 	Task::Save($data, $_POST, $last_task_id);
}

?>
<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;
    public function __construct($Id = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id))
            $this->Create();
    }
    /**
     * 
     * 
     */
    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
    	
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = 'New Task';
        $this->TaskDescription = 'New Description';
    }
    protected function getUniqueId() {
        // Assignment: Code to get new unique ID
        $id  = uniqid();
        return $id; // Placeholder return for now
    }
    protected function LoadFromId($Id = null) {
        if ($Id) {
            // Assignment: Code to load details here...
        } else
            return null;
    }

    public function Save($data, $form_data, $last_task_id) {
        //Assignment: Code to save task here
        $task = array();
        $task['TaskId'] 			= ++$last_task_id;
        $task['TaskName'] 			= $form_data['TaskName'];
        $task['TaskDescription'] 	= $form_data['TaskDescription'];
        $data 						= array_values($data);
    	array_push($data, $task);
    	file_put_contents("Task_Data.txt", json_encode($data));
    }
    public function Delete($id) {
        //Assignment: Code to delete task here
    	$data = file_get_contents('Task_Data.txt');
    	$data = json_decode($data, true);
    	$jsonfile = $data;
    	$jsonfile = $jsonfile[$id];
    	
    	if ($jsonfile) {
    		unset($data[$id]);
    		$data = array_values($data);
    		file_put_contents("Task_Data.txt", json_encode($data));
    	}
    }
}
?>
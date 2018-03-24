<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Background Worker Library
 *
 * For Processing task/jobs in background processes
 * @category    	Libraries
 * @author			Zeeshan M.
 */
class BackgroundWorker
{
    private $CI;		// CodeIgniter instance
    public $pid = 0;

	public function __construct( $config = array() )
	{
		$this->CI =& get_instance();
    }
    
    public function execute($cmd, $outputfile, $pidfile){
        $this->__execute($cmd, $outputfile, $pidfile);
    }
	
	/**
     * Executes a background job using exec. A file with the content 
     * of the background job's output will be created, and a file holding the 
     * job's pid (process id). 
     *   
     * @param string $cmd the command
     * @param string $outputfile an output file where output of command will be written
     * @param string $pidfile a file where the process number is written
     * @return boolean $res true on success and false on failure
     */
    private function __execute ($cmd, $outputfile, $pidfile) {
        $res = exec(sprintf("%s > %s 2>&1 & echo $! > %s", $cmd, $outputfile, $pidfile));
        if (!$res) {
            $this->pid = trim(file_get_contents($pidfile));
            return true;
        }
        return false;
    }
    
    /**
     * Check if a background process is running. 
     * 
     * @param int $pid the process id to check for
     * @return boolean $res true if running or else false 
     */
    public function isRunning($pid) {
        try {
            $result = shell_exec(sprintf("ps %d", $pid));
            if (count(preg_split("/\n/", $result)) > 2) {
                return true;
            }
        } catch (Exception $e) {
            
        }
        return false;
    }
}
/* EOF */
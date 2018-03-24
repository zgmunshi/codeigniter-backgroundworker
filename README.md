# Codeigniter Background Worker

Codeigniter Background worker will take care of tasks / jobs to be processed in background. Usually we have requirement for processing tasks as background process instead of keeping the system utilized. 
This is very simple approach to tackle race condition or deadlocks by using multi processing approach.

## Installation

Just place it into your codeigniter's library folder and include it wherever required as
```
$this->load->library('backgroundworker');
```

### Usage

Once you have included the library, you can use it directly as 
```
$this->backgroundworker->execute($command,$outputfile,$pidFile);
$command - Command to be executed as background process (curl http://appnzee.com)
$outputfile - Name of File where you want to stream the output 
$pidFile - File name for writing process id
```

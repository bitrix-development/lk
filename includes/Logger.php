<?php

class Logger {
    private $logFile;

    public function __construct() {
        $this->logFile = 'user_actions.log';
    }

    public function logAction($action, $username) {
        $dateTime = date('Y-m-d H:i:s');
        $entry = "[$dateTime] User: $username Action: $action\n";
        file_put_contents($this->logFile, $entry, FILE_APPEND);
    }

    public function logLoginAttempt($username, $success) {
        $dateTime = date('Y-m-d H:i:s');
        $status = $success ? 'SUCCESS' : 'FAILURE';
        $entry = "[$dateTime] User: $username Login Attempt: $status\n";
        file_put_contents($this->logFile, $entry, FILE_APPEND);
    }
}

?>

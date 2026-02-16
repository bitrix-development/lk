<?php

class RateLimiter {
    private $limit;
    private $interval;
    private $attempts = [];

    public function __construct($limit, $interval) {
        $this->limit = $limit;
        $this->interval = $interval;
    }

    public function allowLogin($userId) {
        $currentTime = time();

        // Remove attempts older than the interval
        if (isset($this->attempts[$userId])) {
            $this->attempts[$userId] = array_filter($this->attempts[$userId], function($timestamp) use ($currentTime) {
                return ($currentTime - $timestamp) < $this->interval;
            });
        }

        // Check if the limit has been reached
        if (count($this->attempts[$userId]) < $this->limit) {
            $this->attempts[$userId][] = $currentTime;
            return true; // Allow the login attempt
        }
        return false; // Deny the login attempt
    }
}

?>
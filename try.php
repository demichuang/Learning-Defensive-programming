<?php

class Daemon
{
    public function start()
    {
        $pid = pcntl_fork();

        if ($pid) {
            pcntl_wait($status);
            exit;
        }

        posix_setsid();

        if ($pid) {
            exit;
        }
    }

}
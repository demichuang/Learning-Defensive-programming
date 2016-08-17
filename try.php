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

        // become session leader
        posix_setsid();

        if ($pid) {
            exit;
        }

        $this->echoSomething();

        return $this;
    }

    public function echoSomething()
    {
        for ($i = 0; $i < 5; $i++) {
            echo "child pid " . posix_getpid() . "\n";
        }
    }
}

$http = new Daemon();

$http->start();
<?php

class Daemon
{
    public function start()
    {
        $pid = pcntl_fork();

        if ($pid == -1) {
            echo "Fork Fail!";
        }

        if ($pid) {
            // against Zombie children
            pcntl_wait($status);
            exit;
        }

        // become session leader
        posix_setsid();

        if ($pid == -1) {
            echo "Fork Fail!";
        }

        if ($pid) {
            exit;
        }

        $this->echoSomething();

        return $this;
    }

    public function echoSomething()
    {
        for ($i = 0; $i < 5; $i++) {
            $pid = pcntl_fork();

            if ($pid == -1) {
                echo "Fork Fail!";
            }

            if (!$pid) {
                echo "child pid " . posix_getpid() . "\n";
                exit;
            }
        }
    }
}

$http = new Daemon();

$http->start();
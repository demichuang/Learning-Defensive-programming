<?php

class Daemon
{
    public function start()
    {
        $pid = pcntl_fork();
        $log = './var/log/try.log';

        if ($pid == -1) {
            echo "Fork Fail!";
            file_put_contents($log, "Fork Fail!\n", FILE_APPEND);
        }

        if ($pid) {
            // against zombie children
            pcntl_wait($status);
            exit;
        }

        // become session leader
        posix_setsid();

        if ($pid == -1) {
            echo "Fork Fail!";
            file_put_contents($log, "Fork Fail!\n", FILE_APPEND);
        }

        if ($pid) {
            exit;
        }

        $this->echoSomething();

        return $this;
    }

    public function echoSomething()
    {
        $log = './var/log/try.log';

        echo "After start try.php ...\n";
        file_put_contents($log, "After start try.php ...\n", FILE_APPEND);

        for ($i = 0; $i < 5; $i++) {
            $pid = pcntl_fork();

            if ($pid == -1) {
                echo "Fork Fail!";
                file_put_contents($log, "Fork Fail!\n", FILE_APPEND);
            }

            if (!$pid) {
                echo "child pid " . posix_getpid() . "\n";
                file_put_contents($log, "Get child pid " . posix_getpid() . "\n", FILE_APPEND);
                exit;
            }
        }
    }
}

$http = new Daemon();
$http->start();

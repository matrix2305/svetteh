<?php
namespace Infrastructure\Log;

use AppCore\Interfaces\ILog;

class Log implements ILog
{
    public function AddLog($log){
        LaravelLog::debug($log);
    }
}
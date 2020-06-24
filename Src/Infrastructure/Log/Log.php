<?php
namespace Infrastructure\Log;

use Infrastructure\Interfaces\ILog;

class Log implements ILog
{
    public function AddLog($log){
        LaravelLog::debug($log);
    }
}
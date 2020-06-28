<?php
namespace Infrastructure\Log;

use AppCore\Interfaces\ILog;
use Illuminate\Support\Facades\Log as LaravelLog;

class Log implements ILog
{
    public function AddLog($log){
        LaravelLog::debug($log);
    }
}
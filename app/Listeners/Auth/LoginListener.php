<?php

namespace App\Listeners\Auth;

use App\Events\Auth\LoginSuccess;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginListener
{
    public function handle(LoginSuccess $event)
    {
        // 添加到数据库
    }
}

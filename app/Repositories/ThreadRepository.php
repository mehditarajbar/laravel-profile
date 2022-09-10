<?php

namespace App\Repositories;


use App\Models\Thread;
use Illuminate\Support\Str;

class ThreadRepository
{
    public function all(): Thread
    {
        return Thread::query()->whereFlag(1)->latest()->get();
    }
}

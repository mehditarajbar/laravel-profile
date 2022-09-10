<?php

namespace App\Http\Controllers\API\v1\Thread;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Repositories\ChannelRepository;
use App\Repositories\ThreadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = resolve(ThreadRepository::class)->all();
        return response()->json(
            $threads,Response::HTTP_OK
        );
    }

    public function show($slug)
    {
        $thread=Thread::query()->wherSlug($slug)->whereFlag(1)->first();
        return  response()->json($thread,Response::HTTP_OK);

    }
}

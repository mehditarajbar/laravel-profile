<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelController extends Controller
{
    public function getAllChannels()
    {
        return response()->json(Channel::all(),200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNewChannel(Request $request)
    {
        $request->validate([
            'name'=>['required']
        ]);
        resolve(ChannelRepository::class)->create($request->name);

        return response()->json([
           'message'=>'channel created'
        ],201);

    }


}

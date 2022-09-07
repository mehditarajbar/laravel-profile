<?php

namespace App\Http\Controllers\API\v1\Channel;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    public function getAllChannels()
    {
        $allChannels = resolve(ChannelRepository::class)->all();
        return response()->json($allChannels, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNewChannel(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);
        resolve(ChannelRepository::class)->create($request->name);

        return response()->json([
            'message' => 'channel created'
        ], Response::HTTP_CREATED);

    }

    public function updateChannel(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);
        resolve(ChannelRepository::class)->update($request->id, $request->name);

        return response()->json([
            'message' => 'channel edited'
        ], Response::HTTP_OK);
    }

    public function deleteChannel(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);

        resolve(ChannelRepository::class)->destroy($request->id);
        return response()->json([
            'message' => 'channel deleted'
        ], Response::HTTP_OK);
    }


}

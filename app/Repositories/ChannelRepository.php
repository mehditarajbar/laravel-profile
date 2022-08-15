<?php

namespace App\Repositories;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelRepository
{
    /**
     * @return void
     */
    private function create(Request $request): void
    {
        Channel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
    }

}

<?php

namespace App\Repositories;

use App\Models\Channel;
use Illuminate\Support\Str;

class ChannelRepository
{
    public function all()
    {
        return Channel::all();

    }

    /**
     * @param $name
     */
    public function create($name): void
    {
        Channel::create([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);
    }

    public function update($id, $name)
    {
        Channel::find($id)->update([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);
    }

    public function destroy($id)
    {
        Channel::destroy($id);
    }

}

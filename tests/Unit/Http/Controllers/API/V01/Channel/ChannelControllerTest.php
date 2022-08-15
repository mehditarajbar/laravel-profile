<?php

namespace Tests\Unit\Http\Controllers\API\V01\Channel;

use App\Http\Controllers\API\V01\Channel\ChannelController;
use App\Models\Channel;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{

    public function test_all_channels_list_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));
        $response->assertStatus(200);
    }

    public function test_channel_can_be_created()
    {
        $response = $this->postJson(route('channel.create'),[
            'name'=>'laravel'
        ]);

        $response->assertStatus(201);

    }
}

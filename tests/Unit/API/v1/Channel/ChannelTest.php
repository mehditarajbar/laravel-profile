<?php

namespace Test\Unit\API\v1\Channel;


use App\Models\Channel;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChannelTest extends TestCase
{

    public function test_all_channels_list_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));
        $response->assertStatus(Response::HTTP_OK);
    }
    public function test_channel_should_be_validated()
    {
        $response = $this->postJson(route('channel.create'),[]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    public function test_channel_can_be_created()
    {
        $response = $this->postJson(route('channel.create'),[
            'name'=>'laravel'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }
    public function test_channel_update_should_be_validated()
    {
        $response = $this->json('PUT',route('channel.update'),[]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    public function test_channel_update()
    {
       $channel=Channel::factory()->create([
           'name'=>'Laravel'
       ]);
        $response = $this->json('PUT',route('channel.update'),[
            'id'=>$channel->id,
            'name'=>'Vue.js'
        ]);
        $updateChannel=Channel::find($channel->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals("Vue.js",$updateChannel->name);
    }
    public function test_channel_delete_should_be_validated()
    {
        $response = $this->json('DELETE',route('channel.delete'),[]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    public function test_channel_delete(){
        $channel=Channel::factory()->create();
        $response = $this->json('DELETE',route('channel.delete'),[
           'id' => $channel->id
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }
}

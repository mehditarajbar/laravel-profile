<?php

namespace Tests\Feature\API\v1\Channel;


use App\Models\Channel;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChannelTest extends TestCase
{

    public function registerRolesAndPermissions()
    {

        $getConfigRoles=config('permission.default_roles');
        $roleInDatabase = Role::query()->where('name', $getConfigRoles[0]);
        if ($roleInDatabase->count() < 1) {
            foreach ($getConfigRoles as $role){
                Role::query()->create([
                    'name'=>$role,
                ]);
            }
        }
        $getConfigPermissions=config('permission.default_permissions');
        $permissionInDatabase = Permission::query()->where('name', $getConfigPermissions[0]);
        if ($permissionInDatabase->count() < 1) {
            foreach ($getConfigPermissions as $permission){
                Permission::query()->create([
                    'name'=>$permission,
                ]);
            }
        }
    }
    public function test_all_channels_list_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));
        $response->assertStatus(Response::HTTP_OK);
    }
    public function test_channel_should_be_validated()
    {
        $this->registerRolesAndPermissions();
        $user=User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $response = $this->postJson(route('channel.create'),[]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    public function test_channel_can_be_created()
    {
         $this->registerRolesAndPermissions();
        $user=User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $response = $this->postJson(route('channel.create'),[
            'name'=>'laravel'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }
    public function test_channel_update_should_be_validated()
    {
         $this->registerRolesAndPermissions();
        $user=User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $response = $this->json('PUT',route('channel.update'),[]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    public function test_channel_update()
    {
         $this->registerRolesAndPermissions();
        $user=User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
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
         $this->registerRolesAndPermissions();
        $user=User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $response = $this->json('DELETE',route('channel.delete'),[]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    public function test_channel_delete(){
         $this->registerRolesAndPermissions();
        $user=User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $channel=Channel::factory()->create();
        $response = $this->json('DELETE',route('channel.delete'),[
           'id' => $channel->id
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }
}

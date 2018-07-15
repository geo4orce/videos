<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    //use RefreshDatabase;

    public function testRedirectLogin()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
    }

    public function testPassLogin()
    {
        $user = $this->user = factory(\App\User::class)->create();
        $faker = \Faker\Factory::create();

        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
        $response->assertDontSee('Login');

        // test file upload
        $file = 'SampleVideo_1280x720_1mb.mp4';
        $file = new UploadedFile(base_path('tests/Mocks/' . $file), $file);
        $name = "$faker->titleMale $faker->firstNameMale in $faker->city";

        $response = $this->actingAs($user)->json('POST', '/videos', [
            'name' => $name,
            'video' => $file,
        ]);
        $response->assertStatus(302);

        // Assert the file was stored...
        $video = \App\Video::where('user_id', \Auth::id())->first();
        $this->assertEquals($name, $video->name);
        $this->assertTrue(\File::exists($video->full_path));

        $response = $this->actingAs($user)->get('/mine');
        $response->assertStatus(200);
        $response->assertSee($name);

        // delete
        $response = $this->actingAs($user)->json('DELETE', '/videos/' . $video->id);
        $response->assertStatus(302);
    }
}

<?php

namespace Tests\Unit;

use App\Models\User;
use Faker\Factory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class SendEmailTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }

    public function test_registration_event_fires_up_on_registration()
    {

        //It won't goddamn work!

        Event::fake(Registered::class);

        $user = User::factory()->create();

        Event::assertDispatched(Registered::class);
    }

    // public function test_user_recieves_email_on_registration()
    // {

    //     $this->withoutExceptionHandling();



    //     $user  = User::factory(User::class)->create();

    //     Event::fake([]);

    //     $response = $this->post('/register', [
    //         'name' => 'John Doe',
    //         'email' => 'johndoe@test.com',
    //         'password' => 'secret',
    //         'password_confirmation' => 'secret'
    //     ]);

    //     $response->assertRedirect('/welcome');

    //     Event::assertDispatched(Registered::class);


    //     // $response->assertRedirect('/welcome');
    //     // Event::assertDispatched(Registered::class);
    // }
}

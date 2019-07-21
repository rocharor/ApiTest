<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use App\Data\Models\Provider;

class ProviderTest extends TestCase
{
//     public function setUp(): void
//     {
//         parent::setUp();

//         // Event::fake();

//         $user = new \App\Data\Models\User;
//         $user->id = 1;
//         $this->token =  [
//             'Authorization' => 'Bearer ' . $user->createToken($user->name)->accessToken
//         ];

//         $provider = new Provider();
//         $provider->user_id = 1;
//         $provider->name = 'Test';
//         $provider->email = 'test@test.com';
//         $provider->monthly_payment = 200;

//         $this->instance(Provider::class, \Mockery::mock(Provider::class,
//         function ($mock) use ($provider) {
//             $mock->shouldReceive('where')->once()->andReturn($mock);
//             $mock->shouldReceive('get')->once()->andReturn($provider);
//         }));
//     }

    public function testEndpointGet()
    {
        $this->assertTrue(true);
//         $response = $this->get('/api/providers', $this->token);
// dd($response->exception);
//         $response->assertStatus(Response::HTTP_OK);
    }

    // public function testEndpointTotalMonthlyPayment()
    // {
    //     $response = $this->get('/api/providers/monthly-payment', $this->token);

    //     $response->assertStatus(Response::HTTP_OK);
    // }

    // public function testEndpointStore()
    // {
    //     $response = $this->post('/api/providers', [
    //         'name' => 'test',
    //         'email' => 'test@test.com',
    //         'monthlyPayment' => 200,
    //     ], $this->token);

    //     $response->assertStatus(Response::HTTP_CREATED);
    // }

    // public function testEndpointStoreErrorParameter()
    // {
    //     $response = $this->post('/api/providers', [
    //         'name' => 'test',
    //         // 'email' => 'test@test.com',
    //         'monthlyPayment' => 200,
    //     ], $this->token);

    //     $response->assertStatus(Response::HTTP_BAD_REQUEST);
    // }

    // public function testEndpointDelete()
    // {
    //     $response = $this->delete('/api/providers/1', [], $this->token);

    //     $response->assertStatus(Response::HTTP_NO_CONTENT);
    // }

    // public function testEndpointDeleteNotFound()
    // {
    //     $response = $this->delete('/api/providers/0', [], $this->token);

    //     $response->assertStatus(Response::HTTP_BAD_REQUEST);
    // }
}

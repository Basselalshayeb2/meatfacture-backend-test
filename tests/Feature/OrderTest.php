<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    \App\Models\User::factory()->create([
        'name' => 'test',
        'mobile' => '+79006554129',
        'address' => fake()->address(),
        'password' => Hash::make('123456'),
    ]);

    $this->seed(\Database\Seeders\CategorySeeder::class);
    $this->seed(\Database\Seeders\ProductSeeder::class);
});
it('can login, create order, and get my orders', function () {
    // login
    $response = $this->postJson('/api/login', [
        'mobile' => '+79006554129',
        'password' => '123456',
    ]);

    $response->assertStatus(200);
    $token = $response['data']['token'];
    expect($token)->not->toBeEmpty();

    // create order
    $create = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/orders', [
            'products' => [
                [
                    'product_id' => 1,
                    'quantity' => 2
                ]
            ]
        ]);

    $create->assertStatus(200);

    // get orders
    $get = $this->withHeader('Authorization', "Bearer $token")
        ->getJson('/api/orders');

    $get->assertStatus(200);
    expect($get['data'])->toHaveCount(1);
});

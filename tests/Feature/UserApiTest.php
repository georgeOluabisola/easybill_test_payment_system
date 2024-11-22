<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list all users', function () {
    User::factory(5)->create();

    $response = $this->getJson('/api/users');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

it('can create a user', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password123'
    ];

    $response = $this->postJson('/api/users', $data);

    $response->assertStatus(201)
             ->assertJsonPath('data.name', 'John Doe')
             ->assertJsonPath('data.email', 'john@example.com');

    $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
});

it('can retrieve a specific user', function () {
    $user = User::factory()->create();

    $response = $this->getJson("/api/users/{$user->id}");

    $response->assertStatus(200)
             ->assertJsonPath('data.id', $user->id)
             ->assertJsonPath('data.name', $user->name);
});

it('can update a user', function () {
    $user = User::factory()->create();

    $data = ['name' => 'Jane Doe'];

    $response = $this->putJson("/api/users/{$user->id}", $data);

    $response->assertStatus(200)
             ->assertJsonPath('data.name', 'Jane Doe');

    $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Jane Doe']);
});

it('can delete a user', function () {
    $user = User::factory()->create();

    $response = $this->deleteJson("/api/users/{$user->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

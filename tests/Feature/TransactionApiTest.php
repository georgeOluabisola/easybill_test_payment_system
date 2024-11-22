<?php

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list all transactions', function () {
    Transaction::factory(5)->create();

    $response = $this->getJson('/api/transactions');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

it('can create a transaction', function () {
    $user = User::factory()->create();

    $data = [
        'user_id' => $user->id,
        'amount' => 150.75,
        'status' => 'pending'
    ];

    $response = $this->postJson('/api/transactions', $data);

    $response->assertStatus(201)
             ->assertJsonPath('data.user_id', $user->id)
             ->assertJsonPath('data.amount', '150.75')
             ->assertJsonPath('data.status', 'pending');

    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'amount' => 150.75,
        'status' => 'pending'
    ]);
});

it('can retrieve a specific transaction', function () {
    $transaction = Transaction::factory()->create();

    $response = $this->getJson("/api/transactions/{$transaction->id}");

    $response->assertStatus(200)
             ->assertJsonPath('data.id', $transaction->id)
             ->assertJsonPath('data.amount', (string) $transaction->amount);
});

it('can update a transaction', function () {
    $transaction = Transaction::factory()->create();

    $data = ['amount' => 200.00, 'status' => 'completed'];

    $response = $this->putJson("/api/transactions/{$transaction->id}", $data);

    $response->assertStatus(200)
             ->assertJsonPath('data.amount', '200.00')
             ->assertJsonPath('data.status', 'completed');

    $this->assertDatabaseHas('transactions', [
        'id' => $transaction->id,
        'amount' => 200.00,
        'status' => 'completed'
    ]);
});

it('can delete a transaction', function () {
    $transaction = Transaction::factory()->create();

    $response = $this->deleteJson("/api/transactions/{$transaction->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
});

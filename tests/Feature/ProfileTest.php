<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertSame($user->email, $user->refresh()->email);
    }

    public function test_profile_photo_can_be_uploaded_and_persisted_for_asesor_profile(): void
    {
        Storage::fake('public');

        $role = Role::query()->firstOrCreate([
            'nama_role' => 'ASESOR',
        ], [
            'deskripsi' => 'Asesor',
        ]);

        $user = User::factory()->create([
            'id_role' => $role->id_role,
            'name' => 'Asesor Demo',
        ]);

        $response = $this
            ->actingAs($user)
            ->from('/asesor/edit_asesor')
            ->put('/asesor/edit_asesor', [
                'name' => 'Asesor Demo Baru',
                'email' => 'asesorbaru@example.com',
                'avatar' => UploadedFile::fake()->image('avatar.jpg', 300, 300),
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/asesor/profil');

        $user->refresh();

        $this->assertSame('Asesor Demo Baru', $user->name);
        $this->assertSame('asesorbaru@example.com', $user->email);
        $this->assertNotNull($user->profile_photo_path);
        $this->assertFileExists(public_path($user->profile_photo_path));
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}

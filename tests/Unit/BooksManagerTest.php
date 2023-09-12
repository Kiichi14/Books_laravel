<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Category;
use App\Models\Editor;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BooksManagerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    /* test all user connected can acces all book */
    public function test_all_connected_user_access_book(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/api/books');

        $response->assertOk();
    }

    /* test admin user can create new book */
    public function test_admin_can_create_book(): void
    {

        $admin = User::factory()
            ->admin()
            ->create();

        $category = Category::factory()->create();
        $author = Author::factory()->create();
        $editor = Editor::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->postJson(route('books.store'), [
                    'resume' => 'test resume',
                    'title' => 'test title',
                    'category_id' => $category->id,
                    'author_id' => $author->id,
                    'editor_id' => $editor->id
        ])->assertOk();

    }

    public function test_moderator_cannot_create_book(): void
    {

        $moderator = User::factory()->create();
        $category = Category::factory()->create();
        $author = Author::factory()->create();
        $editor = Editor::factory()->create();

        $response = $this
            ->actingAs($moderator)
            ->postJson(route('books.store'), [
                    'resume' => 'test resume',
                    'title' => 'test title',
                    'category_id' => $category->id,
                    'author_id' => $author->id,
                    'editor_id' => $editor->id
        ])->assertForbidden();

    }

}

<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Content;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_regular_user_can_upload_profile_image()
    {

        $user1 = factory(App\User::class)->create();

        $this->actingAs($user1)
            ->visit("user/$user1->id/edit")
            ->attach(storage_path() . '/tests/test.jpg', 'file')
            ->press('Submit')
            ->seePageIs("user/$user1->id/edit");
        
        $filename = $this->getImageFilenameByUserId($user1->id);

        foreach(['original', 'small_square', 'xsmall_square'] as $preset) {
            
            $filepath = config("imagepresets.$preset")['path'] . $filename;

            $this->assertTrue(file_exists($filepath));

            unlink($filepath);

        }

    }

    public function getImageFilenameByUserId($id) {

        return User::whereId($id)->first()->image;
        
    }
}
<?php

use App\Signup;
use App\Group;
use App\Field;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SignupsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function test_it_loads_test_from_url()
    {
        $signup = factory(Signup::class)->create();
        $group = factory(Group::class)->make();
        $field = factory(Field::class)->make();
        $signup->groups()->save($group);
        $group->fields()->save($field);
        
        $this->visit('/' . $signup->slug)
             ->see($signup->name);

    }
}

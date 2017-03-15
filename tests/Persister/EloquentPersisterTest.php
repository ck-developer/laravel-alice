<?php

namespace Ck\Laravel\Alice\Test\Persister;

use Ck\Laravel\Alice\Persister\EloquentPersister;
use Ck\Laravel\Alice\Test\Model\User;
use Ck\Laravel\Alice\Test\TestCase;

class EloquentPersisterTest extends TestCase
{
    /**
     * @var EloquentPersister
     */
    private $persister;

    public function setUp()
    {
        parent::setUp();

        $this->persister = $this->app->make('alice.eloquent_persister');
    }

    public function testPersist()
    {
        $users = array();

        for ($i = 1; $i <= 10;$i++) {
            $user = new User();
            $user->name = 'test ' . $i;
            $user->email = 'test'.$i.'@test.com';
            array_push($users, $user);
        }

        $this->persister->persist($users);
    }

    public function testFind()
    {
        $user = User::forceCreate([
            'name' => 'test',
            'email' => 'test@test.com'
        ]);

        $user = $this->persister->find(User::class, $user->id);
        
        $this->assertInstanceOf(User::class, $user);
    }
}

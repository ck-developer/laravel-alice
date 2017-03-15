<?php

namespace Ck\Laravel\Alice\Test\Loader;

use Ck\Laravel\Alice\Test\TestCase;
use Nelmio\Alice\Fixtures;

class LoaderTest extends TestCase
{
    /**
     * @var Fixtures
     */
    private $loader;

    public function setUp()
    {
        parent::setUp();

        $this->loader = $this->app->make('alice.loader');
    }

    public function testLoad()
    {
        $this->loader->loadFiles(array(__DIR__.'/../../database/fixtures/users.php'));
    }
}

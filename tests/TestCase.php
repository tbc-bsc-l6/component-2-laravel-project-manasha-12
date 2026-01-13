<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Force fresh migrations for each test
        $this->artisan('migrate:fresh');
        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });
    }
}
<?php

namespace Winter\Location\Tests\Unit;

use System\Classes\PluginBase;
use System\Tests\Bootstrap\PluginTestCase;
use Winter\Location\Plugin;

class LocationPluginTest extends PluginTestCase
{
    protected PluginBase $plugin;

    public function setUp(): void
    {
        $this->plugin = new Plugin($this->createApplication());
    }

    public function testPluginDetails()
    {
        $details = $this->plugin->pluginDetails();

        $this->assertIsArray($details);
        $this->assertArrayHasKey('name', $details);
        $this->assertArrayHasKey('description', $details);
        $this->assertArrayHasKey('icon', $details);
        $this->assertArrayHasKey('author', $details);

        $this->assertEquals('Winter CMS', $details['author']);
    }

    public function testRegisterSettings()
    {
        $settings = $this->plugin->registerSettings();

        $this->assertIsArray($settings);
    }

    public function testRegisterPermissions()
    {
        $permissions = $this->plugin->registerPermissions();

        $this->assertIsArray($permissions);
    }
}

<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DemographicAcceptanceTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->demographic = factory(App\Models\Demographic::class)->make([
            'id' => '1',
		'first_name' => 'laravel',
		'middle_name' => 'laravel',
		'last_name' => 'laravel',
		'email' => 'laravel',
		'phone' => 'laravel',
		'address' => 'laravel',
		'twitter' => 'laravel',
		'ward' => '1',
		'group' => 'laravel',
		'student' => '1',
		'notes' => 'laravel',

        ]);
        $this->demographicEdited = factory(App\Models\Demographic::class)->make([
            'id' => '1',
		'first_name' => 'laravel',
		'middle_name' => 'laravel',
		'last_name' => 'laravel',
		'email' => 'laravel',
		'phone' => 'laravel',
		'address' => 'laravel',
		'twitter' => 'laravel',
		'ward' => '1',
		'group' => 'laravel',
		'student' => '1',
		'notes' => 'laravel',

        ]);
        $user = factory(App\Models\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'demographics');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('demographics');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'demographics/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'demographics', $this->demographic->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('demographics/'.$this->demographic->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'demographics', $this->demographic->toArray());

        $response = $this->actor->call('GET', '/demographics/'.$this->demographic->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('demographic');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'demographics', $this->demographic->toArray());
        $response = $this->actor->call('PATCH', 'demographics/1', $this->demographicEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('demographics', $this->demographicEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'demographics', $this->demographic->toArray());

        $response = $this->call('DELETE', 'demographics/'.$this->demographic->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('demographics');
    }

}

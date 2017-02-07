<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DonationAcceptanceTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->donation = factory(App\Models\Donation::class)->make([
            'id' => '1',
		'amount' => '1.1',
		'contribution_timestamp' => '2017-02-07',
		'demographic_id' => '1',

        ]);
        $this->donationEdited = factory(App\Models\Donation::class)->make([
            'id' => '1',
		'amount' => '1.1',
		'contribution_timestamp' => '2017-02-07',
		'demographic_id' => '1',

        ]);
        $user = factory(App\Models\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'donations');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('donations');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'donations/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'donations', $this->donation->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('donations/'.$this->donation->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'donations', $this->donation->toArray());

        $response = $this->actor->call('GET', '/donations/'.$this->donation->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('donation');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'donations', $this->donation->toArray());
        $response = $this->actor->call('PATCH', 'donations/1', $this->donationEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('donations', $this->donationEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'donations', $this->donation->toArray());

        $response = $this->call('DELETE', 'donations/'.$this->donation->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('donations');
    }

}

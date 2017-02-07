<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DonationAcceptanceApiTest extends TestCase
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
        $response = $this->actor->call('GET', 'api/v1/donations');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/donations', $this->donation->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/donations', $this->donation->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/donations/1', $this->donationEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('donations', $this->donationEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/donations', $this->donation->toArray());
        $response = $this->call('DELETE', 'api/v1/donations/'.$this->donation->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'donation was deleted']);
    }

}

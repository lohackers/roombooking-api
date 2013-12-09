<?php

class BookingTest extends TestCase {

	public function testGetBookingsJSON()
	{
		$crawler = $this->client->request('GET', '/bookings', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
		$response = $this->client->getResponse();

		$this->assertResponseOk();
		$this->assertTrue($response->headers->get('content-type') == 'application/json');
	}

	public function testGetBookingsHTML()
	{
		$crawler = $this->client->request('GET', '/bookings');
		$response = $this->client->getResponse();

		$this->assertResponseOk();
		$this->assertTrue($response->headers->get('content-type') == 'text/html; charset=UTF-8');
	}

	public function testGetBookingsUnacceptable()
	{
		$crawler = $this->client->request('GET', '/bookings', array(), array(), array('HTTP_ACCEPT' => 'application/xml'));
		$response = $this->client->getResponse();

		$this->assertResponseStatus(406);
	}

}

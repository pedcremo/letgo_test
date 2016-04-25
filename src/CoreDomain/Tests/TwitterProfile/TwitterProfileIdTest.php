<?php
namespace CoreDomain\Tests\TwitterProfile;

use CoreDomain\TwitterProfile\TwitterProfileId;

class TwitterProfileIdTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $twitterProfileId = new TwitterProfileId("nicklaus_");

        // assert that your id is what is expected from constructor
        $this->assertEquals("nicklaus_", $twitterProfileId->getValue());

        
    }
}

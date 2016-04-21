<?php
namespace CoreDomain\Tests\TwitterProfile;

use CoreDomain\TwitterProfile\TwitterProfile;
use CoreDomain\TwitterProfile\TwitterProfileId;

class TwitterProfileTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $twitterProfile = new TwitterProfile(new TwitterProfileId("nicklaus_"));
        $result = $twitterProfile->getId();

        // assert that your calculator added the numbers correctly!
        $this->assertEquals("nicklaus_", $result->getValue());
    }
}

<?php
namespace CoreDomain\Tests\TwitterProfile;

use CoreDomain\TwitterProfile\TwitterProfile;
use CoreDomain\TwitterProfile\TwitterProfileId;

class TwitterProfileTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $twitterProfile = new TwitterProfile(new TwitterProfileId("nicklaus_"));
        $tpId = $twitterProfile->getId();

        // assert that your id is what is expected from constructor
        $this->assertEquals("nicklaus_", $tpId->getValue());

        $twitterProfile->setLastTweets("{test}");
        // assert check tweets setted are the expected ones
        $this->assertEquals("{test}",$twitterProfile->getLastTweets());

        $time_stamp1 = $twitterProfile->getLastTweetsTimeStamp();
        sleep(1); //Delay 1 second
        $twitterProfile->setLastTweets("{test1}");

        // not assert equal check between two setLastTweets TimeStamp should change
        $this->assertNotEquals($time_stamp1,$twitterProfile->getLastTweetsTimeStamp());


    }
}

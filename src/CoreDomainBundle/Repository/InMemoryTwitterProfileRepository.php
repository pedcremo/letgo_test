<?php

namespace CoreDomainBundle\Repository;

use CoreDomain\TwitterProfile\TwitterProfile;
use CoreDomain\TwitterProfile\TwitterProfileId;
use CoreDomain\TwitterProfile\TwitterProfileRepository;
use Endroid\Twitter\Twitter;

class InMemoryTwitterProfileRepository implements TwitterProfileRepository
{
    private $twitter_profiles;

    public function __construct()
    {
        $this->twitter_profiles[] = new TwitterProfile(
            new TwitterProfileId('nicklaus_')
        );

    }

    public function find(TwitterProfileId $twitterProfileId)
    {
        return $this->twitter_profiles[$twitterProfileId->getValue()];
    }

    public function findAll()
    {
        return $this->twitter_profiles;
    }

    public function add(TwitterProfile $twitterProfile)
    {
        if ( is_null($this->find($twitterProfile->getId())) ){
            $this->twitter_profiles[$twitterProfile->getId()]=$twitterProfile;
        }
    }

    public function remove(TwitterProfile $twitterProfile)
    {
            $this->twitter_profiles[$twitterProfile->getId()]=null;

    }

    public function getLastTweets(TwitterProfile $twitterProfile){
        global $kernel;

        if ('AppCache' == get_class($kernel)) {
            $kernel = $kernel->getKernel();
        }
        $twitter = $kernel->getContainer()->get('endroid.twitter');

        // Retrieve the user's timeline
        $tweets = $twitter->getTimeline(array(
            'screen_name' => $twitterProfile->getId()->getValue(),'count' => 10
        ));

        $twitterProfile->last_tweets = $tweets;
        return $twitterProfile;
    }
}

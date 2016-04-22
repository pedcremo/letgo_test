<?php

namespace CoreDomainBundle\Repository;

use CoreDomain\TwitterProfile\TwitterProfile;
use CoreDomain\TwitterProfile\TwitterProfileId;
use CoreDomain\TwitterProfile\TwitterProfileRepository;
use Endroid\Twitter\Twitter;

class InMemoryTwitterProfileRepository implements TwitterProfileRepository
{
    private $twitter_profiles; //Array of all queried TwitterProfiles objects
    private $twitter_service; //Actual service used to query real twitter dev API

    public function __construct()
    {
        /*$this->twitter_profiles[] = new TwitterProfile(
            new TwitterProfileId('nicklaus_')
        );*/
        global $kernel;

        if ('AppCache' == get_class($kernel)) {
            $kernel = $kernel->getKernel();
        }
        $this->twitter_service = $kernel->getContainer()->get('endroid.twitter');


    }

    public function find(TwitterProfileId $twitterProfileId)
    {
        if ($this->twitter_profiles[$twitterProfileId->getValue()] == null){
            $this->add($twitterProfileId);
        }
        return $this->twitter_profiles[$twitterProfileId->getValue()];
    }

    public function findAll()
    {
        return $this->twitter_profiles;
    }

    public function add(TwitterProfileId $twitterProfileId)
    {

        $this->twitter_profiles[$twitterProfileId->getValue()]=new TwitterProfile($twitterProfileId);

    }

    public function remove(TwitterProfileId $twitterProfileId)
    {
            $this->twitter_profiles[$twitterProfileId->getValue()]=null;

    }

    public function getLastTweets(TwitterProfileId $twitterProfileId){

        $twitter_profile =$this->find($twitterProfileId);

        /* Retrieve the user's timeline from twitter API  if seconds beetween callings are greater than 10 seconds
        otherwise we get tweets from memory because have been cached previosly
        */
        $seconds_beetween_calls=time() - $twitter_profile->getLastTweetsTimeStamp();

        if ($seconds_beetween_calls >10){
            $tweets = $this->twitter_service->getTimeline(array(
                'screen_name' => $twitterProfileId->getValue(),'count' => 10
            ));
            $twitter_profile->setLastTweets($tweets);
        }else{
            $tweets = $twitter_profile->getLastTweets();
        }

        return $tweets;

        //return $twitterProfile;
    }
}

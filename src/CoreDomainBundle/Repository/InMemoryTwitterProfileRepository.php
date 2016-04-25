<?php

namespace CoreDomainBundle\Repository;

use CoreDomain\TwitterProfile\TwitterProfile;
use CoreDomain\TwitterProfile\TwitterProfileId;
use CoreDomain\TwitterProfile\TwitterProfileRepository;
use Endroid\Twitter\Twitter;

class InMemoryTwitterProfileRepository implements TwitterProfileRepository
{

    private $twitter_service; //Actual service used to query real twitter dev API
    private $redis_service;

    public function __construct($twitter_service,$redis_service)
    {
        /*global $kernel;

        if ('AppCache' == get_class($kernel)) {
            $kernel = $kernel->getKernel();
        }*/
        //$this->twitter_service = $kernel->getContainer()->get('endroid.twitter');
        $this->twitter_service = $twitter_service;
        //$this->redis_service = $kernel->getContainer()->get('snc_redis.default');
        $this->redis_service = $redis_service;
    }

    public function find(TwitterProfileId $twitterProfileId)
    {
        if ($this->redis_service->get($twitterProfileId->getValue()) == null){
            $this->add($twitterProfileId);
        }
        return unserialize($this->redis_service->get($twitterProfileId->getValue()));
    }

    //Not implemented yet
    public function findAll()
    {
        return null;
    }

    public function add(TwitterProfileId $twitterProfileId)
    {
        $this->redis_service->set($twitterProfileId->getValue(),serialize(new TwitterProfile($twitterProfileId)));

    }

    public function remove(TwitterProfileId $twitterProfileId)
    {
        $this->redis_service->set($twitterProfileId->getValue(),null);
    }

    public function getLastTweets(TwitterProfileId $twitterProfileId){

        $twitter_profile =$this->find($twitterProfileId);

        /* Retrieve the user's timeline from twitter API  if seconds among callings are greater than 10 seconds
        otherwise we get tweets from memory because have been cached previosly in a redis server
        */
        $seconds_beetween_calls=time() - $twitter_profile->getLastTweetsTimeStamp();

        if ($seconds_beetween_calls >10){
            $tweets = $this->twitter_service->getTimeline(array(
                'screen_name' => $twitterProfileId->getValue(),'count' => 10
            ));
            $twitter_profile->setLastTweets($tweets);
            //Update twitter_profile in redis memcache
            $this->redis_service->set($twitterProfileId->getValue(),serialize($twitter_profile));
        }else{
            $tweets = $twitter_profile->getLastTweets();
        }

        return $tweets;
    }
}

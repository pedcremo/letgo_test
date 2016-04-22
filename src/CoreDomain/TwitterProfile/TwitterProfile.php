<?php

namespace CoreDomain\TwitterProfile;

class TwitterProfile
{
    private $id;
    private $last_tweets;
    private $last_tweets_timestamp;

    public function __construct(TwitterProfileId $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLastTweets($last_tweets){
            $this->last_tweets = $last_tweets;
            $this->last_tweets_timestamp = time();
    }
    public function getLastTweetsTimeStamp(){
        return $this->last_tweets_timestamp;
    }

    public function getLastTweets(){
        return $this->last_tweets;
    }

}

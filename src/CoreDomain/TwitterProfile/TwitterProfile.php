<?php

namespace CoreDomain\TwitterProfile;

class TwitterProfile
{
    private $id;
    public $last_tweets;

    public function __construct(TwitterProfileId $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLastTweets(){
        return $this->last_tweets;
    }

}

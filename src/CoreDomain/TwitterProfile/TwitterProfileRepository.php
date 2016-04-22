<?php

namespace CoreDomain\TwitterProfile;

interface TwitterProfileRepository
{
    public function find(TwitterProfileId $twitterProfileId);

    public function findAll();

    public function add(TwitterProfileId $twitterProfileId);

    public function remove(TwitterProfileId $twitterProfileId);

    public function getLastTweets(TwitterProfileId $twitterProfileId);
}

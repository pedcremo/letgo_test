<?php

namespace CoreDomain\TwitterProfile;

interface TwitterProfileRepository
{
    public function find(TwitterProfileId $twitterProfileId);

    public function findAll();

    public function add(TwitterProfile $twitterProfile);

    public function remove(TwitterProfile $twitterProfile);

    public function getLastTweets(TwitterProfile $twitterProfile);
}

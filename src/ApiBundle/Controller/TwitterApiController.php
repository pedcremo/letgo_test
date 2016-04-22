<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use CoreDomain\TwitterProfile\TwitterProfile;
use CoreDomain\TwitterProfile\TwitterProfileId;
use CoreDomain\TwitterProfile\TwitterProfileRepository;

class TwitterApiController extends Controller
{

    public function getLastTweetsAction($userName)
    {

        $tweets = $this->get('twitterprofile_repository')->getLastTweets(new TwitterProfileId($userName));

        $response = new JsonResponse($tweets);
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);

        return $response;
    }
}

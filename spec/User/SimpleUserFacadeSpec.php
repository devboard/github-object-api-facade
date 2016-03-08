<?php

namespace spec\DevBoardLib\GithubObjectApiFacade\User;

use DevBoardLib\GithubApiFacade\User\UserFacade;
use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleUserFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\User\SimpleUserFacade');
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\User\UserFacade');
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\User\ObjectUserFacade');
    }

    public function let(
        UserFacade $userFacade,
        GithubRepoConverter $githubRepoConverter
    ) {
        $this->beConstructedWith(
            $userFacade,
            $githubRepoConverter
        );
    }
}

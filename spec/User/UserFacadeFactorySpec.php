<?php

declare (strict_types = 1);
namespace spec\DevBoardLib\GithubObjectApiFacade\User;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\User\UserFacade;
use DevBoardLib\GithubApiFacade\User\UserFacadeFactory as WrappedUserFacadeFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserFacadeFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\User\UserFacadeFactory');
    }

    public function let(WrappedUserFacadeFactory $wrappedUserFacadeFactory)
    {
        $this->beConstructedWith($wrappedUserFacadeFactory);
    }

    public function it_will_create_repo_facade(
        $wrappedUserFacadeFactory,
        GithubAccessToken $user,
        UserFacade $userFacade
    ) {
        $wrappedUserFacadeFactory->create($user)->willReturn($userFacade);

        $this->create($user)
            ->shouldReturnAnInstanceOf('DevBoardLib\GithubObjectApiFacade\User\SimpleUserFacade');
    }
}

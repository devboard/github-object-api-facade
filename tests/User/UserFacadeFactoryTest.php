<?php

declare (strict_types = 1);
namespace tests\DevBoardLib\GithubObjectApiFacade\User;

use DevBoardLib\GithubObjectApiFacade\User\UserFacadeFactory;
use Mockery as m;

/**
 * Class UserFacadeFactoryTest.
 */
class UserFacadeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $user = $this->provideTestUser();

        $wrappedFacade = m::mock('DevBoardLib\GithubApiFacade\User\UserFacade');

        $wrappedFactory = m::mock('DevBoardLib\GithubApiFacade\User\UserFacadeFactory');
        $wrappedFactory->shouldReceive('create')->with($user)->andReturn($wrappedFacade);

        $target = new UserFacadeFactory($wrappedFactory);

        $result = $target->create($user);

        self::assertInstanceOf('DevBoardLib\GithubObjectApiFacade\User\SimpleUserFacade', $result);
    }

    /**
     * @return m\MockInterface
     */
    private function provideTestUser()
    {
        return m::mock('DevBoardLib\GithubApiFacade\Auth\GithubAccessToken');
    }
}

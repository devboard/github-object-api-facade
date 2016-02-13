<?php
namespace tests\DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubObjectApiFacade\Repo\RepoFacadeFactory;
use Mockery as m;

class RepoFacadeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $repo = $this->provideTestRepo();
        $user = $this->provideTestUser();

        $wrappedFacade = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');

        $wrappedFactory = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacadeFactory');
        $wrappedFactory->shouldReceive('create')->with($repo, $user)->andReturn($wrappedFacade);

        $target = new RepoFacadeFactory($wrappedFactory);

        $result = $target->create($repo, $user);

        self::assertInstanceOf('DevBoardLib\GithubObjectApiFacade\Repo\SimpleRepoFacade', $result);
    }

    /**
     * @return m\MockInterface
     */
    private function provideTestRepo()
    {
        return m::mock('DevBoardLib\GithubCore\Repo\GithubRepo');
    }

    /**
     * @return m\MockInterface
     */
    private function provideTestUser()
    {
        return m::mock('DevBoardLib\GithubApiFacade\Auth\GithubAccessToken');
    }
}

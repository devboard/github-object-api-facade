<?php

namespace tests\DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\SimpleRepoFacade;
use DevBoardLib\GithubObjectApiFacade\User\SimpleUserFacade;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\JsonSampleDataProvider;

/**
 * Class SimpleRepoFacadeTest.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SimpleUserFacadeTest extends \PHPUnit_Framework_TestCase
{
    public function testfetchAllAccessibleRepos()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\User\UserFacade');
        $wrapped->shouldReceive('fetchAllAccessibleRepos')
            ->andReturn($this->getDataProvider()->getMyRepositoriesAll());

        $target = $this->createFacade($wrapped);

        foreach ($target->fetchAllAccessibleRepos() as $repo) {
            self::assertInstanceOf(
                'DevBoardLib\GithubCore\Repo\GithubRepoSource',
                $repo
            );
        }
    }

    /**
     * @param $wrapped
     *
     * @return SimpleRepoFacade
     */
    protected function createFacade($wrapped)
    {
        return new SimpleUserFacade(
            $wrapped,
            new GithubRepoConverter()
        );
    }

    /**
     * @return JsonSampleDataProvider
     */
    protected function getDataProvider()
    {
        return new JsonSampleDataProvider();
    }

    /**
     * @return m\MockInterface
     */
    protected function provideTestRepo()
    {
        $repo   = m::mock('DevBoardLib\GithubCore\Repo\GithubRepo');
        $repoId = m::mock('DevBoardLib\GithubCore\Repo\GithubRepoId');

        $repo->shouldReceive('getId')->andReturn($repoId);

        return $repo;
    }
}

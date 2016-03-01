<?php

namespace tests\DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter;

use DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter\GithubCommitConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\SampleDataProvider;

/**
 * Class GithubCommitConverterTest.
 */
class GithubCommitConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider  provideConversionData
     *
     * @param $repoData
     */
    public function testConvert($repoData)
    {
        $repo = $this->provideTestRepo();

        $target = new GithubCommitConverter($repo);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Commit\GithubCommitSource',
            $target->convert($repoData)
        );
    }

    /**
     * @return array
     */
    public function provideConversionData()
    {
        return [
            [$this->getDataProvider()->getCommit()],
        ];
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

    /**
     * @return SampleDataProvider
     */
    protected function getDataProvider()
    {
        return new SampleDataProvider();
    }
}

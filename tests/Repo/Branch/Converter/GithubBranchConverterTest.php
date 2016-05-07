<?php

namespace tests\DevBoardLib\GithubObjectApiFacade\Repo\Branch\Converter;

use DevBoardLib\GithubObjectApiFacade\Repo\Branch\Converter\GithubBranchConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\SampleDataProvider;

/**
 * Class GithubBranchConverterTest.
 */
class GithubBranchConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider  provideConversionData
     *
     * @param $repoData
     */
    public function testConvert($repoData)
    {
        $repo = $this->provideTestRepo();

        $target = new GithubBranchConverter($repo);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Branch\GithubBranchSource',
            $target->convert($repoData)
        );
    }

    /**
     * @return array
     */
    public function provideConversionData()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllBranches() as $item) {
            $testData[] = [$item];
        }

        return $testData;
    }

    /**
     * @return m\MockInterface
     */
    protected function provideTestRepo()
    {
        $repo   = m::mock('DevBoardLib\GithubCore\Repo\GithubRepo');
        $repoId = m::mock('DevBoardLib\GithubCore\Repo\GithubRepoId');

        $repo->shouldReceive('getId')->andReturn($repoId);
        $repoId->shouldReceive('getId')->andReturn(123);

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

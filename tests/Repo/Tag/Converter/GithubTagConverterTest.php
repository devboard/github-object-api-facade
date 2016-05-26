<?php

namespace tests\DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter\GithubTagConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\JsonSampleDataProvider;

/**
 * Class GithubTagConverterTest.
 */
class GithubTagConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider  provideConversionData
     *
     * @param $repoData
     */
    public function testConvert($repoData)
    {
        $repo = $this->provideTestRepo();

        $target = new GithubTagConverter($repo);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Tag\GithubTagSource',
            $target->convert($repoData)
        );
    }

    /**
     * @return array
     */
    public function provideConversionData()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllTagNames() as $item) {
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
        $repoId = new GithubRepoId(123);

        $repo->shouldReceive('getId')->andReturn($repoId);

        return $repo;
    }

    /**
     * @return JsonSampleDataProvider
     */
    protected function getDataProvider()
    {
        return new JsonSampleDataProvider();
    }
}

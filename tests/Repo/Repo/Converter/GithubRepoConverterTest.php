<?php

namespace tests\DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter;

use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\SampleDataProvider;

/**
 * Class GithubRepoConverterTest.
 */
class GithubRepoConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider  provideConversionData
     *
     * @param $repoData
     */
    public function testConvert($repoData)
    {
        $repo = $this->provideTestRepo();

        $target = new GithubRepoConverter($repo);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Repo\GithubRepoSource',
            $target->convert($repoData)
        );
    }

    /**
     * @return array
     */
    public function provideConversionData()
    {
        return [
            $this->getDataProvider()->getRepoDetails(),
        ];
    }

    /**
     * @return m\MockInterface
     */
    protected function provideTestRepo()
    {
        return m::mock('DevBoardLib\GithubCore\Repo\GithubRepo');
    }

    /**
     * @return SampleDataProvider
     */
    protected function getDataProvider()
    {
        return new SampleDataProvider();
    }
}

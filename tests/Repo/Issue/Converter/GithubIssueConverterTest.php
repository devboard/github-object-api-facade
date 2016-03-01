<?php

namespace tests\DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter;

use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\SampleDataProvider;

/**
 * Class GithubIssueConverterTest.
 */
class GithubIssueConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider  provideConversionData
     *
     * @param array $issueData
     */
    public function testConvert(array $issueData)
    {
        $repo = $this->provideTestRepo();

        $target = new GithubIssueConverter($repo);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Issue\GithubIssueSource',
            $target->convert($issueData)
        );
    }

    /**
     * @return array
     */
    public function provideConversionData()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllIssues() as $item) {
            $testData[] = [$item];
        }

        return $testData;
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

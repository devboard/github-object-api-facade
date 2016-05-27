<?php

declare (strict_types = 1);
namespace tests\DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter;

use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\JsonSampleDataProvider;

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
     * @return JsonSampleDataProvider
     */
    protected function getDataProvider()
    {
        return new JsonSampleDataProvider();
    }
}

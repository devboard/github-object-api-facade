<?php
namespace tests\DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter;

use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\SampleDataProvider;

class GithubMilestoneConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider  provideConversionData
     *
     * @param array $milestoneData
     */
    public function testConvert(array $milestoneData)
    {
        $repo = $this->provideTestRepo();

        $target = new GithubMilestoneConverter($repo);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Milestone\GithubMilestoneSource',
            $target->convert($milestoneData)
        );
    }

    public function provideConversionData()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllMilestones() as $item) {
            $testData[] = [$item];
        }

        return $testData;
    }

    protected function provideTestRepo()
    {
        return m::mock('DevBoardLib\GithubCore\Repo\GithubRepo');
    }

    protected function getDataProvider()
    {
        return new SampleDataProvider();
    }
}

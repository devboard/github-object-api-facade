<?php

declare (strict_types = 1);
namespace tests\DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter\GithubCommitStatusConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\JsonSampleDataProvider;

/**
 * Class GithubCommitStatusConverterTest.
 */
class GithubCommitStatusConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider  provideConversionData
     *
     * @param $repoData
     */
    public function testConvert($repoData)
    {
        $repo = $this->provideTestRepo();

        $target = new GithubCommitStatusConverter($repo);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\CommitStatus\GithubCommitStatusSource',
            $target->convert($repoData)
        );
    }

    /**
     * @return array
     */
    public function provideConversionData()
    {
        $results = [];
        $data    = $this->getDataProvider()->getCommitStatus();

        foreach ($data['statuses'] as $status) {
            $results[] = [
                array_merge($status, ['sha' => $data['sha']]),
            ];
        }

        return $results;
    }

    /**
     * @dataProvider  provideConversionDataFromMultipleStatuses
     *
     * @param $repoData
     */
    public function testConvertFromMultipleStatuses($repoData)
    {
        $repo = $this->provideTestRepo();

        $target = new GithubCommitStatusConverter($repo);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\CommitStatus\GithubCommitStatusSource',
            $target->convert($repoData)
        );
    }

    /**
     * @return array
     */
    public function provideConversionDataFromMultipleStatuses()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getCommitStatuses() as $item) {
            $testData[] = [
                array_merge($item, ['sha' => '@todo']),
            ];
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

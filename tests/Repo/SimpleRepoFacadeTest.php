<?php
namespace tests\DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\SimpleRepoFacade;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\SampleDataProvider;

class SimpleRepoFacadeTest extends \PHPUnit_Framework_TestCase
{
    public function testFetchAllMilestones()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchAllMilestones')
            ->andReturn($this->getDataProvider()->getAllMilestones());

        $target = new SimpleRepoFacade(
            $wrapped,
            new GithubIssueConverter($this->provideTestRepo()),
            new GithubMilestoneConverter($this->provideTestRepo())
        );

        $milestones = $target->fetchAllMilestones();

        foreach ($milestones as $milestone) {
            self::assertInstanceOf(
                'DevBoardLib\GithubObjectApiFacade\Repo\Milestone\GithubMilestoneSource',
                $milestone
            );
        }
    }

    public function testFetchAllIssues()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');

        $wrapped->shouldReceive('fetchAllIssues')
            ->andReturn($this->getDataProvider()->getAllIssues());

        $target = new SimpleRepoFacade(
            $wrapped,
            new GithubIssueConverter($this->provideTestRepo()),
            new GithubMilestoneConverter($this->provideTestRepo())
        );

        $issues = $target->fetchAllIssues();

        foreach ($issues as $issue) {
            self::assertInstanceOf(
                'DevBoardLib\GithubObjectApiFacade\Repo\Issue\GithubIssueSource',
                $issue
            );
        }
    }

    protected function getDataProvider()
    {
        return new SampleDataProvider();
    }

    protected function provideTestRepo()
    {
        return m::mock('DevBoardLib\GithubCore\Repo\GithubRepo');
    }
}

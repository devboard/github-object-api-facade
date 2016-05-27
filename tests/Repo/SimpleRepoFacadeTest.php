<?php

declare (strict_types = 1);
namespace tests\DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubObjectApiFacade\Repo\Branch\Converter\GithubBranchConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter\GithubCommitConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter\GithubCommitStatusConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\PullRequest\Converter\GithubPullRequestConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\SimpleRepoFacade;
use DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter\GithubTagConverter;
use Mockery as m;
use tests\DevBoardLib\GithubObjectApiFacade\JsonSampleDataProvider;

/**
 * Class SimpleRepoFacadeTest.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SimpleRepoFacadeTest extends \PHPUnit_Framework_TestCase
{
    public function testFetchDetails()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchDetails')
            ->andReturn($this->getDataProvider()->getRepoDetails());

        $target = $this->createFacade($wrapped);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Repo\GithubRepoSource',
            $target->fetchDetails()
        );
    }

    public function testFetchBranch()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchBranch')
            ->with('master')
            ->andReturn($this->getDataProvider()->getBranch());

        $target = $this->createFacade($wrapped);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Branch\GithubBranchSource',
            $target->fetchBranch('master')
        );
    }

    public function testFetchAllBranches()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchAllBranches')
            ->andReturn($this->getDataProvider()->getAllBranches());

        $target   = $this->createFacade($wrapped);
        $branches = $target->fetchAllBranches();

        foreach ($branches as $branch) {
            self::assertInstanceOf(
                'DevBoardLib\GithubCore\Branch\GithubBranchSource',
                $branch
            );
        }
    }

    public function testFetchAllTags()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchAllTags')
            ->andReturn($this->getDataProvider()->getAllTagNames());

        $target   = $this->createFacade($wrapped);
        $branches = $target->fetchAllTags();

        foreach ($branches as $branch) {
            self::assertInstanceOf(
                'DevBoardLib\GithubCore\Tag\GithubTagSource',
                $branch
            );
        }
    }

    public function testFetchCommit()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchCommit')
            ->with('sha123')
            ->andReturn($this->getDataProvider()->getCommit());

        $target = $this->createFacade($wrapped);

        self::assertInstanceOf(
            'DevBoardLib\GithubCore\Commit\GithubCommitSource',
            $target->fetchCommit('sha123')
        );
    }

    /**
     */
    public function testFetchCommitStatus()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchCommitStatus')
            ->with('sha123')
            ->andReturn($this->getDataProvider()->getCommitStatus());

        $target = $this->createFacade($wrapped);

        foreach ($target->fetchCommitStatus('sha123') as $status) {
            self::assertInstanceOf(
                'DevBoardLib\GithubCore\CommitStatus\GithubCommitStatusSource',
                $status
            );
        }
    }

    public function testFetchCommitStatuses()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchCommitStatuses')
            ->with('sha123')
            ->andReturn($this->getDataProvider()->getCommitStatuses());

        $target = $this->createFacade($wrapped);

        foreach ($target->fetchCommitStatuses('sha123') as $status) {
            self::assertInstanceOf(
                'DevBoardLib\GithubCore\CommitStatus\GithubCommitStatusSource',
                $status
            );
        }
    }
    //
    //
    //
    //

    public function testFetchAllPullRequests()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchAllPullRequests')
            ->andReturn($this->getDataProvider()->getAllPullRequests());

        $target       = $this->createFacade($wrapped);
        $pullRequests = $target->fetchAllPullRequests();

        foreach ($pullRequests as $pullRequest) {
            self::assertInstanceOf(
                'DevBoardLib\GithubCore\PullRequest\GithubPullRequestSource',
                $pullRequest
            );
        }
    }

    public function testFetchAllMilestones()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $wrapped->shouldReceive('fetchAllMilestones')
            ->andReturn($this->getDataProvider()->getAllMilestones());

        $target = $this->createFacade($wrapped);

        $milestones = $target->fetchAllMilestones();

        foreach ($milestones as $milestone) {
            self::assertInstanceOf(
                'DevBoardLib\GithubCore\Milestone\GithubMilestoneSource',
                $milestone
            );
        }
    }

    public function testFetchAllIssues()
    {
        $wrapped = m::mock('DevBoardLib\GithubApiFacade\Repo\RepoFacade');

        $wrapped->shouldReceive('fetchAllIssues')
            ->andReturn($this->getDataProvider()->getAllIssues());

        $target = $this->createFacade($wrapped);

        $issues = $target->fetchAllIssues();

        foreach ($issues as $issue) {
            self::assertInstanceOf(
                'DevBoardLib\GithubCore\Issue\GithubIssueSource',
                $issue
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
        return new SimpleRepoFacade(
            $wrapped,
            new GithubRepoConverter($this->provideTestRepo()),
            new GithubBranchConverter($this->provideTestRepo()),
            new GithubTagConverter($this->provideTestRepo()),
            new GithubPullRequestConverter($this->provideTestRepo()),
            new GithubCommitConverter($this->provideTestRepo()),
            new GithubCommitStatusConverter($this->provideTestRepo()),
            new GithubIssueConverter($this->provideTestRepo()),
            new GithubMilestoneConverter($this->provideTestRepo())
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
        $repoId = new GithubRepoId(123);

        $repo->shouldReceive('getId')->andReturn($repoId);

        return $repo;
    }
}

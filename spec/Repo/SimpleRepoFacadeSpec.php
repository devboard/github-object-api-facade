<?php
namespace spec\DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Repo\RepoFacade;
use DevBoardLib\GithubObjectApiFacade\Repo\Branch\Converter\GithubBranchConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter\GithubCommitConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter\GithubCommitStatusConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\PullRequest\Converter\GithubPullRequestConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter\GithubTagConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleRepoFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\SimpleRepoFacade');
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\ObjectRepoFacade');
    }

    public function let(
        RepoFacade $repoFacade,
        GithubRepoConverter $githubRepoConverter,
        GithubBranchConverter $githubBranchConverter,
        GithubTagConverter $githubTagConverter,
        GithubPullRequestConverter $githubPullRequestConverter,
        GithubCommitConverter $githubCommitConverter,
        GithubCommitStatusConverter $githubCommitStatusConverter,
        GithubIssueConverter $githubIssueConverter,
        GithubMilestoneConverter $githubMilestoneConverter
    ) {
        $this->beConstructedWith(
            $repoFacade,
            $githubRepoConverter,
            $githubBranchConverter,
            $githubTagConverter,
            $githubPullRequestConverter,
            $githubCommitConverter,
            $githubCommitStatusConverter,
            $githubIssueConverter,
            $githubMilestoneConverter
        );
    }

    public function it_will_return_all_repo_milestones($repoFacade, $githubMilestoneConverter)
    {
        $repoFacade->fetchAllMilestones()->willReturn(['data']);

        $githubMilestoneConverter->convert('data')->willReturn('converted');

        $this->fetchAllMilestones()->shouldReturn(['converted']);
    }

    public function it_will_return_all_repo_issues($repoFacade, $githubIssueConverter)
    {
        $repoFacade->fetchAllIssues()->willReturn(['data']);
        $githubIssueConverter->convert('data')->willReturn('converted');

        $this->fetchAllIssues()->shouldReturn(['converted']);
    }
}

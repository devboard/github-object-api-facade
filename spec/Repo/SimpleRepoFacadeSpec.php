<?php
namespace spec\DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Repo\RepoFacade;
use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;
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
        GithubIssueConverter $githubIssueConverter,
        GithubMilestoneConverter $githubMilestoneConverter
    ) {
        $this->beConstructedWith($repoFacade, $githubIssueConverter, $githubMilestoneConverter);
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

<?php
namespace spec\DevBoardLib\GithubObjectApiFacade\Repo\PullRequest\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubPullRequestConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(
            'DevBoardLib\GithubObjectApiFacade\Repo\PullRequest\Converter\GithubPullRequestConverter'
        );
    }

    public function let(GithubRepo $githubRepo, GithubRepoId $repoId)
    {
        $githubRepo->getId()->willReturn($repoId);
        $this->beConstructedWith($githubRepo);
    }
}

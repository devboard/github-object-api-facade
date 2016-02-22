<?php
namespace spec\DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubTagConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter\GithubTagConverter');
    }

    public function let(GithubRepo $githubRepo, GithubRepoId $repoId)
    {
        $githubRepo->getId()->willReturn($repoId);
        $this->beConstructedWith($githubRepo);
    }
}

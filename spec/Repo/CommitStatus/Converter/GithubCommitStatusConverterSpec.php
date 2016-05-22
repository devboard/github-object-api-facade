<?php

namespace spec\DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tests\DevBoardLib\GithubObjectApiFacade\JsonSampleDataProvider;

class GithubCommitStatusConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(
            'DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter\GithubCommitStatusConverter'
        );
    }

    public function let(GithubRepo $githubRepo, GithubRepoId $repoId)
    {
        $githubRepo->getId()->willReturn($repoId);
        $this->beConstructedWith($githubRepo);
    }

    public function provideCommitStatuses()
    {
        return [
            [$this->getDataProvider()->getCommitStatus()],
        ];
    }

    protected function getDataProvider()
    {
        return new JsonSampleDataProvider();
    }
}

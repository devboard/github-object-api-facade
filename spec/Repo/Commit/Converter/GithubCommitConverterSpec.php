<?php

namespace spec\DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tests\DevBoardLib\GithubObjectApiFacade\JsonSampleDataProvider;

class GithubCommitConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter\GithubCommitConverter');
    }

    public function let(GithubRepo $githubRepo, GithubRepoId $repoId)
    {
        $githubRepo->getId()->willReturn($repoId);
        $this->beConstructedWith($githubRepo);
    }

    /**
     * @dataProvider provideCommitDetails
     */
    public function it_returns_github_commit_source_as_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->shouldReturnAnInstanceOf('DevBoardLib\GithubCore\Commit\GithubCommitSource');
    }

    public function provideCommitDetails()
    {
        return [
            [$this->getDataProvider()->getCommit()],
        ];
    }

    protected function getDataProvider()
    {
        return new JsonSampleDataProvider();
    }
}

<?php
namespace spec\DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\Repo\RepoFacade;
use DevBoardLib\GithubApiFacade\Repo\RepoFacadeFactory as WrappedRepoFacadeFactory;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepoFacadeFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\RepoFacadeFactory');
    }

    public function let(WrappedRepoFacadeFactory $wrappedRepoFacadeFactory)
    {
        $this->beConstructedWith($wrappedRepoFacadeFactory);
    }

    public function it_will_create_repo_facade(
        $wrappedRepoFacadeFactory,
        GithubRepo $githubRepo,
        GithubAccessToken $user,
        RepoFacade $repoFacade
    ) {
        $wrappedRepoFacadeFactory->create($githubRepo, $user)->willReturn($repoFacade);

        $this->create($githubRepo, $user)
            ->shouldReturnAnInstanceOf('DevBoardLib\GithubObjectApiFacade\Repo\SimpleRepoFacade');
    }
}

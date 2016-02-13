<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\Repo\RepoFacadeFactory as WrappedRepoFacadeFactory;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;

class RepoFacadeFactory
{
    private $wrappedRepoFacadeFactory;

    /**
     * RepoFacadeFactory constructor.
     *
     * @param $wrappedRepoFacadeFactory
     */
    public function __construct(WrappedRepoFacadeFactory $wrappedRepoFacadeFactory)
    {
        $this->wrappedRepoFacadeFactory = $wrappedRepoFacadeFactory;
    }

    public function create(GithubRepo $githubRepo, GithubAccessToken $user)
    {
        return new SimpleRepoFacade(
            $this->wrappedRepoFacadeFactory->create($githubRepo, $user),
            new GithubIssueConverter($githubRepo),
            new GithubMilestoneConverter($githubRepo)
        );
    }
}

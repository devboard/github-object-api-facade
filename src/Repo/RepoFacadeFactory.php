<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\Repo\RepoFacadeFactory as WrappedRepoFacadeFactory;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\Repo\Branch\Converter\GithubBranchConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter\GithubCommitConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter\GithubCommitStatusConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\PullRequest\Converter\GithubPullRequestConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter\GithubTagConverter;

/**
 * Class RepoFacadeFactory.
 */
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

    /**
     * @param GithubRepo        $githubRepo
     * @param GithubAccessToken $user
     *
     * @return SimpleRepoFacade
     */
    public function create(GithubRepo $githubRepo, GithubAccessToken $user)
    {
        return new SimpleRepoFacade(
            $this->wrappedRepoFacadeFactory->create($githubRepo, $user),
            new GithubRepoConverter(),
            new GithubBranchConverter($githubRepo),
            new GithubTagConverter($githubRepo),
            new GithubPullRequestConverter($githubRepo),
            new GithubCommitConverter($githubRepo),
            new GithubCommitStatusConverter($githubRepo),
            new GithubIssueConverter($githubRepo),
            new GithubMilestoneConverter($githubRepo)
        );
    }
}

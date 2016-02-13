<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Repo\RepoFacade;
use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;

class SimpleRepoFacade implements ObjectRepoFacade
{
    private $repoFacade;
    private $githubIssueConverter;
    private $githubMilestoneConverter;

    /**
     * SimpleRepoFacade constructor.
     *
     * @param $repoFacade
     */
    public function __construct(
        RepoFacade $repoFacade,
        GithubIssueConverter $githubIssueConverter,
        GithubMilestoneConverter $githubMilestoneConverter
    ) {
        $this->repoFacade               = $repoFacade;
        $this->githubIssueConverter     = $githubIssueConverter;
        $this->githubMilestoneConverter = $githubMilestoneConverter;
    }

    public function fetchAllMilestones()
    {
        $results    = [];
        $rawResults = $this->repoFacade->fetchAllMilestones();

        foreach ($rawResults as $rawResult) {
            $results[] = $this->githubMilestoneConverter->convert($rawResult);
        }

        return $results;
    }

    public function fetchAllIssues()
    {
        $results    = [];
        $rawResults = $this->repoFacade->fetchAllIssues();

        foreach ($rawResults as $rawResult) {
            $results[] = $this->githubIssueConverter->convert($rawResult);
        }

        return $results;
    }
}

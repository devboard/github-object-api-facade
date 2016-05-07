<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Repo\RepoFacade;
use DevBoardLib\GithubObjectApiFacade\Repo\Branch\Converter\GithubBranchConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter\GithubCommitConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter\GithubCommitStatusConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\PullRequest\Converter\GithubPullRequestConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;
use DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter\GithubTagConverter;

/**
 * Class SimpleRepoFacade.
 */
class SimpleRepoFacade implements ObjectRepoFacade
{
    /**
     * @var RepoFacade
     */
    private $repoFacade;

    /**
     * @var GithubRepoConverter
     */
    private $githubRepoConverter;
    /**
     * @var GithubBranchConverter
     */
    private $githubBranchConverter;
    /**
     * @var GithubTagConverter
     */
    private $githubTagConverter;
    /**
     * @var GithubPullRequestConverter
     */
    private $githubPullRequestConverter;
    /**
     * @var GithubCommitConverter
     */
    private $githubCommitConverter;
    /**
     * @var GithubCommitStatusConverter
     */
    private $githubCommitStatusConverter;

    /**
     * @var GithubIssueConverter
     */
    private $githubIssueConverter;
    /**
     * @var GithubMilestoneConverter
     */
    private $githubMilestoneConverter;

    /**
     * SimpleRepoFacade constructor.
     *
     * @param $repoFacade
     * @param $githubRepoConverter
     * @param $githubBranchConverter
     * @param $githubTagConverter
     * @param $githubPullRequestConverter
     * @param $githubCommitConverter
     * @param $githubCommitStatusConverter
     * @param $githubIssueConverter
     * @param $githubMilestoneConverter
     */
    public function __construct(
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
        $this->repoFacade                  = $repoFacade;
        $this->githubRepoConverter         = $githubRepoConverter;
        $this->githubBranchConverter       = $githubBranchConverter;
        $this->githubTagConverter          = $githubTagConverter;
        $this->githubPullRequestConverter  = $githubPullRequestConverter;
        $this->githubCommitConverter       = $githubCommitConverter;
        $this->githubCommitStatusConverter = $githubCommitStatusConverter;
        $this->githubIssueConverter        = $githubIssueConverter;
        $this->githubMilestoneConverter    = $githubMilestoneConverter;
    }

    /**
     * Fetches GithubRepo details.
     *
     * @return array
     */
    public function fetchDetails()
    {
        $rawResult = $this->repoFacade->fetchDetails();

        return $this->githubRepoConverter->convert($rawResult);
    }

    /**
     * Fetches GithubBranch details.
     *
     * @param $branchName
     *
     * @return array
     */
    public function fetchBranch($branchName)
    {
        $rawResult = $this->repoFacade->fetchBranch($branchName);

        return $this->githubBranchConverter->convert($rawResult);
    }

    /**
     * @return array
     */
    public function fetchAllBranches()
    {
        $results    = [];
        $rawResults = $this->repoFacade->fetchAllBranches();

        foreach ($rawResults as $rawResult) {
            $results[] = $this->githubBranchConverter->convert($rawResult);
        }

        return $results;
    }

    /**
     * @return array
     */
    public function fetchAllTags()
    {
        $results    = [];
        $rawResults = $this->repoFacade->fetchAllTags();

        foreach ($rawResults as $rawResult) {
            $results[] = $this->githubTagConverter->convert($rawResult);
        }

        return $results;
    }

    /**
     * Fetches GithubCommit details.
     *
     * @param $commitSha
     *
     * @return array
     */
    public function fetchCommit($commitSha)
    {
        $rawResult = $this->repoFacade->fetchCommit($commitSha);

        return $this->githubCommitConverter->convert($rawResult);
    }

    /**
     * Fetches GithubCommit status.
     *
     * @param $commitSha
     *
     * @return array
     */
    public function fetchCommitStatus($commitSha)
    {
        $results    = [];
        $rawResults = $this->repoFacade->fetchCommitStatus($commitSha);

        foreach ($rawResults['statuses'] as $rawResult) {
            $rawResult['sha'] = $commitSha;
            $results[]        = $this->githubCommitStatusConverter->convert($rawResult);
        }

        return $results;
    }

    /**
     * Fetches list of GithubCommit statuses.
     *
     * @param $commitSha
     *
     * @return array
     */
    public function fetchCommitStatuses($commitSha)
    {
        $results    = [];
        $rawResults = $this->repoFacade->fetchCommitStatuses($commitSha);

        foreach ($rawResults as $rawResult) {
            $rawResult['sha'] = $commitSha;
            $results[]        = $this->githubCommitStatusConverter->convert($rawResult);
        }

        return $results;
    }

    /**
     * @return array
     */
    public function fetchAllPullRequests()
    {
        $results    = [];
        $rawResults = $this->repoFacade->fetchAllPullRequests();

        foreach ($rawResults as $rawResult) {
            $results[] = $this->githubPullRequestConverter->convert($rawResult);
        }

        return $results;
    }

    /**
     * @return array
     */
    public function fetchAllMilestones()
    {
        $results    = [];
        $rawResults = $this->repoFacade->fetchAllMilestones();

        foreach ($rawResults as $rawResult) {
            $results[] = $this->githubMilestoneConverter->convert($rawResult);
        }

        return $results;
    }

    /**
     * @return array
     */
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

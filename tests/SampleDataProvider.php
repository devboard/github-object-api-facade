<?php

namespace tests\DevBoardLib\GithubObjectApiFacade;

/**
 * Class SampleDataProvider.
 */
class SampleDataProvider
{
    const DEFAULT_REPO       = 'devboard/test-hitman';
    const DEFAULT_BRANCH     = 'master';
    const DEFAULT_COMMIT_SHA = 'db911bd3a3dd8bb2ad9eccbcb0a396595a51491d';

    /**
     * @return array
     */
    public function getRepos()
    {
        return $this->getMyRepositoriesAll();
    }

    /**
     * @return mixed
     */
    public function getRepoDetails($fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/repo-details.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getBranch($fullName = self::DEFAULT_REPO, $branchName = self::DEFAULT_BRANCH)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/branch-'.$branchName.'.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllBranches($fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/branches.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllBranchNames($fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/branchnames.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllTagNames($fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/tags.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getCommit($fullName = self::DEFAULT_REPO, $commitSha = self::DEFAULT_COMMIT_SHA)
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/'.$fullName.'/commit-'.$commitSha.'.json'
        );

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getCommitStatus($fullName = self::DEFAULT_REPO, $commitSha = self::DEFAULT_COMMIT_SHA)
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/'.$fullName.'/commit_status-'.$commitSha.'.json'
        );

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getCommitStatuses($fullName = self::DEFAULT_REPO, $commitSha = self::DEFAULT_COMMIT_SHA)
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/'.$fullName.'/commit_statuses-'.$commitSha.'.json'
        );

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllPullRequests($fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/pullrequests.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllMilestones($fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/milestones.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllIssues($fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/issues.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getMyRepositoriesAll()
    {
        $content = file_get_contents(__DIR__.'/sample-data/me/repositories/all.json');

        return json_decode($content, true);
    }
}

<?php

declare (strict_types = 1);
namespace tests\DevBoardLib\GithubObjectApiFacade;

/**
 * Class JsonSampleDataProvider.
 */
class JsonSampleDataProvider
{
    /** Full name of default repo */
    const DEFAULT_REPO = 'devboard/test-hitman';
    /** Branch name of default branch*/
    const DEFAULT_BRANCH = 'master';
    /** Sha for default commit*/
    const DEFAULT_COMMIT_SHA = 'db911bd3a3dd8bb2ad9eccbcb0a396595a51491d';

    /**
     * @return array
     */
    public function getRepos()
    {
        return $this->getMyRepositoriesAll();
    }

    /**
     * @param string $fullName
     *
     * @return mixed
     */
    public function getRepoDetails(string $fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/repo-details.json');

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     * @param string $branchName
     *
     * @return mixed
     */
    public function getBranch(string $fullName = self::DEFAULT_REPO, string $branchName = self::DEFAULT_BRANCH)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/branch-'.$branchName.'.json');

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     *
     * @return mixed
     */
    public function getAllBranches(string $fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/branches.json');

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     *
     * @return mixed
     */
    public function getAllBranchNames(string $fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/branchnames.json');

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     *
     * @return mixed
     */
    public function getAllTagNames(string $fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/tags.json');

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     * @param string $sha
     *
     * @return mixed
     */
    public function getCommit(string $fullName = self::DEFAULT_REPO, string $sha = self::DEFAULT_COMMIT_SHA)
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/'.$fullName.'/commit-'.$sha.'.json'
        );

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     * @param string $sha
     *
     * @return mixed
     */
    public function getCommitStatus(string $fullName = self::DEFAULT_REPO, string $sha = self::DEFAULT_COMMIT_SHA)
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/'.$fullName.'/commit_status-'.$sha.'.json'
        );

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     * @param string $sha
     *
     * @return mixed
     */
    public function getCommitStatuses(string $fullName = self::DEFAULT_REPO, string $sha = self::DEFAULT_COMMIT_SHA)
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/'.$fullName.'/commit_statuses-'.$sha.'.json'
        );

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     *
     * @return mixed
     */
    public function getAllPullRequests(string $fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/pullrequests.json');

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     *
     * @return mixed
     */
    public function getAllMilestones(string $fullName = self::DEFAULT_REPO)
    {
        $content = file_get_contents(__DIR__.'/sample-data/'.$fullName.'/milestones.json');

        return json_decode($content, true);
    }

    /**
     * @param string $fullName
     *
     * @return mixed
     */
    public function getAllIssues(string $fullName = self::DEFAULT_REPO)
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

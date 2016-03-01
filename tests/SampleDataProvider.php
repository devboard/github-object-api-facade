<?php

namespace tests\DevBoardLib\GithubObjectApiFacade;

/**
 * Class SampleDataProvider.
 */
class SampleDataProvider
{
    /**
     * @return mixed
     */
    public function getRepoDetails()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/repo-details.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getBranch()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/branch-master.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllBranches()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/branches.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllBranchNames()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/branchnames.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllTagNames()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/tags.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getCommit()
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/devboard/test-hitman/commit-db911bd3a3dd8bb2ad9eccbcb0a396595a51491d.json'
        );

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getCommitStatus()
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/devboard/test-hitman/commit_status-db911bd3a3dd8bb2ad9eccbcb0a396595a51491d.json'
        );

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getCommitStatuses()
    {
        $content = file_get_contents(
            __DIR__.'/sample-data/devboard/test-hitman/commit_statuses-db911bd3a3dd8bb2ad9eccbcb0a396595a51491d.json'
        );

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllPullRequests()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/pull_requests.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllMilestones()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/milestones.json');

        return json_decode($content, true);
    }

    /**
     * @return mixed
     */
    public function getAllIssues()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/issues.json');

        return json_decode($content, true);
    }
}

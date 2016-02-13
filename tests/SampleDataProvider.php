<?php
namespace tests\DevBoardLib\GithubObjectApiFacade;

class SampleDataProvider
{
    public function getAllMilestones()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/milestones.json');

        return json_decode($content, true);
    }

    public function getAllIssues()
    {
        $content = file_get_contents(__DIR__.'/sample-data/devboard/test-hitman/issues.json');

        return json_decode($content, true);
    }
}

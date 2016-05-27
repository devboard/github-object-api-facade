<?php

declare (strict_types = 1);
namespace DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter;

use DateTime;
use DevBoardLib\GithubCore\Issue\GithubIssueId;
use DevBoardLib\GithubCore\Issue\GithubIssueSource;
use DevBoardLib\GithubCore\Issue\State\GithubIssueStateFactory;

/**
 * Class GithubIssueConvertTrait.
 */
trait GithubIssueConvertTrait
{
    /**
     * @param array $data
     *
     * @throws \Exception
     *
     * @return GithubIssueSource
     */
    protected function convertIssue(array $data)
    {
        return new GithubIssueSource(
            new GithubIssueId($data['id']),
            $this->githubRepo,
            $data['number'],
            GithubIssueStateFactory::create($data['state']),
            $data['title'],
            $data['body'],
            $this->getUser($data['user']),
            $this->getUserIfExists($data['assignee']),
            $this->getMilestoneIfExists($data['milestone']),
            $data['comments'],

            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            $this->getDateIfExists($data['closed_at'])

        );
    }
}

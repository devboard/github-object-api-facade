<?php

declare (strict_types = 1);
namespace DevBoardLib\GithubObjectApiFacade\Repo\PullRequest\Converter;

use DateTime;
use DevBoardLib\GithubCore\Commit\GithubCommitId;
use DevBoardLib\GithubCore\Commit\GithubCommitSha;
use DevBoardLib\GithubCore\PullRequest\GithubPullRequestId;
use DevBoardLib\GithubCore\PullRequest\GithubPullRequestSource;
use DevBoardLib\GithubCore\PullRequest\State\GithubPullRequestStateFactory;

/**
 * Class GithubPullRequestConvertTrait.
 */
trait GithubPullRequestConvertTrait
{
    /**
     * @param array $data
     *
     * @throws \Exception
     *
     * @return GithubPullRequestSource
     */
    protected function convertPullRequest(array $data)
    {
        return new GithubPullRequestSource(
            new GithubPullRequestId($data['id']),
            $this->githubRepo,
            $data['number'],
            GithubPullRequestStateFactory::create($data['state']),
            $data['locked'],
            $data['merged_at'],
            $data['title'],
            $data['body'],
            new GithubCommitId(
                $this->githubRepo->getId(),
                new GithubCommitSha($data['head']['sha'])
            ),
            $this->getUser($data['user']),
            $this->getUserIfExists($data['assignee']),
            $this->getMilestoneIfExists($data['milestone']),
            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            $this->getDateIfExists($data['closed_at'])

        );
    }
}

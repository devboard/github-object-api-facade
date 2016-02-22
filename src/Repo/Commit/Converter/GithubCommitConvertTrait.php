<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter;

use DateTime;
use DevBoardLib\GithubCore\Commit\GithubCommitId;
use DevBoardLib\GithubCore\Commit\GithubCommitSha;
use DevBoardLib\GithubCore\Commit\GithubCommitSource;
use DevBoardLib\GithubCore\User\GithubUserId;
use DevBoardLib\GithubCore\User\GithubUserSource;

/**
 * Class GithubCommitConvertTrait.
 */
trait GithubCommitConvertTrait
{
    /**
     * @param $data
     *
     * @return GithubCommitSource
     */
    protected function convertCommit($data)
    {
        return new GithubCommitSource(
            new GithubCommitId($this->githubRepo->getId(), new GithubCommitSha($data['sha'])),
            $this->githubRepo,
            new GithubCommitSha($data['sha']),
            $data['commit']['author']['name'],
            $data['commit']['author']['email'],
            $this->getAuthor($data),
            new DateTime($data['commit']['author']['date']),
            $this->getCommitter($data),
            new DateTime($data['commit']['committer']['date']),
            $data['commit']['message'],
            null

        );
    }

    /**
     * @param $data
     *
     * @return GithubUserSource
     */
    protected function getAuthor($data)
    {
        return new GithubUserSource(
            new GithubUserId($data['author']['id']),
            $data['author']['login'],
            $data['commit']['author']['email'],
            $data['commit']['author']['name'],
            $data['author']['avatar_url']

        );
    }

    /**
     * @param $data
     *
     * @return GithubUserSource
     */
    protected function getCommitter($data)
    {
        return new GithubUserSource(
            new GithubUserId($data['committer']['id']),
            $data['committer']['login'],
            $data['commit']['committer']['email'],
            $data['commit']['committer']['name'],
            $data['committer']['avatar_url']

        );
    }
}

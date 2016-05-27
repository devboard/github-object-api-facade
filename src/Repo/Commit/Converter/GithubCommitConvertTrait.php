<?php

declare (strict_types = 1);
namespace DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter;

use DevBoardLib\GithubCore\Commit\GithubCommitAuthor;
use DevBoardLib\GithubCore\Commit\GithubCommitCommitter;
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
     * @param array $data
     *
     * @return GithubCommitSource
     */
    protected function convertCommit(array $data)
    {
        return new GithubCommitSource(
            new GithubCommitSha($data['sha']),
            $this->githubRepo->getId(),
            $this->getAuthor($data),
            $this->getCommitter($data),
            $data['commit']['message'],
            null

        );
    }

    /**
     * @param array $data
     *
     * @return GithubUserSource
     */
    protected function getAuthor(array $data)
    {
        return new GithubCommitAuthor(
            $data['commit']['author']['name'],
            $data['commit']['author']['email'],
            new GithubUserId($data['author']['id']),
            $data['author']['login'],
            $data['author']['avatar_url']

        );
    }

    /**
     * @param array $data
     *
     * @return GithubUserSource
     */
    protected function getCommitter(array $data)
    {
        return new GithubCommitCommitter(
            $data['commit']['committer']['name'],
            $data['commit']['committer']['email'],
            new GithubUserId($data['committer']['id']),
            $data['committer']['login'],
            $data['committer']['avatar_url']

        );
    }
}

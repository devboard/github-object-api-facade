<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter;

use DateTime;
use DevBoardLib\GithubCore\Commit\GithubCommitId;
use DevBoardLib\GithubCore\Commit\GithubCommitSha;
use DevBoardLib\GithubCore\CommitStatus\GithubCommitStatusId;
use DevBoardLib\GithubCore\CommitStatus\GithubCommitStatusSource;
use DevBoardLib\GithubCore\CommitStatus\State\GithubCommitStatusStateFactory;
use DevBoardLib\GithubCore\CommitStatus\StateFactory;
use DevBoardLib\GithubCore\ExternalServices\ExternalServiceFactory;

/**
 * Class GithubCommitStatusConvertTrait.
 */
trait GithubCommitStatusConvertTrait
{
    /**
     * @param array $data
     *
     * @throws \Exception
     *
     * @return GithubCommitStatusSource
     */
    protected function convertCommitStatus(array $data)
    {
        return new GithubCommitStatusSource(
            new GithubCommitStatusId($data['id']),
            $this->githubRepo->getId(),
            new GithubCommitId($this->githubRepo->getId(), new GithubCommitSha($data['sha'])),
            ExternalServiceFactory::create($data['context']),
            $data['description'],
            $data['target_url'],
            StateFactory::create($data['state']),
            new DateTime($data['created_at']),
            new DateTime($data['updated_at'])

        );
    }
}

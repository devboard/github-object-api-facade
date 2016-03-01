<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\CommitStatus\Converter;

use DateTime;
use DevBoardLib\GithubCore\Commit\GithubCommitId;
use DevBoardLib\GithubCore\Commit\GithubCommitSha;
use DevBoardLib\GithubCore\CommitStatus\GithubCommitStatusId;
use DevBoardLib\GithubCore\CommitStatus\GithubCommitStatusSource;
use DevBoardLib\GithubCore\CommitStatus\State\GithubCommitStatusStateFactory;
use DevBoardLib\GithubCore\External\ExternalServiceId;

/**
 * Class GithubCommitStatusConvertTrait.
 */
trait GithubCommitStatusConvertTrait
{
    /**
     * @param $data
     *
     * @throws \Exception
     *
     * @return GithubCommitStatusSource
     */
    protected function convertCommitStatus($data)
    {
        return new GithubCommitStatusSource(
            new GithubCommitStatusId($data['id']),
            new GithubCommitId($this->githubRepo->getId(), new GithubCommitSha($data['sha'])),
            new ExternalServiceId($data['context']),
            $data['description'],
            $data['target_url'],
            GithubCommitStatusStateFactory::create($data['state']),
            new DateTime($data['created_at']),
            new DateTime($data['updated_at'])

        );
    }
}

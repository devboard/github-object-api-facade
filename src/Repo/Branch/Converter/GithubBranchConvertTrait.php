<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Branch\Converter;

use DevBoardLib\GithubCore\Branch\GithubBranchId;
use DevBoardLib\GithubCore\Branch\GithubBranchSource;

/**
 * Class GithubBranchConvertTrait.
 */
trait GithubBranchConvertTrait
{
    /**
     * @param $data
     *
     * @return GithubBranchSource
     */
    protected function convertBranch($data)
    {
        return new GithubBranchSource(
            new GithubBranchId($this->githubRepo->getId(), $data['name']),
            $this->githubRepo,
            $data['name'],
            $this->convertCommit($data['commit'])

        );
    }
}

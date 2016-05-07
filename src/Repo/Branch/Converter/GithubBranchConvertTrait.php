<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\Branch\Converter;

use DevBoardLib\GithubCore\Branch\GithubBranchSource;

/**
 * Class GithubBranchConvertTrait.
 */
trait GithubBranchConvertTrait
{
    /**
     * @param array $data
     *
     * @return GithubBranchSource
     */
    protected function convertBranch(array $data)
    {
        return new GithubBranchSource(
            $this->githubRepo->getId(),
            $data['name'],
            $this->convertCommit($data['commit'])

        );
    }
}

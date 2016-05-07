<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter;

use DevBoardLib\GithubCore\Tag\GithubTagSource;

/**
 * Class GithubTagConvertTrait.
 */
trait GithubTagConvertTrait
{
    /**
     * @param array $data
     *
     * @return GithubTagSource
     */
    protected function convertTag(array $data)
    {
        return new GithubTagSource(
            $this->githubRepo->getId(),
            $data['name'],
            $this->convertCommit($data['commit'])

        );
    }
}

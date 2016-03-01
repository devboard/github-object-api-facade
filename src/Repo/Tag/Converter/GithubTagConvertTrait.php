<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter;

use DevBoardLib\GithubCore\Tag\GithubTagId;
use DevBoardLib\GithubCore\Tag\GithubTagSource;

/**
 * Class GithubTagConvertTrait.
 */
trait GithubTagConvertTrait
{
    /**
     * @param $data
     *
     * @return GithubTagSource
     */
    protected function convertTag($data)
    {
        return new GithubTagSource(
            new GithubTagId($this->githubRepo->getId(), $data['name']),
            $this->githubRepo,
            $data['name'],
            $this->convertCommit($data['commit'])

        );
    }
}

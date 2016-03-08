<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter;

use DevBoardLib\GithubObjectApiFacade\User\Converter\GithubUserConvertTrait;

/**
 * Class GithubRepoConverter.
 */
class GithubRepoConverter
{
    use GithubRepoConvertTrait;
    use GithubUserConvertTrait;

    /**
     * GithubMilestoneConverter constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param array $data
     *
     * @return \DevBoardLib\GithubCore\Repo\GithubRepoSource
     */
    public function convert(array $data)
    {
        return $this->convertRepo($data);
    }
}

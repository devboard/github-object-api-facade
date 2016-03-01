<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\User\Converter\GithubUserConvertTrait;

/**
 * Class GithubCommitConverter.
 */
class GithubCommitConverter
{
    use GithubCommitConvertTrait;
    use GithubUserConvertTrait;
    private $githubRepo;

    /**
     * GithubMilestoneConverter constructor.
     *
     * @param $githubRepo
     */
    public function __construct(GithubRepo $githubRepo)
    {
        $this->githubRepo = $githubRepo;
    }

    /**
     * @param $data
     *
     * @return \DevBoardLib\GithubCore\Commit\GithubCommitSource
     */
    public function convert($data)
    {
        return $this->convertCommit($data);
    }
}

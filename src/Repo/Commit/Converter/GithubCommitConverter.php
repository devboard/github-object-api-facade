<?php

declare (strict_types = 1);
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
    /**
     * @var GithubRepo
     */
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

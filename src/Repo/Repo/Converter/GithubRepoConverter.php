<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\User\Converter\GithubUserConvertTrait;

/**
 * Class GithubRepoConverter.
 */
class GithubRepoConverter
{
    use GithubRepoConvertTrait;
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
     * @return \DevBoardLib\GithubCore\Repo\GithubRepoSource
     */
    public function convert($data)
    {
        return $this->convertRepo($data);
    }
}

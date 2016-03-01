<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\PullRequest\Converter;

use DateTime;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter\GithubCommitConvertTrait;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConvertTrait;
use DevBoardLib\GithubObjectApiFacade\User\Converter\GithubUserConvertTrait;

/**
 * Class GithubPullRequestConverter.
 */
class GithubPullRequestConverter
{
    use GithubPullRequestConvertTrait;
    use GithubCommitConvertTrait;
    use GithubMilestoneConvertTrait;
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
     * @return \DevBoardLib\GithubCore\PullRequest\GithubPullRequestSource
     */
    public function convert($data)
    {
        return $this->convertPullRequest($data);
    }

    /**
     * @param $dateString
     *
     * @return DateTime|null
     */
    protected function getDateIfExists($dateString)
    {
        if (empty($dateString)) {
            return null;
        }

        return new DateTime($dateString);
    }
}

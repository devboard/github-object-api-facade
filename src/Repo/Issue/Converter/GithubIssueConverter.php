<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter;

use DateTime;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConvertTrait;
use DevBoardLib\GithubObjectApiFacade\User\Converter\GithubUserConvertTrait;

/**
 * Class GithubIssueConverter.
 */
class GithubIssueConverter
{
    use GithubIssueConvertTrait;
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
     * @return \DevBoardLib\GithubCore\Issue\GithubIssueSource
     */
    public function convert($data)
    {
        return $this->convertIssue($data);
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

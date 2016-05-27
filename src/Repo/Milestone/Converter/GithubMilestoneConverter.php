<?php

declare (strict_types = 1);
namespace DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter;

use DateTime;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\User\Converter\GithubUserConvertTrait;

/**
 * Class GithubMilestoneConverter.
 */
class GithubMilestoneConverter
{
    use GithubMilestoneConvertTrait;
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
     * @param array $data
     *
     * @return \DevBoardLib\GithubCore\Milestone\GithubMilestoneSource
     */
    public function convert(array $data)
    {
        return $this->convertMilestone($data);
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

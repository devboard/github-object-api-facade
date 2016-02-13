<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter;

use DateTime;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\User\Converter\GithubUserConvertTrait;

class GithubMilestoneConverter
{
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

    public function convert($data)
    {
        return $this->convertMilestone($data);
    }

    protected function getDateIfExists($dateString)
    {
        if (empty($dateString)) {
            return null;
        }

        return new DateTime($dateString);
    }
}

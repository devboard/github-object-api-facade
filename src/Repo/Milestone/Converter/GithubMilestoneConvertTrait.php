<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter;

use DateTime;
use DevBoardLib\GithubCore\Milestone\GithubMilestoneId;
use DevBoardLib\GithubCore\Milestone\GithubMilestoneSource;
use DevBoardLib\GithubCore\Milestone\State\GithubMilestoneStateFactory;

/**
 * Class GithubMilestoneConvertTrait.
 */
trait GithubMilestoneConvertTrait
{
    /**
     * @param $data
     *
     * @throws \Exception
     *
     * @return GithubMilestoneSource
     */
    protected function convertMilestone($data)
    {
        $milestone = new GithubMilestoneSource(
            new GithubMilestoneId($data['id']),
            $this->githubRepo,
            $data['number'],
            GithubMilestoneStateFactory::create($data['state']),
            $data['title'],
            $data['description'],
            $this->getUserIfExists($data['creator']),
            $data['open_issues'],
            $data['closed_issues'],
            $this->getDateIfExists($data['due_on']),
            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            $this->getDateIfExists($data['closed_at'])

        );

        return $milestone;
    }

    /**
     * @param $data
     *
     * @return GithubMilestoneSource|null
     */
    protected function getMilestoneIfExists($data)
    {
        if (empty($data)) {
            return null;
        }

        return $this->convertMilestone($data);
    }
}

<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Tag\Converter;

use DateTime;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubObjectApiFacade\Repo\Commit\Converter\GithubCommitConvertTrait;
use DevBoardLib\GithubObjectApiFacade\User\Converter\GithubUserConvertTrait;

/**
 * Class GithubTagConverter.
 */
class GithubTagConverter
{
    use GithubTagConvertTrait;
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
     * @return \DevBoardLib\GithubCore\Tag\GithubTagSource
     */
    public function convert($data)
    {
        return $this->convertTag($data);
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

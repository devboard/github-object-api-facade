<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Milestone;

use DateTime;
use DevBoardLib\GithubCore\Milestone\GithubMilestone;
use DevBoardLib\GithubCore\Milestone\GithubMilestoneId;
use DevBoardLib\GithubCore\Milestone\State\GithubMilestoneState;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubCore\User\GithubUser;
use DevBoardLib\GithubCore\User\GithubUserId;

class GithubMilestoneSource implements GithubMilestone
{
    /** @var GithubMilestoneId */
    protected $id;
    /** @var GithubRepo */
    protected $repo;
    /** @var int */
    private $number;
    /** @var GithubMilestoneState */
    private $state;
    /** @var string */
    private $title;
    /** @var string */
    private $description;
    /** @var GithubUser */
    private $createdByUser;
    /** @var int */
    private $openIssueCount;
    /** @var int */
    private $closedIssueCount;
    /** @var \DateTime */
    private $dueDate;
    /** @var \DateTime */
    private $githubCreatedAt;
    /** @var \DateTime */
    private $githubUpdatedAt;
    /** @var \DateTime */
    private $githubClosedAt;

    /**
     * GithubMilestoneSource constructor.
     *
     * @param GithubMilestoneId    $id
     * @param GithubRepo           $repo
     * @param int                  $number
     * @param GithubMilestoneState $state
     * @param string               $title
     * @param string               $description
     * @param GithubUser           $createdByUser
     * @param int                  $openIssueCount
     * @param int                  $closedIssueCount
     * @param DateTime             $dueDate
     * @param DateTime             $githubCreatedAt
     * @param DateTime             $githubUpdatedAt
     * @param DateTime             $githubClosedAt
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        GithubMilestoneId $id,
        GithubRepo $repo,
        $number,
        GithubMilestoneState $state,
        $title,
        $description,
        GithubUser $createdByUser,
        $openIssueCount,
        $closedIssueCount,
        DateTime $dueDate = null,
        DateTime $githubCreatedAt,
        DateTime $githubUpdatedAt,
        DateTime $githubClosedAt = null
    ) {
        $this->id               = $id;
        $this->repo             = $repo;
        $this->number           = $number;
        $this->state            = $state;
        $this->title            = $title;
        $this->description      = $description;
        $this->createdByUser    = $createdByUser;
        $this->openIssueCount   = $openIssueCount;
        $this->closedIssueCount = $closedIssueCount;
        $this->dueDate          = $dueDate;
        $this->githubCreatedAt  = $githubCreatedAt;
        $this->githubUpdatedAt  = $githubUpdatedAt;
        $this->githubClosedAt   = $githubClosedAt;
    }

    /**
     * @return GithubMilestoneId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return GithubRepoId
     */
    public function getRepoId()
    {
        return $this->repo->getId();
    }

    /**
     * @return GithubRepo
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return GithubMilestoneState
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return GithubUserId
     */
    public function getCreatedByUserId()
    {
        return $this->createdByUser->getGithubUserId();
    }

    /**
     * @return GithubUser
     */
    public function getCreatedByUser()
    {
        return $this->createdByUser;
    }

    /**
     * @return int
     */
    public function getOpenIssueCount()
    {
        return $this->openIssueCount;
    }

    /**
     * @return int
     */
    public function getClosedIssueCount()
    {
        return $this->closedIssueCount;
    }

    /**
     * @return DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @return DateTime
     */
    public function getGithubCreatedAt()
    {
        return $this->githubCreatedAt;
    }

    /**
     * @return DateTime
     */
    public function getGithubUpdatedAt()
    {
        return $this->githubUpdatedAt;
    }

    /**
     * @return DateTime
     */
    public function getGithubClosedAt()
    {
        return $this->githubClosedAt;
    }
}

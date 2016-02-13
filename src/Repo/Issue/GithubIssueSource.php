<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Issue;

use DateTime;
use DevBoardLib\GithubCore\Issue\GithubIssue;
use DevBoardLib\GithubCore\Issue\GithubIssueId;
use DevBoardLib\GithubCore\Issue\State\GithubIssueState;
use DevBoardLib\GithubCore\Milestone\GithubMilestone;
use DevBoardLib\GithubCore\Milestone\GithubMilestoneId;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubCore\User\GithubUser;
use DevBoardLib\GithubCore\User\GithubUserId;

class GithubIssueSource implements GithubIssue
{
    /** @var GithubIssueId */
    protected $id;
    /** @var GithubRepo */
    protected $repo;
    /** @var int */
    private $number;
    /** @var GithubIssueState */
    private $state;
    /** @var string */
    private $title;
    /** @var string */
    private $body;
    /** @var GithubUser */
    private $createdByUser;
    /** @var GithubUser */
    private $assignedToUser;
    /** @var GithubMilestone */
    private $milestone;
    /** @var int */
    private $commentCount;
    /** @var \DateTime */
    private $githubCreatedAt;
    /** @var \DateTime */
    private $githubUpdatedAt;
    /** @var \DateTime */
    private $githubClosedAt;

    /**
     * GithubIssueSource constructor.
     *
     * @param GithubIssueId    $id
     * @param GithubRepo       $repo
     * @param int              $number
     * @param GithubIssueState $state
     * @param string           $title
     * @param string           $body
     * @param GithubUser       $createdByUser
     * @param GithubUser       $assignedToUser
     * @param GithubMilestone  $milestone
     * @param int              $commentCount
     * @param DateTime         $githubCreatedAt
     * @param DateTime         $githubUpdatedAt
     * @param DateTime         $githubClosedAt
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        GithubIssueId $id,
        GithubRepo $repo,
        $number,
        GithubIssueState $state,
        $title,
        $body,
        GithubUser $createdByUser,
        GithubUser $assignedToUser = null,
        GithubMilestone $milestone = null,
        $commentCount,
        DateTime $githubCreatedAt,
        DateTime $githubUpdatedAt,
        DateTime $githubClosedAt = null
    ) {
        $this->id              = $id;
        $this->repo            = $repo;
        $this->number          = $number;
        $this->state           = $state;
        $this->title           = $title;
        $this->body            = $body;
        $this->createdByUser   = $createdByUser;
        $this->assignedToUser  = $assignedToUser;
        $this->milestone       = $milestone;
        $this->commentCount    = $commentCount;
        $this->githubCreatedAt = $githubCreatedAt;
        $this->githubUpdatedAt = $githubUpdatedAt;
        $this->githubClosedAt  = $githubClosedAt;
    }

    /**
     * @return GithubIssueId
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
     * @return GithubIssueState
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
    public function getBody()
    {
        return $this->body;
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
     * @return GithubUserId
     */
    public function getAssignedToUserId()
    {
        if (null !== $this->assignedToUser) {
            return $this->assignedToUser->getGithubUserId();
        }

        return null;
    }

    /**
     * @return GithubUser
     */
    public function getAssignedToUser()
    {
        return $this->assignedToUser;
    }

    /**
     * @return GithubMilestoneId
     */
    public function getMilestoneId()
    {
        if (null !== $this->milestone) {
            return $this->milestone->getId();
        }

        return null;
    }

    /**
     * @return GithubMilestone
     */
    public function getMilestone()
    {
        return $this->milestone;
    }

    /**
     * @return int
     */
    public function getCommentCount()
    {
        return $this->commentCount;
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

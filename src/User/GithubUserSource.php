<?php
namespace DevBoardLib\GithubObjectApiFacade\User;

use DevBoardLib\GithubCore\User\GithubUser;
use DevBoardLib\GithubCore\User\GithubUserId;

class GithubUserSource implements GithubUser
{
    /** @var GithubUserId */
    private $githubUserId;
    /** @var string */
    private $username;
    /** @var string */
    private $email;
    /** @var string */
    private $name;
    /** @var string */
    private $avatarUrl;

    /**
     * GithubUserSource constructor.
     *
     * @param GithubUserId $githubUserId
     * @param string       $username
     * @param string       $email
     * @param string       $name
     * @param string       $avatarUrl
     */
    public function __construct(GithubUserId $githubUserId, $username, $email = null, $name = null, $avatarUrl)
    {
        $this->githubUserId = $githubUserId;
        $this->username     = $username;
        $this->email        = $email;
        $this->name         = $name;
        $this->avatarUrl    = $avatarUrl;
    }

    /**
     * @return GithubUserId
     */
    public function getGithubUserId()
    {
        return $this->githubUserId;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }
}

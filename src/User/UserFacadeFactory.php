<?php

declare (strict_types = 1);
namespace DevBoardLib\GithubObjectApiFacade\User;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\User\UserFacadeFactory as WrappedUserFacadeFactory;
use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;

/**
 * Class UserFacadeFactory.
 */
class UserFacadeFactory
{
    /**
     * @var WrappedUserFacadeFactory
     */
    private $wrappedUserFacadeFactory;

    /**
     * UserFacadeFactory constructor.
     *
     * @param $wrappedUserFacadeFactory
     */
    public function __construct(WrappedUserFacadeFactory $wrappedUserFacadeFactory)
    {
        $this->wrappedUserFacadeFactory = $wrappedUserFacadeFactory;
    }

    /**
     * @param GithubAccessToken $user
     *
     * @return SimpleUserFacade
     */
    public function create(GithubAccessToken $user)
    {
        return new SimpleUserFacade(
            $this->wrappedUserFacadeFactory->create($user),
            new GithubRepoConverter()
        );
    }
}

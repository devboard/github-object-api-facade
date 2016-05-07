<?php

namespace DevBoardLib\GithubObjectApiFacade\User\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepoOwner;
use DevBoardLib\GithubCore\User\GithubUserId;
use DevBoardLib\GithubCore\User\GithubUserSource;
use DevBoardLib\GithubCore\User\Type\GithubTypeFactory;

/**
 * Class GithubUserConvertTrait.
 */
trait GithubUserConvertTrait
{
    /**
     * @param array $data
     *
     * @return GithubUserSource
     */
    protected function getGithubRepoOwner(array $data)
    {
        return new GithubRepoOwner(
            new GithubUserId($data['id']),
            $data['login'],
            $data['avatar_url'],
            GithubTypeFactory::create($data['type'])

        );
    }

    /**
     * @param array $data
     *
     * @return GithubUserSource
     */
    protected function getUser(array $data)
    {
        return new GithubUserSource(
            new GithubUserId($data['id']),
            $data['login'],
            null,
            null,
            $data['avatar_url']

        );
    }

    /**
     * @param array|null $data
     *
     * @return GithubUserSource|null
     */
    protected function getUserIfExists(array $data = null)
    {
        if (empty($data)) {
            return null;
        }

        return $this->getUser($data);
    }
}

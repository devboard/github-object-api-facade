<?php
namespace DevBoardLib\GithubObjectApiFacade\User\Converter;

use DevBoardLib\GithubCore\User\GithubUserId;
use DevBoardLib\GithubObjectApiFacade\User\GithubUserSource;

trait GithubUserConvertTrait
{
    protected function getUser($data)
    {
        return new GithubUserSource(
            new GithubUserId($data['id']),
            $data['login'],
            null,
            null,
            $data['avatar_url']

        );
    }

    protected function getUserIfExists($data)
    {
        if (empty($data)) {
            return null;
        }

        return $this->getUser($data);
    }
}

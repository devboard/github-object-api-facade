<?php

namespace DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter;

use DateTime;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubCore\Repo\GithubRepoPermissions;
use DevBoardLib\GithubCore\Repo\GithubRepoSource;

/**
 * Class GithubRepoConvertTrait.
 */
trait GithubRepoConvertTrait
{
    /**
     * @param array $data
     *
     * @return GithubRepoSource
     */
    protected function convertRepo(array $data)
    {
        $permissions = null;

        if (array_key_exists('permissions', $data)) {
            $permissions = new GithubRepoPermissions(
                (bool) $data['permissions']['admin'],
                (bool) $data['permissions']['push'],
                (bool) $data['permissions']['pull']
            );
        }

        return new GithubRepoSource(
            new GithubRepoId($data['id']),
            $this->getUser($data['owner']),
            $data['owner']['login'],
            $data['name'],
            $data['full_name'],
            $data['html_url'],
            $data['description'],
            $data['fork'],
            $data['default_branch'],
            $data['private'],
            $data['git_url'],
            $data['ssh_url'],
            $permissions,
            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            new DateTime($data['pushed_at'])
        );
    }
}

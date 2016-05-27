<?php

declare (strict_types = 1);
namespace DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepoCreatedAt;
use DevBoardLib\GithubCore\Repo\GithubRepoFullName;
use DevBoardLib\GithubCore\Repo\GithubRepoGitUrl;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubCore\Repo\GithubRepoName;
use DevBoardLib\GithubCore\Repo\GithubRepoPermissions;
use DevBoardLib\GithubCore\Repo\GithubRepoPushedAt;
use DevBoardLib\GithubCore\Repo\GithubRepoSource;
use DevBoardLib\GithubCore\Repo\GithubRepoSshUrl;
use DevBoardLib\GithubCore\Repo\GithubRepoUpdatedAt;

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
            $this->getGithubRepoOwner($data['owner']),
            new GithubRepoName($data['name']),
            new GithubRepoFullName($data['full_name']),
            $data['html_url'],
            $data['description'],
            $data['fork'],
            $data['default_branch'],
            $data['private'],
            new GithubRepoGitUrl($data['git_url']),
            new GithubRepoSshUrl($data['ssh_url']),
            $permissions,
            new GithubRepoCreatedAt($data['created_at']),
            new GithubRepoUpdatedAt($data['updated_at']),
            new GithubRepoPushedAt($data['pushed_at'])
        );
    }
}

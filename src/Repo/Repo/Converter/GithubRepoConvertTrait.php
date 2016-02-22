<?php
namespace DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter;

use DateTime;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubCore\Repo\GithubRepoSource;

/**
 * Class GithubRepoConvertTrait.
 */
trait GithubRepoConvertTrait
{
    /**
     * @param $data
     *
     * @return GithubRepoSource
     */
    protected function convertRepo($data)
    {
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
            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            new DateTime($data['pushed_at'])
        );
    }
}

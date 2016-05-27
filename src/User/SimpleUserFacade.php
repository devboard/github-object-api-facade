<?php

declare (strict_types = 1);
namespace DevBoardLib\GithubObjectApiFacade\User;

use DevBoardLib\GithubApiFacade\User\UserFacade;
use DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter;

/**
 * Class SimpleUserFacade.
 */
class SimpleUserFacade implements ObjectUserFacade
{
    /**
     * @var UserFacade
     */
    private $userFacade;

    /**
     * @var GithubRepoConverter
     */
    private $githubRepoConverter;

    /**
     * SimpleRepoFacade constructor.
     *
     * @param UserFacade          $userFacade
     * @param GithubRepoConverter $githubRepoConverter
     */
    public function __construct(
        UserFacade $userFacade,
        GithubRepoConverter $githubRepoConverter
    ) {
        $this->userFacade          = $userFacade;
        $this->githubRepoConverter = $githubRepoConverter;
    }

    /**
     * Fetches GithubRepo details.
     *
     * @return array
     */
    public function fetchAllAccessibleRepos()
    {
        $results    = [];
        $rawResults = $this->userFacade->fetchAllAccessibleRepos();

        foreach ($rawResults as $rawResult) {
            $results[] = $this->githubRepoConverter->convert($rawResult);
        }

        return $results;
    }
}

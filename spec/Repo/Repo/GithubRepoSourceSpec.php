<?php
namespace spec\DevBoardLib\GithubObjectApiFacade\Repo\Repo;

use DateTime;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use DevBoardLib\GithubCore\User\GithubUser;
use DevBoardLib\GithubCore\User\GithubUserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubRepoSourceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\Repo\GithubRepoSource');
        $this->shouldHaveType('DevBoardLib\GithubCore\Repo\GithubRepo');
    }

    public function let(
        GithubRepoId $id,
        GithubUser $ownerUser,
        $owner,
        $name,
        $fullName,
        $htmlUrl,
        $description,
        $fork,
        $defaultBranch,
        $githubPrivate,
        $gitUrl,
        $sshUrl,
        DateTime $githubCreatedAt,
        DateTime $githubUpdatedAt,
        DateTime $githubPushedAt
    ) {
        $this->beConstructedWith(
            $id,
            $ownerUser,
            $owner,
            $name,
            $fullName,
            $htmlUrl,
            $description,
            $fork,
            $defaultBranch,
            $githubPrivate,
            $gitUrl,
            $sshUrl,
            $githubCreatedAt,
            $githubUpdatedAt,
            $githubPushedAt
        );
    }

    public function it_exposes_all_constructor_params_via_getters(
        $id,
        $ownerUser,
        $owner,
        $name,
        $fullName,
        $htmlUrl,
        $description,
        $fork,
        $defaultBranch,
        $githubPrivate,
        $gitUrl,
        $sshUrl,
        $githubCreatedAt,
        $githubUpdatedAt,
        $githubPushedAt,
        GithubUserId $ownerUserId
    ) {
        $ownerUser->getGithubUserId()->willReturn($ownerUserId);

        $this->getId()->shouldReturn($id);
        $this->getOwnerUserId()->shouldReturn($ownerUserId);
        $this->getOwnerUser()->shouldReturn($ownerUser);
        $this->getOwner()->shouldReturn($owner);
        $this->getName()->shouldReturn($name);
        $this->getFullName()->shouldReturn($fullName);
        $this->getHtmlUrl()->shouldReturn($htmlUrl);
        $this->getDescription()->shouldReturn($description);
        $this->getFork()->shouldReturn($fork);
        $this->getDefaultBranch()->shouldReturn($defaultBranch);
        $this->getGithubPrivate()->shouldReturn($githubPrivate);
        $this->getGitUrl()->shouldReturn($gitUrl);
        $this->getSshUrl()->shouldReturn($sshUrl);
        $this->getGithubCreatedAt()->shouldReturn($githubCreatedAt);
        $this->getGithubUpdatedAt()->shouldReturn($githubUpdatedAt);
        $this->getGithubPushedAt()->shouldReturn($githubPushedAt);
    }
}

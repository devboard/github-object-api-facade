<?php
namespace spec\DevBoardLib\GithubObjectApiFacade\User;

use DevBoardLib\GithubCore\User\GithubUserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubUserSourceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\User\GithubUserSource');
        $this->shouldHaveType('DevBoardLib\GithubCore\User\GithubUser');
    }

    public function let(GithubUserId $githubUserId, $username, $email, $name, $avatarUrl)
    {
        $this->beConstructedWith($githubUserId, $username, $email, $name, $avatarUrl);
    }

    public function it_exposes_all_constructor_params_via_getters(
        $githubUserId,
        $username,
        $email,
        $name,
        $avatarUrl
    ) {
        $this->getGithubUserId()->shouldReturn($githubUserId);
        $this->getUsername()->shouldReturn($username);
        $this->getEmail()->shouldReturn($email);
        $this->getName()->shouldReturn($name);
        $this->getAvatarUrl()->shouldReturn($avatarUrl);
    }
}

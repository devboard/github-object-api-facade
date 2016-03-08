<?php

namespace spec\DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tests\DevBoardLib\GithubObjectApiFacade\SampleDataProvider;

class GithubRepoConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\Repo\Converter\GithubRepoConverter');
    }

    public function let()
    {
        $this->beConstructedWith();
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_returns_github_repo_source_as_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->shouldReturnAnInstanceOf('DevBoardLib\GithubCore\Repo\GithubRepoSource');
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_repo_id_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getId()->shouldReturnAnInstanceOf('DevBoardLib\GithubCore\Repo\GithubRepoId');
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_owner_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getOwnerUserId()->shouldReturnAnInstanceOf('DevBoardLib\GithubCore\User\GithubUserId');
        $result->getOwnerUser()->shouldReturnAnInstanceOf('DevBoardLib\GithubCore\User\GithubUserSource');
        $result->getOwner()->shouldReturn($arrayData['owner']['login']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_repo_name_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getName()->shouldReturn($arrayData['name']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_repo_full_name_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getFullName()->shouldReturn($arrayData['full_name']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_url_to_github_page_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getHtmlUrl()->shouldReturn($arrayData['html_url']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_repo_description_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getDescription()->shouldReturn($arrayData['description']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_if_repo_is_a_fork_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getFork()->shouldReturn($arrayData['fork']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_default_branch_name_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getDefaultBranch()->shouldReturn($arrayData['default_branch']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_if_repo_is_private_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getGithubPrivate()->shouldReturn($arrayData['private']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_git_clone_url_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getGitUrl()->shouldReturn($arrayData['git_url']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_hold_ssh_clone_url_in_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getSshUrl()->shouldReturn($arrayData['ssh_url']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_have_github_created_datetime_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubCreatedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubCreatedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['created_at']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_have_github_last_updated_datetime_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubUpdatedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubUpdatedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['updated_at']);
    }

    /**
     * @dataProvider provideRepoDetails
     */
    public function it_will_have_github_last_pushed_datetime_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubPushedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubPushedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['pushed_at']);
    }

    public function provideRepoDetails()
    {
        return [
            [$this->getDataProvider()->getRepoDetails()],
        ];
    }

    protected function getDataProvider()
    {
        return new SampleDataProvider();
    }
}

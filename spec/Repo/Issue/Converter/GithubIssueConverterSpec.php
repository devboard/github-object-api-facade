<?php

namespace spec\DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tests\DevBoardLib\GithubObjectApiFacade\JsonSampleDataProvider;

class GithubIssueConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\Issue\Converter\GithubIssueConverter');
    }

    public function let(GithubRepo $githubRepo, GithubRepoId $repoId)
    {
        $githubRepo->getId()->willReturn($repoId);
        $this->beConstructedWith($githubRepo);
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_returns_github_issue_source_as_result($arrayData)
    {
        $this->convert($arrayData)
            ->shouldReturnAnInstanceOf('DevBoardLib\GithubCore\Issue\GithubIssueSource');
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_repo_id_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        //@TODO: How to test repo & id? (injecting does not work :( )
        $result->getRepoId()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Repo\GithubRepoId');
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_repo_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        //@TODO: How to test repo & id? (injecting does not work :( )
        $result->getRepo()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Repo\GithubRepo');
    }

    //
    //
    //
    //

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_issue_state_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getState()->__toString()->shouldBe((string) $arrayData['state']);
        $result->getState()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Issue\State\GithubIssueState');
    }

    /**
     * @dataProvider provideOpenIssues
     */
    public function it_will_have_open_issue_state_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getState()->__toString()->shouldBe('open');
        $result->getState()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Issue\State\GithubIssueOpenState');
    }

    /**
     * @dataProvider provideClosedIssues
     */
    public function it_will_have_closed_issue_state_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getState()->__toString()->shouldBe('closed');
        $result->getState()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Issue\State\GithubIssueClosedState');
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_issue_title_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getTitle()->shouldBe((string) $arrayData['title']);
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_issue_description_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getBody()->shouldBe((string) $arrayData['body']);
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_user_id_of_creator_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getCreatedByUserId()
            ->shouldBeAnInstanceOf('DevBoardLib\GithubCore\User\GithubUserId');
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_creator_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getCreatedByUser()
            ->shouldBeAnInstanceOf('DevBoardLib\GithubCore\User\GithubUserSource');
    }

    /**
     * @dataProvider provideAssignedIssues
     */
    public function it_will_have_user_id_of_assigned_user_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getAssignedToUserId()
            ->shouldBeAnInstanceOf('DevBoardLib\GithubCore\User\GithubUserId');
    }

    /**
     * @dataProvider provideAssignedIssues
     */
    public function it_will_have_assigned_user_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getAssignedToUser()
            ->shouldBeAnInstanceOf('DevBoardLib\GithubCore\User\GithubUserSource');
    }

    /**
     * @dataProvider provideNonAssignedIssues
     */
    public function it_will_have_null_for_user_id_on_unassigned_user_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getAssignedToUserId()->shouldBe(null);
    }

    /**
     * @dataProvider provideNonAssignedIssues
     */
    public function it_will_have_null_for_user_on_unassigned_user_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getAssignedToUser()->shouldBe(null);
    }

    /**
     * @dataProvider provideMilestonedIssues
     */
    public function it_will_have_milestone_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getMilestoneId()
            ->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Milestone\GithubMilestoneId');
        $result->getMilestone()
            ->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Milestone\GithubMilestoneSource');
    }

    /**
     * @dataProvider provideNonMilestonedIssues
     */
    public function it_will_have_null_for_issue_without_milestone_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getMilestoneId()->shouldBe(null);
        $result->getMilestone()->shouldBe(null);
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_comment_count_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getCommentCount()->shouldBe($arrayData['comments']);
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_github_created_datetime_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubCreatedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubCreatedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['created_at']);
    }

    /**
     * @dataProvider provideAllIssues
     */
    public function it_will_have_github_last_updated_datetime_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubUpdatedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubUpdatedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['updated_at']);
    }

    /**
     * @dataProvider provideClosedIssues
     */
    public function it_will_have_github_closed_datetime_for_closed_milestones_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubClosedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubClosedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['closed_at']);
    }

    public function provideAllIssues()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllIssues() as $item) {
            $testData[] = [$item];
        }

        return $testData;
    }

    public function provideOpenIssues()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllIssues() as $item) {
            if ('open' === $item['state']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideClosedIssues()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllIssues() as $item) {
            if ('closed' === $item['state']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideAssignedIssues()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllIssues() as $item) {
            if (null !== $item['assignee']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideNonAssignedIssues()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllIssues() as $item) {
            if (null === $item['assignee']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideMilestonedIssues()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllIssues() as $item) {
            if (null !== $item['milestone']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideNonMilestonedIssues()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllIssues() as $item) {
            if (null === $item['milestone']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    protected function getDataProvider()
    {
        return new JsonSampleDataProvider();
    }
}

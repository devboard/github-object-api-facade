<?php
namespace spec\DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use DevBoardLib\GithubCore\Repo\GithubRepoId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tests\DevBoardLib\GithubObjectApiFacade\SampleDataProvider;

class GithubMilestoneConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubObjectApiFacade\Repo\Milestone\Converter\GithubMilestoneConverter');
    }

    public function let(GithubRepo $githubRepo, GithubRepoId $repoId)
    {
        $githubRepo->getId()->willReturn($repoId);
        $this->beConstructedWith($githubRepo);
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_returns_github_milestone_source_as_result($arrayData)
    {
        $this->convert($arrayData)
            ->shouldReturnAnInstanceOf('DevBoardLib\GithubCore\Milestone\GithubMilestoneSource');
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_milestone_id_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getId()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Milestone\GithubMilestoneId');
        $result->getId()->__toString()->shouldBe((string) $arrayData['id']);
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_repo_id_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        //@TODO: How to test repo & id? (injecting does not work :( )
        $result->getRepoId()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Repo\GithubRepoId');
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_repo_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        //@TODO: How to test repo & id? (injecting does not work :( )
        $result->getRepo()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Repo\GithubRepo');
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_milestone_number_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getNumber()->shouldBe($arrayData['number']);
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_milestone_state_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getState()->__toString()->shouldBe((string) $arrayData['state']);
        $result->getState()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Milestone\State\GithubMilestoneState');
    }

    /**
     * @dataProvider provideOpenMilestones
     */
    public function it_will_have_open_milestone_state_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getState()->__toString()->shouldBe('open');
        $result->getState()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Milestone\State\GithubMilestoneOpenState');
    }

    /**
     * @dataProvider provideClosedMilestones
     */
    public function it_will_have_closed_milestone_state_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getState()->__toString()->shouldBe('closed');
        $result->getState()->shouldBeAnInstanceOf('DevBoardLib\GithubCore\Milestone\State\GithubMilestoneClosedState');
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_milestone_title_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getTitle()->shouldBe((string) $arrayData['title']);
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_milestone_description_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getDescription()->shouldBe((string) $arrayData['description']);
    }

    /**
     * @dataProvider provideMilestonesWithCreator
     */
    public function it_will_have_user_id_of_creator_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getCreatedByUserId()
            ->shouldBeAnInstanceOf('DevBoardLib\GithubCore\User\GithubUserId');
    }

    /**
     * @dataProvider provideMilestonesWithCreator
     */
    public function it_will_have_creator_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getCreatedByUser()
            ->shouldBeAnInstanceOf('DevBoardLib\GithubCore\User\GithubUserSource');
    }


    /**
     * @dataProvider provideMilestonesWithOutCreator
     */
    public function it_will_have_null_for_user_id_of_creator_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getCreatedByUserId()->shouldReturn(null);
    }

    /**
     * @dataProvider provideMilestonesWithOutCreator
     */
    public function it_will_have_null_for_creator_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getCreatedByUser()->shouldReturn(null);
    }


    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_open_issue_count_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getOpenIssueCount()->shouldBe($arrayData['open_issues']);
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_closed_issue_count_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);
        $result->getClosedIssueCount()->shouldBe($arrayData['closed_issues']);
    }

    /**
     * @dataProvider provideMilestonesWithDueDate
     */
    public function it_will_have_due_date_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        if (null !== $arrayData['due_on']) {
            $result->getDueDate()->shouldBeAnInstanceOf('DateTime');
            $result->getDueDate()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['due_on']);
        }
    }

    /**
     * @dataProvider provideMilestonesWithOutDueDate
     */
    public function it_will_have_null_if_no_due_date_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        if (null === $arrayData['due_on']) {
            $result->getDueDate()->shouldBe(null);
        }
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_github_created_datetime_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubCreatedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubCreatedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['created_at']);
    }

    /**
     * @dataProvider provideAllMilestones
     */
    public function it_will_have_github_last_updated_datetime_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubUpdatedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubUpdatedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['updated_at']);
    }

    /**
     * @dataProvider provideClosedMilestones
     */
    public function it_will_have_github_closed_datetime_for_closed_milestones_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubClosedAt()->shouldBeAnInstanceOf('DateTime');
        $result->getGithubClosedAt()->format('Y-m-d\TH:i:s\Z')->shouldBe($arrayData['closed_at']);
    }

    /**
     * @dataProvider provideOpenMilestones
     */
    public function it_will_have_null_for_github_closed_datetime_on_open_milestones_in_converted_result($arrayData)
    {
        $result = $this->convert($arrayData);

        $result->getGithubClosedAt()->shouldBe(null);
    }

    public function provideAllMilestones()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllMilestones() as $item) {
            $testData[] = [$item];
        }

        return $testData;
    }

    public function provideOpenMilestones()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllMilestones() as $item) {
            if ('open' === $item['state']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideClosedMilestones()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllMilestones() as $item) {
            if ('closed' === $item['state']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideMilestonesWithDueDate()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllMilestones() as $item) {
            if (null !== $item['due_on']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideMilestonesWithOutDueDate()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllMilestones() as $item) {
            if (null === $item['due_on']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideMilestonesWithCreator()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllMilestones() as $item) {
            if (null !== $item['creator']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    public function provideMilestonesWithOutCreator()
    {
        $testData = [];

        foreach ($this->getDataProvider()->getAllMilestones() as $item) {
            if (null === $item['creator']) {
                $testData[] = [$item];
            }
        }

        return $testData;
    }

    protected function getDataProvider()
    {
        return new SampleDataProvider();
    }
}

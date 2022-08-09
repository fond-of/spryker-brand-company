<?php

namespace FondOfSpryker\Zed\BrandCompany\Communication\Plugin\BrandExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\BrandCompany\BrandCompanyConstants;
use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacade;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Brand\Persistence\Map\FosBrandTableMap;
use Orm\Zed\BrandCompany\Persistence\Map\FosBrandCompanyTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class CompanySearchBrandQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\SearchBrandQueryExpanderPluginInterface
     */
    protected $plugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterFieldTransfer
     */
    protected $filterFieldTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    protected $queryJoinCollectionTransfer;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface
     */
    protected $brandCompanyFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionTransfer = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCompanyFacadeMock = $this->getMockBuilder(BrandCompanyFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanySearchBrandQueryExpanderPlugin();
        $this->plugin->setFacade($this->brandCompanyFacadeMock);
    }

    /**
     * @return void
     */
    public function testIsApplicableWillReturnFalse(): void
    {
        $this->filterFieldTransferMock->expects($this->atLeastOnce())
            ->method('getType')
            ->willReturn('');

        $this->assertFalse(
            $this->plugin->isApplicable(
                [$this->filterFieldTransferMock],
            ),
        );
    }

    /**
     * @return void
     */
    public function testIsApplicableWillReturnTrue(): void
    {
        $this->filterFieldTransferMock->expects($this->atLeastOnce())
            ->method('getType')
            ->willReturn(BrandCompanyConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        $this->assertTrue(
            $this->plugin->isApplicable(
                [$this->filterFieldTransferMock],
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWillDoNothing(): void
    {
        $this->filterFieldTransferMock->expects($this->atLeastOnce())
            ->method('getType')
            ->willReturn('');

        $this->plugin->expand(
            [$this->filterFieldTransferMock],
            $this->queryJoinCollectionTransfer,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $self = $this;

        $this->filterFieldTransferMock->expects($this->atLeastOnce())
            ->method('getType')
            ->willReturn(BrandCompanyConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        $this->filterFieldTransferMock->expects($this->atLeastOnce())
            ->method('getValue')
            ->willReturn('value');

        $this->queryJoinCollectionTransfer->expects($this->atLeastOnce())
            ->method('addQueryJoin')
            ->willReturnCallback(static function (QueryJoinTransfer $queryJoinTransfer) use ($self) {
                $whereCondition = $queryJoinTransfer->getWhereConditions()->offsetGet(0);
                static::assertSame($whereCondition->getValue(), 'value');
                static::assertSame($whereCondition->getColumn(), FosBrandCompanyTableMap::COL_FK_COMPANY);
                static::assertSame($whereCondition->getComparison(), Criteria::EQUAL);

                static::assertSame($queryJoinTransfer->getJoinType(), Criteria::INNER_JOIN);
                static::assertSame($queryJoinTransfer->getLeft(), [FosBrandTableMap::COL_ID_BRAND]);
                static::assertSame($queryJoinTransfer->getRight(), [FosBrandCompanyTableMap::COL_FK_BRAND]);

                return $self->queryJoinCollectionTransfer;
            });

        $this->plugin->expand(
            [$this->filterFieldTransferMock],
            $this->queryJoinCollectionTransfer,
        );
    }
}

<?php

namespace FondOfSpryker\Zed\BrandCompany\Communication\Plugin\BrandExtension;

use Codeception\Test\Unit;
use Exception;
use FondOfSpryker\Shared\BrandCompany\BrandCompanyConstants;
use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacade;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Brand\Persistence\Map\FosBrandTableMap;
use Orm\Zed\BrandCompany\Persistence\Map\FosBrandCompanyTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class CompanyCustomerSearchBrandQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Communication\Plugin\BrandExtension\CompanyCustomerSearchBrandQueryExpanderPlugin
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

        $this->plugin = new CompanyCustomerSearchBrandQueryExpanderPlugin();
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
                [$this->filterFieldTransferMock]
            )
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
                [$this->filterFieldTransferMock]
            )
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
            $this->queryJoinCollectionTransfer
        );
    }

    /**
     * @throws \Exception
     *
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

                if ($queryJoinTransfer->getLeft() === [FosBrandTableMap::COL_ID_BRAND]) {
                    static::assertSame($queryJoinTransfer->getJoinType(), Criteria::INNER_JOIN);
                    static::assertSame($queryJoinTransfer->getLeft(), [FosBrandTableMap::COL_ID_BRAND]);
                    static::assertSame($queryJoinTransfer->getRight(), [FosBrandCompanyTableMap::COL_FK_BRAND]);
                } elseif ($queryJoinTransfer->getLeft() === [FosBrandCompanyTableMap::COL_FK_COMPANY]) {
                    static::assertSame($queryJoinTransfer->getJoinType(), Criteria::INNER_JOIN);
                    static::assertSame($queryJoinTransfer->getLeft(), [FosBrandCompanyTableMap::COL_FK_COMPANY]);
                    static::assertSame($queryJoinTransfer->getRight(), [SpyCompanyUserTableMap::COL_FK_COMPANY]);

                    static::assertSame($queryJoinTransfer->getWhereConditions()[0]->getValue(), 'value');
                    static::assertSame($queryJoinTransfer->getWhereConditions()[0]->getColumn(), SpyCompanyUserTableMap::COL_FK_CUSTOMER);
                    static::assertSame($queryJoinTransfer->getWhereConditions()[0]->getComparison(), Criteria::EQUAL);
                } else {
                    throw new Exception('fail test');
                }

                return $self->queryJoinCollectionTransfer;
            });

        $this->plugin->expand(
            [$this->filterFieldTransferMock],
            $this->queryJoinCollectionTransfer
        );
    }
}

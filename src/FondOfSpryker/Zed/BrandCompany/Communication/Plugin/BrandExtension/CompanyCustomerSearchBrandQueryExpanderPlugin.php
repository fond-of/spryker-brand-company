<?php

namespace FondOfSpryker\Zed\BrandCompany\Communication\Plugin\BrandExtension;

use ArrayObject;
use FondOfSpryker\Shared\BrandCompany\BrandCompanyConstants;
use FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\SearchBrandQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Brand\Persistence\Map\FosBrandTableMap;
use Orm\Zed\BrandCompany\Persistence\Map\FosBrandCompanyTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface getFacade()
 */
class CompanyCustomerSearchBrandQueryExpanderPlugin extends AbstractPlugin implements SearchBrandQueryExpanderPluginInterface
{
    /**
     * Specification:
     * - Returns true if plugin is applicable for given filters.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return bool
     */
    public function isApplicable(array $filterFieldTransfers): bool
    {
        foreach ($filterFieldTransfers as $fieldTransfer) {
            if ($fieldTransfer->getType() === BrandCompanyConstants::FILTER_FIELD_TYPE_ID_CUSTOMER) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expand(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer {
        $filterFieldTransfer = null;

        foreach ($filterFieldTransfers as $currentFilterFieldTransfer) {
            if ($currentFilterFieldTransfer->getType() === BrandCompanyConstants::FILTER_FIELD_TYPE_ID_CUSTOMER) {
                $filterFieldTransfer = $currentFilterFieldTransfer;

                break;
            }
        }

        if ($filterFieldTransfer === null || $filterFieldTransfer->getValue() === null) {
            return $queryJoinCollectionTransfer;
        }

        $whereConditions = [
            (new QueryWhereConditionTransfer())
                ->setValue($filterFieldTransfer->getValue())
                ->setColumn(SpyCompanyUserTableMap::COL_FK_CUSTOMER)
                ->setComparison(Criteria::EQUAL),
        ];

        $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([FosBrandTableMap::COL_ID_BRAND])
                ->setRight([FosBrandCompanyTableMap::COL_FK_BRAND])
        );

        $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([FosBrandCompanyTableMap::COL_FK_COMPANY])
                ->setRight([SpyCompanyUserTableMap::COL_FK_COMPANY])
                ->setWhereConditions(new ArrayObject($whereConditions))
        );

        return $queryJoinCollectionTransfer;
    }
}

<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyBusinessFactory getFactory()
 */
class BrandCompanyBusinessFacade extends AbstractFacade implements BrandCompanyBusinessFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     */
    public function saveCompanyBrandRelation(CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void
    {
        return $this->getFactory()->createCompanyBrandRelationWriter()
            ->saveCompanyBrandRelation($companyBrandRelationTransfer);
    }
}

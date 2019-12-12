<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepositoryInterface getRepository()
 */
class BrandCompanyFacade extends AbstractFacade implements BrandCompanyFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     *
     * @return void
     */
    public function saveCompanyBrandRelation(?CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void
    {
        $this->getFactory()->createBrandCompanyRelationWriter()
            ->saveCompanyBrandRelation($companyBrandRelationTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function getCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer {
        return $this->getFactory()->createBrandCompanyRelationReader()
            ->getCompanyBrandRelation($companyBrandRelationTransfer);
    }
}

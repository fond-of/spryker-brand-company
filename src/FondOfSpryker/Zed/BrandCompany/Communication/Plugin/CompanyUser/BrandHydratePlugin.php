<?php

namespace FondOfSpryker\Zed\BrandCompany\Communication\Plugin\CompanyUser;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserHydrationPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface getFacade()
 */
class BrandHydratePlugin extends AbstractPlugin implements CompanyUserHydrationPluginInterface
{
    /**
     * Specification:
     * - Hydrates a company user fields
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function hydrate(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer
    {
        $companyTransfer = $companyUserTransfer->getCompany();

        if ($companyTransfer === null) {
            return $companyUserTransfer;
        }

        $companyBrandRelationTransfer = new CompanyBrandRelationTransfer();
        $companyBrandRelationTransfer->setIdCompany($companyTransfer->getIdCompany());

        $companyTransfer->setBrandRelation($this->getFacade()->getCompanyBrandRelation($companyBrandRelationTransfer));

        return $companyUserTransfer;
    }
}

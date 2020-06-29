<?php

namespace FondOfSpryker\Zed\BrandCompany\Communication\Plugin\Company;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Spryker\Zed\CompanyExtension\Dependency\Plugin\CompanyPostSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface getFacade()
 */
class CompanyBrandRelationPostSavePlugin extends AbstractPlugin implements CompanyPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after company object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyResponseTransfer $companyResponseTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer
     */
    public function postSave(CompanyResponseTransfer $companyResponseTransfer): CompanyResponseTransfer
    {
        $companyTransfer = $companyResponseTransfer->getCompanyTransfer();

        if ($companyTransfer === null || $companyTransfer->getBrandRelation() === null) {
            return $companyResponseTransfer;
        }

        $this->getFacade()->saveCompanyBrandRelation($companyTransfer->getBrandRelation());

        return $companyResponseTransfer;
    }
}

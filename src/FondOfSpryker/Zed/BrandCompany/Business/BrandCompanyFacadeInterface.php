<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface BrandCompanyFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function getCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     *
     * @return void
     */
    public function saveCompanyBrandRelation(?CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void;
}

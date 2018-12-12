<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface BrandCompanyBusinessFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     */
    public function saveCompanyBrandRelation(?CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void;
}

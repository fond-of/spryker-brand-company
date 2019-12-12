<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface BrandCompanyFacadeInterface
{
    /**
     * Specification:
     *  - Retrieves Company Brand relations
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function getCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer;

    /**
     * Specification:
     *  - Save company Brand relations
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     *
     * @return void
     */
    public function saveCompanyBrandRelation(?CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void;
}

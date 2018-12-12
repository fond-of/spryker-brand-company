<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface CompanyBrandRelationWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     *
     * @return void
     */
    public function saveCompanyBrandRelation(?CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void;
}

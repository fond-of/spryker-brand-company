<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\Model;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface BrandCompanyRelationReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function getCompanyBrandRelation(CompanyBrandRelationTransfer $companyBrandRelationTransfer): CompanyBrandRelationTransfer;
}

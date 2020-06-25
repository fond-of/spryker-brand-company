<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
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
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function saveCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer;

    /**
     * Specification:
     * - Finds companies by brand.
     * - Expands brand transfer with BrandCompanyRelationTransfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function expandBrandTransferWithCompanyRelation(BrandTransfer $brandTransfer): BrandTransfer;

    /**
     * Specification:
     * - Save Brand Company relation using BrandTransfer.
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function saveBrandCompanyRelation(BrandTransfer $brandTransfer): BrandTransfer;

    /**
     * Specification:
     * - Delete Brand Company relation using BrandTransfer.
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function deleteBrandCompanyRelation(BrandTransfer $brandTransfer): BrandResponseTransfer;

    /**
     * Specification:
     * - find Company Brand relations using the company id
     *
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function findCompanyBrandRelationByIdCompany(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer;
}

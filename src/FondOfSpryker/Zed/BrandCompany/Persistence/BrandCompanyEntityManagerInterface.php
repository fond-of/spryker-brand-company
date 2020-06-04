<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use Generated\Shared\Transfer\BrandTransfer;

interface BrandCompanyEntityManagerInterface
{
    /**
     * Specification:
     * - Adds new relations between brands and company
     *
     * @param array $idBrands
     * @param int $idCompany
     *
     * @return void
     */
    public function addBrands(array $idBrands, $idCompany): void;

    /**
     * Specification:
     * - Remove relations between brands and company
     *
     * @param array $idBrands
     * @param int $idCompany
     *
     * @return void
     */
    public function removeBrands(array $idBrands, $idCompany): void;

    /**
     * @param int $idBrand
     * @param int[] $companyIds
     *
     * @return void
     */
    public function addCompanyRelations(int $idBrand, array $companyIds): void;

    /**
     * @param int $idBrand
     * @param int[] $companyIds
     *
     * @return void
     */
    public function removeCompanyRelations(int $idBrand, array $companyIds): void;

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return void
     */
    public function deleteBrandCompanyRelation(BrandTransfer $brandTransfer): void;
}

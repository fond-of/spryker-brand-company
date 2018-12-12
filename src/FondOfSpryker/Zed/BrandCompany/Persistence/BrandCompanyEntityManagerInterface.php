<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

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
}

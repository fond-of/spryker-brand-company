<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use ArrayObject;

interface BrandCompanyRepositoryInterface
{
    /**
     * Specification:
     * - Retrieve brands related to company
     *
     * @param int $idCompany
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\BrandTransfer>
     */
    public function getRelatedBrandsByIdCompany(int $idCompany): ArrayObject;

    /**
     * @param int $idBrand
     *
     * @return array<int>
     */
    public function getRelatedCompanyIdsByIdBrand(int $idBrand): array;
}

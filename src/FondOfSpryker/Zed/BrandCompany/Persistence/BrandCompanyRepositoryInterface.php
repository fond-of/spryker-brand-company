<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

interface BrandCompanyRepositoryInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\BrandTransfer[]
     */
    public function getRelatedBrandsByCompanyId(int $idCompany): array;
}

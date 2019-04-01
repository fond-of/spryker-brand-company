<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use ArrayObject;

interface BrandCompanyRepositoryInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\BrandTransfer[]|\ArrayObject
     */
    public function getRelatedBrandsByCompanyId(int $idCompany): ArrayObject;
}

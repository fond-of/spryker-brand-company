<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyPersistenceFactory getFactory()
 */
class BrandCompanyRepository extends AbstractRepository implements BrandCompanyRepositoryInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\BrandTransfer[]
     */
    public function getRelatedBrandsByCompanyId(int $idCompany): array
    {
        $companyBrandEntities = $this->getFactory()
            ->createBrandCompanyQuery()
            ->filterByFkCompany($idCompany)
            ->find();

        $relatedBrands = [];

        foreach ($companyBrandEntities as $companyBrandEntity) {
            $brandTransfer = new BrandTransfer();
            $brandTransfer->setIdBrand($companyBrandEntity->getFkBrand());
            $relatedBrands[] = $brandTransfer;
        }

        return $relatedBrands;
    }
}

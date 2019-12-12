<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyPersistenceFactory getFactory()
 */
class BrandCompanyRepository extends AbstractRepository implements BrandCompanyRepositoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @param int $idCompany
     *
     * @throws
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\BrandTransfer[]
     */
    public function getRelatedBrandsByIdCompany(int $idCompany): ArrayObject
    {
        $brandCompanyEntities = $this->getFactory()
            ->createBrandCompanyQuery()
            ->filterByFkCompany($idCompany)
            ->find();

        $relatedBrands = new ArrayObject();

        foreach ($brandCompanyEntities as $brandCompanyEntity) {
            $brandEntityTransfer = $brandCompanyEntity->getFosBrand();

            $brandTransfer = new BrandTransfer();
            $brandTransfer->fromArray($brandEntityTransfer->toArray(), true);

            $relatedBrands->append($brandTransfer);
        }

        return $relatedBrands;
    }
}

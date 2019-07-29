<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use Orm\Zed\BrandCompany\Persistence\FosBrandCompany;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyPersistenceFactory getFactory()
 */
class BrandCompanyEntityManager extends AbstractEntityManager implements BrandCompanyEntityManagerInterface
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
    public function addBrands(array $idBrands, $idCompany): void
    {
        foreach ($idBrands as $idBrand) {
            $companyBrandEntityTransfer = new FosBrandCompany();
            $companyBrandEntityTransfer->setFkCompany($idCompany)
                ->setFkBrand($idBrand)
                ->save();
        }
    }

    /**
     * Specification:
     * - Remove relations between brands and company
     *
     * @param array $idBrands
     * @param int $idCompany
     *
     * @return void
     */
    public function removeBrands(array $idBrands, $idCompany): void
    {
        if (count($idBrands) === 0) {
            return;
        }

        $this->getFactory()
            ->createBrandCompanyQuery()
            ->filterByFkCompany($idCompany)
            ->filterByFkBrand_In($idBrands)
            ->delete();
    }
}

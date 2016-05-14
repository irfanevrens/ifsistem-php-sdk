<?php namespace SistemApi\Model\Ayar\Urun;

use SistemApi\Model\Ayar\Base\ListeAyar;

class OzellikGrupListeAyar extends ListeAyar
{
    /**
     * @var int
     */
    private $kategoriIds;

    /**
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'kategoriIds' => $this->kategoriIds
        ]);
    }

    /**
     * @return OzellikGrupListeAyar
     */
    public function setOrderByAdi()
    {
        return $this->setOrderBy('adi');
    }

    /**
     * @param int $kategoriId
     * @return $this
     */
    public function addKategoriId($kategoriId)
    {
        $this->kategoriIds[] = $kategoriId;
        return $this;
    }

    /**
     * @param int $kategoriIds
     * @return OzellikGrupListeAyar
     */
    public function setKategoriIds($kategoriIds)
    {
        $this->kategoriIds = $kategoriIds;
        return $this;
    }

    /**
     * @return int
     */
    public function getKategoriIds()
    {
        return $this->kategoriIds;
    }
}
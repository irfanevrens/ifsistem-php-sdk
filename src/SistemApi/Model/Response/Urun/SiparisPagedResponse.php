<?php namespace SistemApi\Model\Response\Urun;

use SistemApi\Model\Response\Base\PagedResponse;
use SistemApi\Model\Siparis;

/**
 * @deprecated use SiparisPagedResponse
 */
class SiparisPagedResponse extends PagedResponse
{
    /**
     * @param \stdClass $item
     */
    public function __construct($item)
    {
        parent::__construct($item, Siparis::class);
    }

    /**
     * @return Siparis[]
     */
    public function getSiparisler()
    {
        return $this->kayitlar;
    }
}
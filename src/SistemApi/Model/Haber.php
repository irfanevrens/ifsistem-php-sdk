<?php namespace SistemApi\Model;

class Haber
{
    public $id;
    public $baslik;
    public $rbaslik;
    public $ozet;
    public $icerik;
    public $hit;
    public $site_id;
    public $durum;
    public $haber_lokasyonu;
    public $haber_zamani;
    public $is_haber_saati_gosterilsin;
    public $is_resimli;
    public $uzanti;
    public $hash;
    public $created_at;
    public $updated_at;

    /**
     * @var Kategori
     */
    public $kategori;

    /**
     * @param \stdClass $item
     */
    public function __construct($item)
    {
        $this->id = $item->id;
        $this->baslik = $item->baslik;
        $this->rbaslik = $item->rbaslik;
        $this->ozet = $item->ozet;
        $this->icerik = $item->icerik;
        $this->hit = $item->hit;
        $this->site_id = $item->site_id;
        $this->durum = $item->durum;
        $this->haber_lokasyonu = $item->haber_lokasyonu;
        $this->haber_zamani = $item->haber_zamani;
        $this->is_haber_saati_gosterilsin = $item->is_haber_saati_gosterilsin;
        $this->is_resimli = $item->is_resimli;
        $this->uzanti = $item->uzanti;
        $this->hash = $item->hash;
        $this->created_at = $item->created_at;
        $this->updated_at = $item->updated_at;

        if (isset($item->kategori) && ! empty($item->kategori)) {

            $this->kategori = new Kategori($item->kategori);
        }
    }

    public function getResimAdi()
    {
        return sprintf('%d-%s.%s', $this->id, $this->hash, $this->uzanti);
    }

    /**
     * TPL
     *
     * @return string
     */
    public function getOrjinalResimSrc()
    {
        return 'http://siteder1.s3-website-eu-west-1.amazonaws.com/public_site/hbr_haber_resim/orjinal/' . $this->getResimAdi();
    }

    /**
     * TPL
     *
     * @return string
     */
    public function getDetayResimSrc()
    {
        return 'http://siteder1.s3-website-eu-west-1.amazonaws.com/public_site/hbr_haber_resim/detay/' . $this->getResimAdi();
    }

    /**
     * TPL
     *
     * @return string
     */
    public function getKucukResimSrc()
    {
        return 'http://siteder1.s3-website-eu-west-1.amazonaws.com/public_site/hbr_haber_resim/kucuk/' . $this->getResimAdi();
    }
}
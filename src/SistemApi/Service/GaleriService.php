<?php namespace SistemApi\Service;

use SistemApi\Exception\NotFoundException;
use SistemApi\Exception\UnauthorizedException;
use SistemApi\Exception\UnknownException;
use SistemApi\Model\Ayar\GaleriIcerikListeAyar;
use SistemApi\Model\Ayar\GaleriListeAyar;
use SistemApi\Model\Galeri;
use SistemApi\Model\GaleriIcerik;
use SistemApi\Model\Haber;
use SistemApi\Model\Response\GaleriIcerikPagedResponse;
use SistemApi\Model\Response\GaleriPagedResponse;

class GaleriService
{
    /**
     * @Inject
     * @var ApiService
     */
    private $api;

    /**
     * @param int $id
     * @return Galeri
     *
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function getById($id)
    {
        // response alalım
        $response = $this->api->get('/galeri/detay-by-id/' . $id);

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new Galeri($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 404: throw new NotFoundException($response->body->mesaj);
        }

        throw new UnknownException($response);
    }

    /**
     * @param int $adet
     * @return GaleriIcerik[]
     *
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function getListeSonEklenenler($adet = 4)
    {
        // response alalım
        $response = $this->api->get('/galeri/resim/liste-son-eklenenler/' . $adet);

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200:

                return array_map(function($item) {
                    return new GaleriIcerik($item);
                }, $response->body);

            case 401: throw new UnauthorizedException($response->body->mesaj);
        }

        throw new UnknownException($response);
    }

    /**
     * @param int $galeriId
     * @param GaleriIcerikListeAyar $galeriIcerikListeAyar
     * @return GaleriIcerikPagedResponse
     *
     * @throws UnauthorizedException
     * @throws UnknownException
     */
    public function getIcerikListeByGaleriId($galeriId, GaleriIcerikListeAyar $galeriIcerikListeAyar = null)
    {
        // response alalım
        $response = $this->api->get('/galeri/icerik/liste/' . $galeriId, is_null($galeriIcerikListeAyar) ? [] : $galeriIcerikListeAyar->toArray());

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new GaleriIcerikPagedResponse($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
        }

        throw new UnknownException($response);
    }

    /**
     * @param GaleriListeAyar $galeriListeAyar
     * @return GaleriPagedResponse
     *
     * @throws UnauthorizedException
     * @throws UnknownException
     */
    public function getListe(GaleriListeAyar $galeriListeAyar = null)
    {
        // response alalım
        $response = $this->api->get('/galeri/liste', is_null($galeriListeAyar) ? [] : $galeriListeAyar->toArray());

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new GaleriPagedResponse($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
        }

        throw new UnknownException($response);
    }
}
<?php namespace SistemApi\Service;

use SistemApi\Exception\BadRequestException;
use SistemApi\Exception\InternalApiErrorException;
use SistemApi\Exception\NotFoundException;
use SistemApi\Exception\UnauthorizedException;
use SistemApi\Exception\UnknownException;
use SistemApi\Model\Ayar\EmlakDanismanListeAyar;
use SistemApi\Model\Ayar\EmlakIlanListeAyar;
use SistemApi\Model\EmlakDanisman;
use SistemApi\Model\EmlakIlan;
use SistemApi\Model\EmlakKategori;
use SistemApi\Model\EmlakTip;
use SistemApi\Model\EmlakTur;
use SistemApi\Model\Response\EmlakDanismanPagedResponse;
use SistemApi\Model\Response\EmlakIlanPagedResponse;

class EmlakService
{
    /**
     * @Inject
     * @var ApiService
     */
    private $api;

    /**
     * @deprecated use listeTip
     *
     * @return EmlakTip[]
     * @throws UnauthorizedException
     */
    public function getListeTipler()
    {
        // response alalım
        $response = $this->api->get('/emlak/tip-liste');

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200:

                return array_map(function($item) {
                    return new EmlakTip($item);
                }, $response->body);

            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @deprecated use listeTur
     *
     * @return EmlakTur[]
     * @throws UnauthorizedException
     */
    public function getListeTurler()
    {
        // response alalım
        $response = $this->api->get('/emlak/tur-liste');

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200:

                return array_map(function($item) {
                    return new EmlakTur($item);
                }, $response->body);

            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);

    }

    /**
     * @return EmlakTip[]
     * @throws UnauthorizedException
     */
    public function listeTip()
    {
        // response alalım
        $response = $this->api->get('/emlak/tip/liste');

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200:

                return array_map(function($item) {
                    return new EmlakTip($item);
                }, $response->body);

            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @return EmlakTur[]
     * @throws UnauthorizedException
     */
    public function listeTur()
    {
        // response alalım
        $response = $this->api->get('/emlak/tur/liste');

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200:

                return array_map(function($item) {
                    return new EmlakTur($item);
                }, $response->body);

            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);

    }

    /**
     * @deprecated use listeKategori
     *
     * @return EmlakKategori[]
     * @throws UnauthorizedException
     */
    public function getListeKategoriler()
    {
        // response alalım
        $response = $this->api->get('/emlak/kategori-liste');

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200:

                return array_map(function($item) {
                    return new EmlakKategori($item);
                }, $response->body);

            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @return EmlakKategori[]
     * @throws UnauthorizedException
     */
    public function listeKategori()
    {
        // response alalım
        $response = $this->api->get('/emlak/kategori/liste');

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200:

                return array_map(function($item) {
                    return new EmlakKategori($item);
                }, $response->body);

            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @deprecated use listeDanisman
     *
     * @return EmlakDanisman[]
     *
     * @throws UnauthorizedException
     */
    public function getListeDanismanlar()
    {
        // response alalım
        $response = $this->api->get('/emlak/danisman-liste');

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200:

                return array_map(function($item) {
                    return new EmlakDanisman($item);
                }, $response->body);

            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @deprecated listeIlan
     *
     * @param EmlakIlanListeAyar $emlakIlanListeAyar
     * @return EmlakIlanPagedResponse
     *
     * @throws UnauthorizedException
     * @throws UnknownException
     */
    public function getListeIlanlar(EmlakIlanListeAyar $emlakIlanListeAyar = null)
    {
        // response alalım
        $response = $this->api->get('/emlak/ilan-liste', is_null($emlakIlanListeAyar) ? [] : $emlakIlanListeAyar->toArray());

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new EmlakIlanPagedResponse($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @param EmlakIlanListeAyar $ayar
     * @return EmlakIlanPagedResponse
     *
     * @throws UnauthorizedException
     * @throws UnknownException
     */
    public function listeIlan(EmlakIlanListeAyar $ayar = null)
    {
        // response alalım
        $response = $this->api->get('/emlak/ilan/liste', is_null($ayar) ? [] : $ayar->toArray());

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new EmlakIlanPagedResponse($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @deprecated use listeIlan
     *
     * @param EmlakIlanListeAyar $ayar
     * @return int
     *
     * @throws UnauthorizedException
     * @throws UnknownException
     */
    public function getAdetIlanlar(EmlakIlanListeAyar $ayar = null)
    {
        // response alalım
        $response = $this->api->get('/emlak/ilan-adet', is_null($ayar) ? [] : $ayar->toArray());

        // durum koduna göre işlem yapalım
        switch ($response->code) {
            case 200: return $response->body;
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @deprecated use getIlan
     *
     * @param int $id
     * @return EmlakIlan
     *
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function getIlanDetay($id)
    {
        // response alalım
        $response = $this->api->get('/emlak/ilan-detay/' . $id);

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new EmlakIlan($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 404: throw new NotFoundException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @param int $id
     * @return EmlakIlan
     *
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function getIlan($id)
    {
        // response alalım
        $response = $this->api->get('/emlak/ilan/detay/' . $id);

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new EmlakIlan($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 404: throw new NotFoundException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @param EmlakDanismanListeAyar $ayar
     * @return EmlakDanismanPagedResponse
     *
     * @throws UnauthorizedException
     * @throws UnknownException
     */
    public function listeDanisman($ayar = null)
    {
        // response alalım
        $response = $this->api->get('/emlak/danisman/liste', empty($ayar) ? [] : $ayar->toArray());

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new EmlakDanismanPagedResponse($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @param int $id
     * @return EmlakDanisman
     *
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function getDanisman($id)
    {
        // response alalım
        $response = $this->api->get('/emlak/danisman/detay/' . $id);

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new EmlakDanisman($response->body);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 404: throw new NotFoundException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @param array $data
     * @param string $resim
     * @return EmlakDanisman
     *
     * @throws BadRequestException
     * @throws UnauthorizedException
     * @throws UnknownException
     */
    public function ekleDanisman($data, $resim)
    {
        // response alalım
        $response = $this->api->post('/emlak/danisman/ekle', $data, [
            'resim' => $resim
        ]);

        // durum koduna göre işlem yapalım
        switch ($response->code) {
            case 200: return new EmlakDanisman($response->body);
            case 400: throw new BadRequestException($response);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @param int $id
     * @param array $data
     * @return EmlakDanisman
     *
     * @throws BadRequestException
     * @throws UnauthorizedException
     * @throws NotFoundException
     * @throws UnknownException
     */
    public function guncelleDanisman($id, $data)
    {
        // response alalım
        $response = $this->api->post('/emlak/danisman/guncelle/' . $id, $data);

        // durum koduna göre işlem yapalım
        switch ($response->code) {
            case 200: return new EmlakDanisman($response->body);
            case 400: throw new BadRequestException($response);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 404: throw new NotFoundException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }

    /**
     * @param int $id
     * @return EmlakDanisman
     *
     * @throws BadRequestException
     * @throws UnauthorizedException
     * @throws NotFoundException
     * @throws UnknownException
     */
    public function silDanisman($id)
    {
        // response alalım
        $response = $this->api->get('/emlak/danisman/sil/' . $id);

        // durum koduna göre işlem yapalım
        switch ($response->code) {

            case 200: return new EmlakDanisman($response->body);
            case 400: throw new BadRequestException($response);
            case 401: throw new UnauthorizedException($response->body->mesaj);
            case 404: throw new NotFoundException($response->body->mesaj);
            case 500: throw new InternalApiErrorException($response);
        }

        throw new UnknownException($response);
    }
}
<?php

namespace bupy7\telize;

use Yii;
use yii\base\Component;
use yii\helpers\Json;

/**
 * Wrapper of service offers a REST API allowing to get a visitor IP address and to query location information 
 * from any IP address.
 * @see http://www.telize.com/
 * @author Vasilij Belosludcev http://mihaly4.ru
 * @since 1.0.0
 */
class GeoIP extends Component
{
    /**
     * URL of method for get information by the IP address.
     */ 
    const METHOD_URL = 'http://www.telize.com/geoip/';

    /**
     * Returned information by IP address with following paramters:
     * - `ip`               - Visitor IP address, or IP address specified as parameter.
     * - `country_code`     - Two-letter ISO 3166-1 alpha-2 country code.
     * - `country_code3`    - Three-letter ISO 3166-1 alpha-3 country code.
     * - `country`          - Name of the country.
     * - `region_code`      - Two-letter ISO-3166-2 state / region code.
     * - `region`           - Name of the region.
     * - `city`             - Name of the city.
     * - `postal_code`      - Postal code / Zip code.
     * - `continent_code`   - Two-letter continent code.
     * - `latitude`         - Latitude.
     * - `longitude`        - Longitude.
     * - `dma_code`         - DMA Code.
     * - `area_code`        - Area Code.
     * - `asn`              - Autonomous System Number.
     * - `isp`              - Internet service provider.
     * - `timezone`         - Time Zone.
     * 
     * @param string $ip IP address of visitor.
     * @return mixed
     */
    public function getInfo($ip = null)
    {
        if ($ip === null) {
            $ip = Yii::$app->request->userIP;
        }
        return Json::decode(file_get_contents(self::METHOD_URL . $ip));
    }
}


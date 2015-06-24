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
class GeoIp extends Component
{
    /**
     * URL of API methods.
     */ 
    const URL_API = 'http://www.telize.com/';
    
    /**
     * @var boolean Whether set `true` then IP address of visitor will be get via API. 
     * Else, via \yii\web\Request::$userIP.
     */
    public $useApi = false;

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
     * @param string $ip IP address of visitor. If not set will be uses current IP address.
     * @return object|false
     */
    public function getInfo($ip = null)
    {
        if ($ip === null) {
            if (!$this->useApi) {
                $ip = Yii::$app->request->userIP;
            }
        }
        $result = Json::decode(file_get_contents(self::URL_API . 'geoip/' . $ip));
        if ($result === null) {
            return false;
        }
        return $result;
    }
    
    /**
     * Returned IP address of visitor if successful.
     * @return string|false
     */
    public function getIp()
    {
        $ip = Json::decode(file_get_contents(self::URL_API . 'jsonip'));
        if (!isset($ip['ip']) || empty($ip['ip'])) {
            return false;
        }
        return $ip['ip'];
    }
}


<?php

/**
 * Created by PhpStorm.
 * User: Denis Zhadan
 * Date: 02.12.2016
 * Time: 10:24
 */
class IBAN
{
    private static $fields = [
        //k = represent the IBAN checksum
        //b = National bank code
        //c = Account number
        'AD' => 'ADkk bbbb ssss cccc cccc cccc',
        'AE' => 'AEkk bbbc cccc cccc cccc ccc',
        'AL' => 'ALkk bbbs sssx cccc cccc cccc cccc',
        'AT' => 'ATkk bbbb bccc cccc cccc',
        'AZ' => 'AZkk bbbb cccc cccc cccc cccc cccc',
        'BA' => 'BAkk bbbs sscc cccc ccxx',
        'BE' => 'BEkk bbbc cccc ccxx',
        'BG' => 'BGkk bbbb ssss ttcc cccc cc',
        'BH' => 'BHkk bbbb cccc cccc cccc cc',
        'BR' => 'BRkk bbbb bbbb ssss sccc cccc ccct n',
        'CH' => 'CHkk bbbb bccc cccc cccc c',
        'CR' => 'CRkk bbbb cccc cccc cccc cc',
        'CY' => 'CYkk bbbs ssss cccc cccc cccc cccc',
        'CZ' => 'CZkk bbbb ssss sscc cccc cccc',
        'DE' => 'DEkk bbbb bbbb cccc cccc cc',
        'DK' => 'DKkk bbbb cccc cccc cc',
        'DO' => 'DOkk bbbb cccc cccc cccc cccc cccc',
        'EE' => 'EEkk bbss cccc cccc cccx',
        'ES' => 'ESkk bbbb ssss xxcc cccc cccc',
        'FI' => 'FIkk bbbb bbcc cccc cx',
        'FO' => 'FOkk bbbb cccc cccc cx',
        'FR' => 'FRkk bbbb bsss sscc cccc cccc cxx',
        'GB' => 'GBkk bbbb ssss sscc cccc cc',
        'GE' => 'GEkk bbcc cccc cccc cccc cc',
        'GI' => 'GIkk bbbb cccc cccc cccc ccc',
        'GL' => 'GLkk bbbb cccc cccc cc',
        'GR' => 'GRkk bbbs sssc cccc cccc cccc ccc',
        'GT' => 'GTkk bbbb mmtt cccc cccc cccc cccc',
        'HR' => 'HRkk bbbb bbbc cccc cccc c',
        'HU' => 'HUkk bbbs sssk cccc cccc cccc cccx',
        'IE' => 'IEkk aaaa bbbb bbcc cccc cc',
        'IL' => 'ILkk bbbn nncc cccc cccc ccc',
        'IS' => 'ISkk bbbb sscc cccc iiii iiii ii',
        'IT' => 'ITkk xbbb bbss sssc cccc cccc ccc',
        'JO' => 'JOkk bbbb ssss cccc cccc cccc cccc cc',
        'KW' => 'KWkk bbbb cccc cccc cccc cccc cccc cc',
        'KZ' => 'KZkk bbbc cccc cccc cccc',
        'LB' => 'LBkk bbbb cccc cccc cccc cccc cccc',
        'LI' => 'LIkk bbbb bccc cccc cccc c',
        'LT' => 'LTkk bbbb bccc cccc cccc',
        'LU' => 'LUkk bbbc cccc cccc cccc',
        'LV' => 'LVkk bbbb cccc cccc cccc c',
        'MC' => 'MCkk bbbb bsss sscc cccc cccc cxx',
        'MD' => 'MDkk bbcc cccc cccc cccc cccc',
        'ME' => 'MEkk bbbc cccc cccc cccc xx',
        'MK' => 'MKkk bbbc cccc cccc cxx',
        'MR' => 'MRkk bbbb bsss sscc cccc cccc cxx',
        'MT' => 'MTkk bbbb ssss sccc cccc cccc cccc ccc',
        'MU' => 'MUkk bbbb bbss cccc cccc cccc 000m mm',
        'NL' => 'NLkk bbbb cccc cccc cc',
        'NO' => 'NOkk bbbb cccc ccx',
        'PK' => 'PKkk bbbb cccc cccc cccc cccc',
        'PL' => 'PLkk bbbs sssx cccc cccc cccc cccc',
        'PS' => 'PSkk bbbb xxxx xxxx xccc cccc cccc c',
        'PT' => 'PTkk bbbb ssss cccc cccc cccx x',
        'QA' => 'QAkk bbbb cccc cccc cccc cccc cccc c',
        'RO' => 'ROkk bbbb cccc cccc cccc cccc',
        'RS' => 'RSkk bbbc cccc cccc cccc xx',
        'SA' => 'SAkk bbcc cccc cccc cccc cccc',
        'SE' => 'SEkk bbbc cccc cccc cccc cccc',
        'SI' => 'SIkk bbss sccc cccc cxx',
        'SK' => 'SKkk bbbb ssss sscc cccc cccc',
        'SM' => 'SMkk xbbb bbss sssc cccc cccc ccc',
        'TL' => 'TLkk bbbc cccc cccc cccc cxx',
        'TN' => 'TNkk bbss sccc cccc cccc cccc',
        'TR' => 'TRkk bbbb bxcc cccc cccc cccc cc',
        'VG' => 'VGkk bbbb cccc cccc cccc cccc',
        'XK' => 'XKkk bbbb cccc cccc cccc',
    ];

    /**
     * @param $country_code
     * @return bool|int
     */
    private static function getNationalBankCodeLength($country_code)
    {
        if (!isset(IBAN::$fields[$country_code])) {
            return false;
        }
        return substr_count(IBAN::$fields[$country_code], 'b', 2);
    }

    /**
     * @param $country_code
     * @return bool|int
     */
    private static function getNationalBankCodePos($country_code)
    {
        if (!isset(IBAN::$fields[$country_code])) {
            return false;
        }
        return strpos(str_replace(' ', '', IBAN::$fields[$country_code]), 'b', 2);
    }

    private static $bank_identifier = [
        'EE' => [
            '42' => ['name' => 'AS Eesti Krediidipank', 'bic' => 'EKRDEE22'],
            '16' => ['name' => 'Eesti Pank', 'bic' => 'EPBEEE2X'],
            '10' => ['name' => 'AS SEB Pank', 'bic' => 'EEUHEE2X'],
            '22' => ['name' => 'Swedbank AS', 'bic' => 'HABAEE2X'],
            '96' => ['name' => 'DNB Pank', 'bic' => 'RIKOEE22'],
            '17' => ['name' => 'Nordea Bank AB Eesti filiaal', 'bic' => 'NDEAEE2X'],
            '12' => ['name' => 'AS Citadele banka Eesti filiaal', 'bic' => 'PARXEE22'],
            '55' => ['name' => 'Versobank AS', 'bic' => 'SBMBEE22'],
            '33' => ['name' => 'Danske Bank A/S Eesti filiaal', 'bic' => 'FOREEE2X'],
            '83' => ['name' => 'Svenska Handelsbanken', 'bic' => 'HANDEE22'],
            '00' => ['name' => 'Tallinna Äripanga AS', 'bic' => 'TABUEE22'],
            '51' => ['name' => 'OP Corporate Bank plc Eesti filiaal', 'bic' => 'OKOYEE2X'],
            '77' => ['name' => 'AS LHV Pank', 'bic' => 'LHVBEE22'],
            '75' => ['name' => 'BIGBANK AS', 'bic' => 'BIGKEE2B'],
            '66' => ['name' => 'AS Eurex Capital', 'bic' => ''],
            '99' => ['name' => 'AS Pocopay', 'bic' => 'AKELEE21'],
            '45' => ['name' => 'GFC Good Finance Company AS', 'bic' => 'GFCBEE22'],
            '62' => ['name' => 'Maaelu Edendamise Hoiu-laenuühistu', 'bic' => ''],
        ],
        'LV' => [
            'CBBR' => ['name' => 'JSC AKCIJU KOMERCBANKA BALTIKUMS', 'bic' => ''],
            'AIZK' => ['name' => 'ABLV BANK, JSC', 'bic' => ''],
            'RIKO' => ['name' => 'JSC DNB BANKA', 'bic' => ''],
            'LATC' => ['name' => 'JSC EXPOBANK', 'bic' => ''],
            'PRTT' => ['name' => 'JSC PRIVATBANK', 'bic' => ''],
            'UNLA' => ['name' => 'JSC SEB BANKA', 'bic' => ''],
            'MULT' => ['name' => 'JSC MERIDIAN TRADE BANK', 'bic' => ''],
            'HABA' => ['name' => 'JSC SWEDBANK', 'bic' => ''],
            'BLOI' => ['name' => 'BALTICPAY CORPORATION Ltd.', 'bic' => ''],
            'LLBB' => ['name' => 'BANK M2M EUROPE JSC', 'bic' => ''],
            'PARX' => ['name' => 'JSC CITADELE BANKA', 'bic' => ''],
            'BLIB' => ['name' => 'JSC BALTIC INTERNATIONAL BANK', 'bic' => ''],
            'RIBR' => ['name' => 'JSC REĢIONĀLĀ INVESTĪCIJU BANK', 'bic' => ''],
            'LACB' => ['name' => 'BANK OF LATVIA', 'bic' => ''],
            'LAPB' => ['name' => 'JSC LATVIJAS PASTA BANKA', 'bic' => ''],
            'LKJF' => ['name' => 'LTFJA KKS JURNIEKU FORUMS', 'bic' => ''],
            'LATB' => ['name' => 'NORVIK BANKA, JSC', 'bic' => ''],
            'RTMB' => ['name' => 'JSC RIETUMU BANKA', 'bic' => ''],
            'RGNS' => ['name' => 'RIGENSIS BANK JSC', 'bic' => ''],
            'TPRO' => ['name' => 'TRANSACT PRO Ltd.', 'bic' => ''],
            'LPNS' => ['name' => 'STATE JSC LATVIJAS PASTS (LATVIAN POST)', 'bic' => ''],
            'LLST' => ['name' => 'STREAMPAY Ltd.', 'bic' => ''],
            'TREL' => ['name' => 'THE TREASURY OF THE REPUBLIC OF LATVIA', 'bic' => ''],
            'MOSB' => ['name' => 'AKTSIASELTS EESTI KREDIIDIPANK LATVIA BRUNCH', 'bic' => ''],
            'MARA' => ['name' => 'DANSKE BANK LATVIA BRUNCH', 'bic' => ''],
            'NDEA' => ['name' => 'NORDEA BANK AB LATVIA BRUNCH', 'bic' => ''],
            'OKOY' => ['name' => 'POHJOLA BANK PLC LATVIA BRUNCH', 'bic' => ''],
            'HAND' => ['name' => 'SVENSKA HANDELSBANKEN AB LATVIA BRUNCH', 'bic' => ''],
            'FSCE' => ['name' => 'FSC EU Ltd.', 'bic' => ''],
            'TRSF' => ['name' => 'JSC TRANSFERTA', 'bic' => ''],
        ],
        'LT' => [
            '10110' => ['name' => 'Lietuvos banko padalinys', 'bic' => ''],
            '00758' => ['name' => 'Lietuvos banko sąskaita BAB SNORAS įmokoms surinkti', 'bic' => ''],

            '10100' => ['name' => 'Lietuvos bankas', 'bic' => ''],
            '10101' => ['name' => 'Lietuvos bankas', 'bic' => ''],
            '10900' => ['name' => 'Lietuvos bankas', 'bic' => ''],
            '10110' => ['name' => 'Lietuvos bankas', 'bic' => ''],

            '90002' => ['name' => 'Lietuvos centrinis vertybinių popierių depozitoriumas', 'bic' => ''],
            '90001' => ['name' => 'Lietuvos centrinis vertybinių popierių depozitoriumas', 'bic' => ''],
            '40199' => ['name' => 'AB DNB bankas minimum rezerves', 'bic' => ''],
            '40100' => ['name' => 'AB DNB bankas', 'bic' => ''],

            '70500' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71800' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71812' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71821' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71816' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71825' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71899' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71819' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71826' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71809' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71823' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71802' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71805' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71829' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71804' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71818' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71808' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71806' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71815' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71820' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71814' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71830' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71828' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71807' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71813' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71817' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71824' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71811' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71810' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71803' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71822' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],
            '71827' => ['name' => 'AB Šiaulių bankas', 'bic' => ''],

            '70440' => ['name' => 'AB SEB bankas', 'bic' => ''],
            '73000' => ['name' => 'Swedbank AB', 'bic' => ''],
            '21200' => ['name' => 'Svenska Handelsbanken AB Lietuvos filialas', 'bic' => ''],
            '72900' => ['name' => 'AB Citadele bankas', 'bic' => ''],
            '72300' => ['name' => 'UAB Medicinos bankas', 'bic' => ''],
            '21700' => ['name' => 'AS Meridian Trade Bank Lietuvos filialas', 'bic' => ''],
            '21400' => ['name' => 'Nordea Bank AB Lietuvos skyrius', 'bic' => ''],
            '21500' => ['name' => 'OP Corporate Bank plc Lietuvos filialas', 'bic' => ''],
            '74000' => ['name' => 'Danske Bank A/S Lietuvos filialas', 'bic' => ''],

            '50131' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50109' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50152' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50130' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50121' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50126' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50149' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50164' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50156' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50142' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50144' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50147' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50133' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50118' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50108' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50127' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50159' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50122' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50163' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50135' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50153' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50113' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50111' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50132' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50114' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50154' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50125' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50123' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50116' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50101' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50161' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50112' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50120' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50117' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50106' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50138' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50137' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50100' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50146' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50148' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50140' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50157' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50119' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50136' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50110' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50162' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50124' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50105' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50103' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50139' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50141' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50143' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50165' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50129' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50102' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50115' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50128' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50151' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50134' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50145' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50158' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '50104' => ['name' => 'Lietuvos centrinė kredito unija', 'bic' => ''],
            '90577' => ['name' => 'AB LCVPD Asmeninių sąskaitų registras', 'bic' => ''],
            '51200' => ['name' => 'Kredito unija AMBER', 'bic' => ''],
            '51400' => ['name' => 'Kredito unija Panevėžio regiono taupomoji kasa', 'bic' => ''],
            '51700' => ['name' => 'Kredito unija Saulėgrąža', 'bic' => ''],
            '50300' => ['name' => 'Kredito unija Mano unija', 'bic' => ''],
            '50600' => ['name' => 'Kredito unija Vilniaus kreditas', 'bic' => ''],
            '50500' => ['name' => 'Kredito unija Taupa', 'bic' => ''],
            '51500' => ['name' => 'LTL kredito unija', 'bic' => ''],
            '50150' => ['name' => 'Šiaulių kredito unija', 'bic' => ''],
            '50400' => ['name' => 'Kredito unija Centro taupomoji kasa', 'bic' => ''],
            '51600' => ['name' => 'Taupkasė, kredito unija', 'bic' => ''],
            '50800' => ['name' => 'Vilniaus kredito unija', 'bic' => ''],

            '51900' => ['name' => 'Vilniaus regiono kredito unija', 'bic' => ''],
            '50160' => ['name' => 'Vilniaus regiono kredito unija', 'bic' => ''],
            '30300' => ['name' => 'AB Lietuvos paštas', 'bic' => ''],
            '35000' => ['name' => 'Paysera LT, UAB', 'bic' => ''],
            '35100' => ['name' => 'MisterTango, UAB', 'bic' => ''],
            '30200' => ['name' => 'UAB Perlo paslaugos', 'bic' => ''],
            '35200' => ['name' => 'UAB NEO Finance', 'bic' => ''],
        ]
    ];

    private static $digits = array(
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
        'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z');

    /**
     * Convert the alphabetical characters into numbers.
     * @param $hash
     * @return string
     */
    private static function convertToDigits($hash)
    {
        $newHash = '';
        for ($i = 0; $i < strlen($hash); $i++) {
            $symbol = $hash[$i];
            if (!is_numeric($symbol)) {
                $symbol = array_search($symbol, IBAN::$digits);
            }
            $newHash .= $symbol;
        }
        return $newHash;
    }

    /**
     * @param $value
     * @return string
     */
    private static function applyMod9710($value)
    {
        $result = 98 - (int)bcmod($value, 97);
        if (strlen($result) < 2) {
            $result = str_pad($result, 2, '0', STR_PAD_LEFT);
        }
        return (string)$result;
    }

    /**
     * @param $international_bank_account_number
     * @return string
     */
    private static function getCheckSum($international_bank_account_number)
    {
        return IBAN::applyMod9710(IBAN::convertToDigits(substr($international_bank_account_number, 4) . substr($international_bank_account_number, 0, 2) . '00'));
    }

    /**
     * @param $international_bank_account_number
     * @return bool
     */
    public static function isValid($international_bank_account_number)
    {
        $check_sum = IBAN::getCheckSum($international_bank_account_number);
        return strcmp(substr($international_bank_account_number, 2, 2), $check_sum) === 0;
    }

    /**
     * @param $international_bank_account_number
     * @return bool
     */
    public static function getBankName($international_bank_account_number)
    {
        $country_code = substr($international_bank_account_number, 0, 2);
        $national_bank_code_length = IBAN::getNationalBankCodeLength($country_code);
        if (!$national_bank_code_length) {
            return false;
        }

        $national_bank_code_pos = IBAN::getNationalBankCodePos($country_code);
        if (!$national_bank_code_pos) {
            return false;
        }

        $national_bank_code = substr($international_bank_account_number, $national_bank_code_pos, $national_bank_code_length);
        if (!isset(IBAN::$bank_identifier[$country_code][$national_bank_code])) {
            return false;
        }
        return IBAN::$bank_identifier[$country_code][$national_bank_code]['name'];
    }

}

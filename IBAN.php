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
            '42' => 'AS Eesti Krediidipank',
            '16' => 'Eesti Pank',
            '10' => 'AS SEB Pank',
            '22' => 'Swedbank AS',
            '96' => 'DNB Pank',
            '17' => 'Nordea Bank AB Eesti filiaal',
            '12' => 'AS Citadele banka Eesti filiaal',
            '55' => 'Versobank AS',
            '33' => 'Danske Bank A/S Eesti filiaal',
            '83' => 'Svenska Handelsbanken',
            '00' => 'Tallinna Äripanga AS',
            '51' => 'Pohjola Bank plc Eesti filiaal',
            '77' => 'AS LHV Pank',
            '75' => 'BIGBANK AS',
            '66' => 'AS Eurex Capital',
            '99' => 'AS Pocopay',
            '45' => 'GFC Good Finance Company AS',
            '62' => 'Maaelu Edendamise Hoiu-laenuühistu',
        ],
        'LV' => [
            'CBBR' => 'JSC AKCIJU KOMERCBANKA BALTIKUMS',
            'AIZK' => 'ABLV BANK, JSC',
            'RIKO' => 'JSC DNB BANKA',
            'LATC' => 'JSC EXPOBANK',
            'PRTT' => 'JSC PRIVATBANK',
            'UNLA' => 'JSC SEB BANKA',
            'MULT' => 'JSC MERIDIAN TRADE BANK',
            'HABA' => 'JSC SWEDBANK',
            'BLOI' => 'BALTICPAY CORPORATION Ltd.',
            'LLBB' => 'BANK M2M EUROPE JSC',
            'PARX' => 'JSC CITADELE BANKA',
            'BLIB' => 'JSC BALTIC INTERNATIONAL BANK',
            'RIBR' => 'JSC REĢIONĀLĀ INVESTĪCIJU BANK',
            'LACB' => 'BANK OF LATVIA',
            'LAPB' => 'JSC LATVIJAS PASTA BANKA',
            'LKJF' => 'LTFJA KKS JURNIEKU FORUMS',
            'LATB' => 'NORVIK BANKA, JSC',
            'RTMB' => 'JSC RIETUMU BANKA',
            'RGNS' => 'RIGENSIS BANK JSC',
            'TPRO' => 'TRANSACT PRO Ltd.',
            'LPNS' => 'STATE JSC LATVIJAS PASTS (LATVIAN POST)',
            'LLST' => 'STREAMPAY Ltd.',
            'TREL' => 'THE TREASURY OF THE REPUBLIC OF LATVIA',
            'MOSB' => 'AKTSIASELTS EESTI KREDIIDIPANK LATVIA BRUNCH',
            'MARA' => 'DANSKE BANK LATVIA BRUNCH',
            'NDEA' => 'NORDEA BANK AB LATVIA BRUNCH',
            'OKOY' => 'POHJOLA BANK PLC LATVIA BRUNCH',
            'HAND' => 'SVENSKA HANDELSBANKEN AB LATVIA BRUNCH',
            'FSCE' => 'FSC EU Ltd.',
            'TRSF' => 'JSC TRANSFERTA',
        ],
        'LT' => [
            '10110' => 'Lietuvos banko padalinys',
            '00758' => 'Lietuvos banko sąskaita BAB SNORAS įmokoms surinkti',

            '10100' => 'Lietuvos bankas',
            '10101' => 'Lietuvos bankas',
            '10900' => 'Lietuvos bankas',
            '10110' => 'Lietuvos bankas',

            '90002' => 'Lietuvos centrinis vertybinių popierių depozitoriumas',
            '90001' => 'Lietuvos centrinis vertybinių popierių depozitoriumas',
            '40199' => 'AB DNB bankas minimum rezerves',
            '40100' => 'AB DNB bankas',

            '70500' => 'AB Šiaulių bankas',
            '71800' => 'AB Šiaulių bankas',
            '71812' => 'AB Šiaulių bankas',
            '71821' => 'AB Šiaulių bankas',
            '71816' => 'AB Šiaulių bankas',
            '71825' => 'AB Šiaulių bankas',
            '71899' => 'AB Šiaulių bankas',
            '71819' => 'AB Šiaulių bankas',
            '71826' => 'AB Šiaulių bankas',
            '71809' => 'AB Šiaulių bankas',
            '71823' => 'AB Šiaulių bankas',
            '71802' => 'AB Šiaulių bankas',
            '71805' => 'AB Šiaulių bankas',
            '71829' => 'AB Šiaulių bankas',
            '71804' => 'AB Šiaulių bankas',
            '71818' => 'AB Šiaulių bankas',
            '71808' => 'AB Šiaulių bankas',
            '71806' => 'AB Šiaulių bankas',
            '71815' => 'AB Šiaulių bankas',
            '71820' => 'AB Šiaulių bankas',
            '71814' => 'AB Šiaulių bankas',
            '71830' => 'AB Šiaulių bankas',
            '71828' => 'AB Šiaulių bankas',
            '71807' => 'AB Šiaulių bankas',
            '71813' => 'AB Šiaulių bankas',
            '71817' => 'AB Šiaulių bankas',
            '71824' => 'AB Šiaulių bankas',
            '71811' => 'AB Šiaulių bankas',
            '71810' => 'AB Šiaulių bankas',
            '71803' => 'AB Šiaulių bankas',
            '71822' => 'AB Šiaulių bankas',
            '71827' => 'AB Šiaulių bankas',

            '70440' => 'AB SEB bankas',
            '73000' => 'Swedbank AB',
            '21200' => 'Svenska Handelsbanken AB Lietuvos filialas',
            '72900' => 'AB Citadele bankas',
            '72300' => 'UAB Medicinos bankas',
            '21700' => 'AS Meridian Trade Bank Lietuvos filialas',
            '21400' => 'Nordea Bank AB Lietuvos skyrius',
            '21500' => 'OP Corporate Bank plc Lietuvos filialas',
            '74000' => 'Danske Bank A/S Lietuvos filialas',


            '50131' => 'Lietuvos centrinė kredito unija',
            '50109' => 'Lietuvos centrinė kredito unija',
            '50152' => 'Lietuvos centrinė kredito unija',
            '50130' => 'Lietuvos centrinė kredito unija',
            '50121' => 'Lietuvos centrinė kredito unija',
            '50126' => 'Lietuvos centrinė kredito unija',
            '50149' => 'Lietuvos centrinė kredito unija',
            '50164' => 'Lietuvos centrinė kredito unija',
            '50156' => 'Lietuvos centrinė kredito unija',
            '50142' => 'Lietuvos centrinė kredito unija',
            '50144' => 'Lietuvos centrinė kredito unija',
            '50147' => 'Lietuvos centrinė kredito unija',
            '50133' => 'Lietuvos centrinė kredito unija',
            '50118' => 'Lietuvos centrinė kredito unija',
            '50108' => 'Lietuvos centrinė kredito unija',
            '50127' => 'Lietuvos centrinė kredito unija',
            '50159' => 'Lietuvos centrinė kredito unija',
            '50122' => 'Lietuvos centrinė kredito unija',
            '50163' => 'Lietuvos centrinė kredito unija',
            '50135' => 'Lietuvos centrinė kredito unija',
            '50153' => 'Lietuvos centrinė kredito unija',
            '50113' => 'Lietuvos centrinė kredito unija',
            '50111' => 'Lietuvos centrinė kredito unija',
            '50132' => 'Lietuvos centrinė kredito unija',
            '50114' => 'Lietuvos centrinė kredito unija',
            '50154' => 'Lietuvos centrinė kredito unija',
            '50125' => 'Lietuvos centrinė kredito unija',
            '50123' => 'Lietuvos centrinė kredito unija',
            '50116' => 'Lietuvos centrinė kredito unija',
            '50101' => 'Lietuvos centrinė kredito unija',
            '50161' => 'Lietuvos centrinė kredito unija',
            '50112' => 'Lietuvos centrinė kredito unija',
            '50120' => 'Lietuvos centrinė kredito unija',
            '50117' => 'Lietuvos centrinė kredito unija',
            '50106' => 'Lietuvos centrinė kredito unija',
            '50138' => 'Lietuvos centrinė kredito unija',
            '50137' => 'Lietuvos centrinė kredito unija',
            '50100' => 'Lietuvos centrinė kredito unija',
            '50146' => 'Lietuvos centrinė kredito unija',
            '50148' => 'Lietuvos centrinė kredito unija',
            '50140' => 'Lietuvos centrinė kredito unija',
            '50157' => 'Lietuvos centrinė kredito unija',
            '50119' => 'Lietuvos centrinė kredito unija',
            '50136' => 'Lietuvos centrinė kredito unija',
            '50110' => 'Lietuvos centrinė kredito unija',
            '50162' => 'Lietuvos centrinė kredito unija',
            '50124' => 'Lietuvos centrinė kredito unija',
            '50105' => 'Lietuvos centrinė kredito unija',
            '50103' => 'Lietuvos centrinė kredito unija',
            '50139' => 'Lietuvos centrinė kredito unija',
            '50141' => 'Lietuvos centrinė kredito unija',
            '50143' => 'Lietuvos centrinė kredito unija',
            '50165' => 'Lietuvos centrinė kredito unija',
            '50129' => 'Lietuvos centrinė kredito unija',
            '50102' => 'Lietuvos centrinė kredito unija',
            '50115' => 'Lietuvos centrinė kredito unija',
            '50128' => 'Lietuvos centrinė kredito unija',
            '50151' => 'Lietuvos centrinė kredito unija',
            '50134' => 'Lietuvos centrinė kredito unija',
            '50145' => 'Lietuvos centrinė kredito unija',
            '50158' => 'Lietuvos centrinė kredito unija',
            '50104' => 'Lietuvos centrinė kredito unija',
            '90577' => 'AB LCVPD Asmeninių sąskaitų registras',
            '51200' => 'Kredito unija AMBER',
            '51400' => 'Kredito unija Panevėžio regiono taupomoji kasa',
            '51700' => 'Kredito unija Saulėgrąža',
            '50300' => 'Kredito unija Mano unija',
            '50600' => 'Kredito unija Vilniaus kreditas',
            '50500' => 'Kredito unija Taupa',
            '51500' => 'LTL kredito unija',
            '50150' => 'Šiaulių kredito unija',
            '50400' => 'Kredito unija Centro taupomoji kasa',
            '51600' => 'Taupkasė, kredito unija',
            '50800' => 'Vilniaus kredito unija',

            '51900' => 'Vilniaus regiono kredito unija',
            '50160' => 'Vilniaus regiono kredito unija',
            '30300' => 'AB Lietuvos paštas',
            '35000' => 'Paysera LT, UAB',
            '35100' => 'MisterTango, UAB',
            '30200' => 'UAB Perlo paslaugos',
            '35200' => 'UAB NEO Finance',
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

        $national_bank_code = substr($international_bank_account_number, 4, $national_bank_code_length);
        if (!isset(IBAN::$bank_identifier[$country_code][$national_bank_code])) {
            return false;
        }
        return IBAN::$bank_identifier[$country_code][$national_bank_code];
    }

}
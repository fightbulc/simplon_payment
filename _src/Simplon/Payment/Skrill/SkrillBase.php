<?php

    namespace Simplon\Payment\Skrill;

    class SkrillBase
    {
        CONST URL_TARGET_TOP = 1;
        CONST URL_TARGET_PARENT = 2;
        CONST URL_TARGET_SELF = 3;
        CONST URL_TARGET_BLANK = 4;

        CONST REDIRECT_SOFORTUEBERWEISUNG_OFF = 0;
        CONST REDIRECT_SOFORTUEBERWEISUNG_ON = 1;

        CONST HIDE_LOGIN_SECTION_OFF = 0;
        CONST HIDE_LOGIN_SECTION_ON = 1;

        /** @var array */
        protected $_languagesAvailable = [
            'EN',
            'DE',
            'ES',
            'FR',
            'IT',
            'PL',
            'GR',
            'RO',
            'RU',
            'TR',
            'CN',
            'CZ',
            'NL',
            'DA',
            'SV',
            'FI',
        ];

        /** @var array */
        protected $_currencyAvailable = [
            "AED" => "Utd. Arab Emir. Dirham",
            "AUD" => "Australian Dollar",
            "BGN" => "Bulgarian Leva",
            "CAD" => "Canadian Dollar",
            "CHF" => "Swiss Franc",
            "CZK" => "Czech Koruna",
            "DKK" => "Danish Krone",
            "EEK" => "Estonian Kroon",
            "EUR" => "Euro",
            "GBP" => "British Pound",
            "HKD" => "Hong Kong Dollar",
            "HRK" => "Croatian Kuna",
            "HUF" => "Hungarian Forint",
            "ILS" => "Israeli Shekel",
            "INR" => "Indian Rupee",
            "ISK" => "Iceland Krona",
            "JOD" => "Jordanian Dinar",
            "JPY" => "Japanese Yen",
            "KRW" => "South-Korean Won",
            "LTL" => "Lithuanian Litas",
            "LVL" => "Latvian Lat",
            "MAD" => "Moroccan Dirham",
            "MYR" => "Malaysian Ringgit",
            "NOK" => "Norwegian Krone",
            "NZD" => "New Zealand Dollar",
            "OMR" => "Omani Rial",
            "PLN" => "Polish Zloty",
            "QAR" => "Qatari Rial",
            "RON" => "Romanian Leu New",
            "RSD" => "Serbian dinar",
            "SAR" => "Saudi Riyal",
            "SEK" => "Swedish Krona",
            "SGD" => "Singapore Dollar",
            "SKK" => "Slovakian Koruna",
            "THB" => "Thailand Baht",
            "TND" => "Tunisian Dinar",
            "TRY" => "New Turkish Lira",
            "TWD" => "Taiwan Dollar",
            "USD" => "U.S. Dollar",
            "ZAR" => "South-African Rand",
        ];

        /** @var array */
        protected $_countriesAvailable = [
            'AND' => 'Andorra',
            'ARE' => 'United Arab Emirates',
            'AFG' => 'Afghanistan',
            'ATG' => 'Antigua and Barbuda',
            'AIA' => 'Anguilla',
            'ALB' => 'Albania',
            'ARM' => 'Armenia',
            'AGO' => 'Angola',
            'ATA' => 'Antarctica',
            'ARG' => 'Argentina',
            'ASM' => 'American Samoa',
            'AUT' => 'Austria',
            'AUS' => 'Australia',
            'ABW' => 'Aruba',
            'ALA' => 'Aland Islands',
            'AZE' => 'Azerbaijan',
            'BIH' => 'Bosnia and Herzegovina',
            'BRB' => 'Barbados',
            'BGD' => 'Bangladesh',
            'BEL' => 'Belgium',
            'BFA' => 'Burkina Faso',
            'BGR' => 'Bulgaria',
            'BHR' => 'Bahrain',
            'BDI' => 'Burundi',
            'BEN' => 'Benin',
            'BLM' => 'Saint Barthelemy',
            'BMU' => 'Bermuda',
            'BRN' => 'Brunei',
            'BOL' => 'Bolivia',
            'BES' => 'Bonaire',
            'BRA' => 'Brazil',
            'BHS' => 'Bahamas',
            'BTN' => 'Bhutan',
            'BVT' => 'Bouvet Island',
            'BWA' => 'Botswana',
            'BLR' => 'Belarus',
            'BLZ' => 'Belize',
            'CAN' => 'Canada',
            'CCK' => 'Cocos Islands',
            'COD' => 'Democratic Republic of the Congo',
            'CAF' => 'Central African Republic',
            'COG' => 'Republic of the Congo',
            'CHE' => 'Switzerland',
            'CIV' => 'Ivory Coast',
            'COK' => 'Cook Islands',
            'CHL' => 'Chile',
            'CMR' => 'Cameroon',
            'CHN' => 'China',
            'COL' => 'Colombia',
            'CRI' => 'Costa Rica',
            'CUB' => 'Cuba',
            'CPV' => 'Cape Verde',
            'CUW' => 'Curacao',
            'CXR' => 'Christmas Island',
            'CYP' => 'Cyprus',
            'CZE' => 'Czech Republic',
            'DEU' => 'Germany',
            'DJI' => 'Djibouti',
            'DNK' => 'Denmark',
            'DMA' => 'Dominica',
            'DOM' => 'Dominican Republic',
            'DZA' => 'Algeria',
            'ECU' => 'Ecuador',
            'EST' => 'Estonia',
            'EGY' => 'Egypt',
            'ESH' => 'Western Sahara',
            'ERI' => 'Eritrea',
            'ESP' => 'Spain',
            'ETH' => 'Ethiopia',
            'FIN' => 'Finland',
            'FJI' => 'Fiji',
            'FLK' => 'Falkland Islands',
            'FSM' => 'Micronesia',
            'FRO' => 'Faroe Islands',
            'FRA' => 'France',
            'GAB' => 'Gabon',
            'GBR' => 'United Kingdom',
            'GRD' => 'Grenada',
            'GEO' => 'Georgia',
            'GUF' => 'French Guiana',
            'GGY' => 'Guernsey',
            'GHA' => 'Ghana',
            'GIB' => 'Gibraltar',
            'GRL' => 'Greenland',
            'GMB' => 'Gambia',
            'GIN' => 'Guinea',
            'GLP' => 'Guadeloupe',
            'GNQ' => 'Equatorial Guinea',
            'GRC' => 'Greece',
            'SGS' => 'South Georgia and the South Sandwich Islands',
            'GTM' => 'Guatemala',
            'GUM' => 'Guam',
            'GNB' => 'Guinea-Bissau',
            'GUY' => 'Guyana',
            'HKG' => 'Hong Kong',
            'HMD' => 'Heard Island and McDonald Islands',
            'HND' => 'Honduras',
            'HRV' => 'Croatia',
            'HTI' => 'Haiti',
            'HUN' => 'Hungary',
            'IDN' => 'Indonesia',
            'IRL' => 'Ireland',
            'ISR' => 'Israel',
            'IMN' => 'Isle of Man',
            'IND' => 'India',
            'IOT' => 'British Indian Ocean Territory',
            'IRQ' => 'Iraq',
            'IRN' => 'Iran',
            'ISL' => 'Iceland',
            'ITA' => 'Italy',
            'JEY' => 'Jersey',
            'JAM' => 'Jamaica',
            'JOR' => 'Jordan',
            'JPN' => 'Japan',
            'KEN' => 'Kenya',
            'KGZ' => 'Kyrgyzstan',
            'KHM' => 'Cambodia',
            'KIR' => 'Kiribati',
            'COM' => 'Comoros',
            'KNA' => 'Saint Kitts and Nevis',
            'PRK' => 'North Korea',
            'KOR' => 'South Korea',
            'XKX' => 'Kosovo',
            'KWT' => 'Kuwait',
            'CYM' => 'Cayman Islands',
            'KAZ' => 'Kazakhstan',
            'LAO' => 'Laos',
            'LBN' => 'Lebanon',
            'LCA' => 'Saint Lucia',
            'LIE' => 'Liechtenstein',
            'LKA' => 'Sri Lanka',
            'LBR' => 'Liberia',
            'LSO' => 'Lesotho',
            'LTU' => 'Lithuania',
            'LUX' => 'Luxembourg',
            'LVA' => 'Latvia',
            'LBY' => 'Libya',
            'MAR' => 'Morocco',
            'MCO' => 'Monaco',
            'MDA' => 'Moldova',
            'MNE' => 'Montenegro',
            'MAF' => 'Saint Martin',
            'MDG' => 'Madagascar',
            'MHL' => 'Marshall Islands',
            'MKD' => 'Macedonia',
            'MLI' => 'Mali',
            'MMR' => 'Myanmar',
            'MNG' => 'Mongolia',
            'MAC' => 'Macao',
            'MNP' => 'Northern Mariana Islands',
            'MTQ' => 'Martinique',
            'MRT' => 'Mauritania',
            'MSR' => 'Montserrat',
            'MLT' => 'Malta',
            'MUS' => 'Mauritius',
            'MDV' => 'Maldives',
            'MWI' => 'Malawi',
            'MEX' => 'Mexico',
            'MYS' => 'Malaysia',
            'MOZ' => 'Mozambique',
            'NAM' => 'Namibia',
            'NCL' => 'New Caledonia',
            'NER' => 'Niger',
            'NFK' => 'Norfolk Island',
            'NGA' => 'Nigeria',
            'NIC' => 'Nicaragua',
            'NLD' => 'Netherlands',
            'NOR' => 'Norway',
            'NPL' => 'Nepal',
            'NRU' => 'Nauru',
            'NIU' => 'Niue',
            'NZL' => 'New Zealand',
            'OMN' => 'Oman',
            'PAN' => 'Panama',
            'PER' => 'Peru',
            'PYF' => 'French Polynesia',
            'PNG' => 'Papua New Guinea',
            'PHL' => 'Philippines',
            'PAK' => 'Pakistan',
            'POL' => 'Poland',
            'SPM' => 'Saint Pierre and Miquelon',
            'PCN' => 'Pitcairn',
            'PRI' => 'Puerto Rico',
            'PSE' => 'Palestinian Territory',
            'PRT' => 'Portugal',
            'PLW' => 'Palau',
            'PRY' => 'Paraguay',
            'QAT' => 'Qatar',
            'REU' => 'Reunion',
            'ROU' => 'Romania',
            'SRB' => 'Serbia',
            'RUS' => 'Russia',
            'RWA' => 'Rwanda',
            'SAU' => 'Saudi Arabia',
            'SLB' => 'Solomon Islands',
            'SYC' => 'Seychelles',
            'SDN' => 'Sudan',
            'SSD' => 'South Sudan',
            'SWE' => 'Sweden',
            'SGP' => 'Singapore',
            'SHN' => 'Saint Helena',
            'SVN' => 'Slovenia',
            'SJM' => 'Svalbard and Jan Mayen',
            'SVK' => 'Slovakia',
            'SLE' => 'Sierra Leone',
            'SMR' => 'San Marino',
            'SEN' => 'Senegal',
            'SOM' => 'Somalia',
            'SUR' => 'Suriname',
            'STP' => 'Sao Tome and Principe',
            'SLV' => 'El Salvador',
            'SXM' => 'Sint Maarten',
            'SYR' => 'Syria',
            'SWZ' => 'Swaziland',
            'TCA' => 'Turks and Caicos Islands',
            'TCD' => 'Chad',
            'ATF' => 'French Southern Territories',
            'TGO' => 'Togo',
            'THA' => 'Thailand',
            'TJK' => 'Tajikistan',
            'TKL' => 'Tokelau',
            'TLS' => 'East Timor',
            'TKM' => 'Turkmenistan',
            'TUN' => 'Tunisia',
            'TON' => 'Tonga',
            'TUR' => 'Turkey',
            'TTO' => 'Trinidad and Tobago',
            'TUV' => 'Tuvalu',
            'TWN' => 'Taiwan',
            'TZA' => 'Tanzania',
            'UKR' => 'Ukraine',
            'UGA' => 'Uganda',
            'UMI' => 'United States Minor Outlying Islands',
            'USA' => 'United States',
            'URY' => 'Uruguay',
            'UZB' => 'Uzbekistan',
            'VAT' => 'Vatican',
            'VCT' => 'Saint Vincent and the Grenadines',
            'VEN' => 'Venezuela',
            'VGB' => 'British Virgin Islands',
            'VIR' => 'U.S. Virgin Islands',
            'VNM' => 'Vietnam',
            'VUT' => 'Vanuatu',
            'WLF' => 'Wallis and Futuna',
            'WSM' => 'Samoa',
            'YEM' => 'Yemen',
            'MYT' => 'Mayotte',
            'ZAF' => 'South Africa',
            'ZMB' => 'Zambia',
            'ZWE' => 'Zimbabwe',
            'SCG' => 'Serbia and Montenegro',
            'ANT' => 'Netherlands Antilles',
        ];

        /** @var bool */
        protected $_sandboxEnabled = FALSE;

        /** @var string */
        protected $_urlGateway = 'https://www.moneybookers.com/app/payment.pl';

        /** @var string */
        protected $_urlGatewayTest = 'http://www.moneybookers.com/app/test_payment.pl';

        /** @var string */
        protected $_urlQueryGateway = 'https://www.moneybookers.com/app/query.pl';

        /** @var bool */
        protected $_usePreparedOrder = TRUE;

        protected $_merchantAccountEmail;
        protected $_merchantName;

        protected $_urlReturn;
        protected $_urlReturnButtonText;
        protected $_urlReturnTarget = SkrillStart::URL_TARGET_TOP;
        protected $_urlCancel;
        protected $_urlCancelTarget = SkrillStart::URL_TARGET_TOP;
        protected $_urlOrEmailCallback;
        protected $_urlOrEmailCallbackAlternative;
        protected $_urlLogo;

        protected $_redirectSofortUeberweisung = SkrillStart::REDIRECT_SOFORTUEBERWEISUNG_OFF;
        protected $_hideLoginSection = SkrillStart::HIDE_LOGIN_SECTION_ON;

        protected $_orderTransactionId;
        protected $_orderItems = [];
        protected $_orderAmount = 0.00;
        protected $_orderCurrency;
        protected $_orderLanguage;
        protected $_orderProductDescriptions = [];
        protected $_orderCostDescriptions = [];
        protected $_orderAffiliateId;
        protected $_orderAffiliateName;
        protected $_orderCallbackData = [];
        protected $_orderConfirmationNote;
        protected $_orderCustomerEmail;
        protected $_orderCustomerTitle;
        protected $_orderCustomerFirstName;
        protected $_orderCustomerLastName;
        protected $_orderCustomerBirthdate;
        protected $_orderCustomerAddressStreet;
        protected $_orderCustomerAddressAdditional;
        protected $_orderCustomerAddressZip;
        protected $_orderCustomerAddressCity;
        protected $_orderCustomerAddressState;
        protected $_orderCustomerAddressCountry;
        protected $_orderCustomerPhone;
        protected $_orderCheckoutToken;
        protected $_orderEnabledPaymentMethodsString;

        protected $_orderCurrencyDefault = 'EUR';
        protected $_orderLanguageDefault = 'en';
        protected $_orderCustomerAddressCountryDefault = 'DEU';

        // ##########################################

        /**
         * @return \CURL
         */
        protected function _getCurlClass()
        {
            return new \CURL();
        }

        // ##########################################

        /**
         * @param $sandboxEnabled
         * @return $this
         */
        public function setSandboxEnabled($sandboxEnabled)
        {
            $this->_sandboxEnabled = $sandboxEnabled !== FALSE ? TRUE : FALSE;

            return $this;
        }

        // ##########################################

        /**
         * @return bool
         */
        protected function _isSandboxEnabled()
        {
            return $this->_sandboxEnabled;
        }

        // ##########################################

        /**
         * @return string
         */
        protected function _getUrlGateway()
        {
            return $this->_urlGateway;
        }

        // ##########################################

        /**
         * @return string
         */
        protected function _getUrlGatewayTest()
        {
            return $this->_urlGatewayTest;
        }

        // ##########################################

        /**
         * @return string
         */
        protected function _getUrlGatewayActive()
        {
            // get gateway url
            $gatewayUrl = $this->_getUrlGateway();

            // in case we are in sandbox
            if($this->_isSandboxEnabled())
            {
                $gatewayUrl = $this->_getUrlGatewayTest();
            }

            return $gatewayUrl;
        }

        // ##########################################

        /**
         * @return string
         */
        protected function _getUrlQueryGateway()
        {
            return $this->_urlQueryGateway;
        }
    }
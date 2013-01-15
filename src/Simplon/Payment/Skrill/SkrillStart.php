<?php

  namespace Simplon\Payment\Skrill;

  use Simplon\Payment\Skrill\PaymentMethods\AbstractSkrillPaymentMethods;
  use Simplon\Payment\Skrill\PaymentMethods\InterfaceSkrillPaymentMethods;

  class SkrillStart
  {
    CONST URL_TARGET_TOP = 1;
    CONST URL_TARGET_PARENT = 2;
    CONST URL_TARGET_SELF = 3;
    CONST URL_TARGET_BLANK = 4;

    CONST REDIRECT_SOFORTUEBERWEISUNG_OFF = 0;
    CONST REDIRECT_SOFORTUEBERWEISUNG_ON = 1;

    CONST HIDE_LOGIN_SECTION_OFF = 0;
    CONST HIDE_LOGIN_SECTION_ON = 1;

    /**
     * @var array
     */
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

    /**
     * @var array
     */
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

    /**
     * @var array
     */
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

    /**
     * @var bool
     */
    protected $_sandboxEnabled = FALSE;

    /**
     * @var string
     */
    protected $_urlGateway = 'https://www.moneybookers.com/app/payment.pl';

    /**
     * @var string
     */
    protected $_urlGatewayTest = 'http://www.moneybookers.com/app/test_payment.pl';

    /**
     * @var bool
     */
    protected $_usePreparedOrder = TRUE;

    protected $_merchantAccountEmail;
    protected $_merchantName;

    protected $_urlReturn;
    protected $_urlReturnButtonText;
    protected $_urlReturnTarget = SkrillStart::URL_TARGET_TOP;
    protected $_urlCancel;
    protected $_urlCancelTarget = SkrillStart::URL_TARGET_TOP;
    protected $_urlCallback;
    protected $_urlCallbackAlternative;
    protected $_urlLogo;

    protected $_redirectSofortUeberweisung = SkrillStart::REDIRECT_SOFORTUEBERWEISUNG_OFF;
    protected $_hideLoginSection = SkrillStart::HIDE_LOGIN_SECTION_ON;

    protected $_orderTransactionId;
    protected $_orderAmount;
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
     * @return bool
     */
    protected function _isPreparedOrder()
    {
      return $this->_usePreparedOrder;
    }

    // ##########################################

    /**
     * @param $hideLoginSection
     * @return $this
     */
    public function setHideLoginSection($hideLoginSection)
    {
      $this->_hideLoginSection = $hideLoginSection !== FALSE ? 1 : 0;

      return $this;
    }

    // ##########################################

    /**
     * @return int
     */
    protected function _isHideLoginSection()
    {
      return $this->_hideLoginSection;
    }

    // ##########################################

    /**
     * @param $merchantAccountEmail
     * @return $this
     */
    public function setMerchantAccountEmail($merchantAccountEmail)
    {
      $this->_merchantAccountEmail = $merchantAccountEmail;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getMerchantAccountEmail()
    {
      return $this->_merchantAccountEmail;
    }

    // ##########################################

    /**
     * @param $merchantName
     * @return $this
     */
    public function setMerchantName($merchantName)
    {
      $this->_merchantName = $merchantName;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getMerchantName()
    {
      return $this->_merchantName;
    }

    // ##########################################

    /**
     * @param $orderAffiliateId
     * @return $this
     */
    public function setOrderAffiliateId($orderAffiliateId)
    {
      $this->_orderAffiliateId = $orderAffiliateId;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderAffiliateId()
    {
      return $this->_orderAffiliateId;
    }

    // ##########################################

    /**
     * @param $orderAffiliateName
     * @return $this
     */
    public function setOrderAffiliateName($orderAffiliateName)
    {
      $this->_orderAffiliateName = $orderAffiliateName;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderAffiliateName()
    {
      return $this->_orderAffiliateName;
    }

    // ##########################################

    /**
     * @param $orderAmount
     * @return $this
     */
    public function setOrderAmount($orderAmount)
    {
      $this->_orderAmount = $orderAmount;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderAmount()
    {
      return $this->_orderAmount;
    }

    // ##########################################

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function addOrderCustomCallbackData($name, $value)
    {
      if(count($this->_orderCallbackData) <= 5)
      {
        $this->_orderCallbackData['custom_' . $name] = $value;
      }

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getOrderCallbackData()
    {
      return $this->_orderCallbackData;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getOrderMerchantFields()
    {
      $fieldNames = array_keys($this->_getOrderCallbackData());

      if(! empty($fieldNames))
      {
        return join(',', $fieldNames);
      }

      return '';
    }

    // ##########################################

    /**
     * @param $orderConfirmationNote
     * @return $this
     */
    public function setOrderConfirmationNote($orderConfirmationNote)
    {
      $this->_orderConfirmationNote = $orderConfirmationNote;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderConfirmationNote()
    {
      return $this->_orderConfirmationNote;
    }

    // ##########################################

    /**
     * @param $label
     * @param $value
     * @return $this
     */
    public function addOrderCostDescriptions($label, $value)
    {
      if(count($this->_orderCostDescriptions) < 4)
      {
        $this->_orderCostDescriptions[] = [
          'label' => $label,
          'value' => $value,
        ];
      }

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getOrderCostDescriptions()
    {
      return $this->_orderCostDescriptions;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getOrderCostDescriptionsPrepared()
    {
      $_prepared = [];

      if(count($this->_orderCostDescriptions) > 0)
      {
        foreach($this->_orderCostDescriptions as $index => $descriptionArray)
        {
          $count = $index + 2;
          $_prepared['amount' . $count . '_description'] = $descriptionArray['label'];
          $_prepared['amount' . $count] = $descriptionArray['value'];
        }
      }

      return $_prepared;
    }

    // ##########################################

    /**
     * @param $orderCurrency
     * @return $this
     */
    public function setOrderCurrency($orderCurrency)
    {
      $orderCurrency = strtoupper($orderCurrency);

      if(array_key_exists($orderCurrency, $this->_getCurrenciesAvailable()))
      {
        $this->_orderCurrency = $orderCurrency;
      }

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCurrency()
    {
      return $this->_orderCurrency;
    }

    // ##########################################

    /**
     * @param $orderCustomerAddressAdditional
     * @return $this
     */
    public function setOrderCustomerAddressAdditional($orderCustomerAddressAdditional)
    {
      $this->_orderCustomerAddressAdditional = $orderCustomerAddressAdditional;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerAddressAdditional()
    {
      return $this->_orderCustomerAddressAdditional;
    }

    // ##########################################

    /**
     * @param $orderCustomerAddressCity
     * @return $this
     */
    public function setOrderCustomerAddressCity($orderCustomerAddressCity)
    {
      $this->_orderCustomerAddressCity = $orderCustomerAddressCity;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerAddressCity()
    {
      return $this->_orderCustomerAddressCity;
    }

    // ##########################################

    /**
     * @param $orderCustomerAddressCountry
     * @return $this
     */
    public function setOrderCustomerAddressCountry($orderCustomerAddressCountry)
    {
      $orderCustomerAddressCountry = strtoupper($orderCustomerAddressCountry);

      if(in_array($orderCustomerAddressCountry, $this->_getCountriesAvailable()))
      {
        $this->_orderCustomerAddressCountry = $orderCustomerAddressCountry;
      }

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerAddressCountry()
    {
      return $this->_orderCustomerAddressCountry;
    }

    // ##########################################

    /**
     * @param $orderCustomerAddressState
     * @return $this
     */
    public function setOrderCustomerAddressState($orderCustomerAddressState)
    {
      $this->_orderCustomerAddressState = $orderCustomerAddressState;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerAddressState()
    {
      return $this->_orderCustomerAddressState;
    }

    // ##########################################

    /**
     * @param $orderCustomerAddressStreet
     * @return $this
     */
    public function setOrderCustomerAddressStreet($orderCustomerAddressStreet)
    {
      $this->_orderCustomerAddressStreet = $orderCustomerAddressStreet;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerAddressStreet()
    {
      return $this->_orderCustomerAddressStreet;
    }

    // ##########################################

    /**
     * @param $orderCustomerAddressZip
     * @return $this
     */
    public function setOrderCustomerAddressZip($orderCustomerAddressZip)
    {
      $this->_orderCustomerAddressZip = $orderCustomerAddressZip;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerAddressZip()
    {
      return $this->_orderCustomerAddressZip;
    }

    // ##########################################

    /**
     * @param $orderCustomerBirthdate
     * @return $this
     */
    public function setOrderCustomerBirthdate($orderCustomerBirthdate)
    {
      $this->_orderCustomerBirthdate = $orderCustomerBirthdate;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerBirthdate()
    {
      return $this->_orderCustomerBirthdate;
    }

    // ##########################################

    /**
     * @param $orderCustomerEmail
     * @return $this
     */
    public function setOrderCustomerEmail($orderCustomerEmail)
    {
      $this->_orderCustomerEmail = $orderCustomerEmail;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerEmail()
    {
      return $this->_orderCustomerEmail;
    }

    // ##########################################

    /**
     * @param $orderCustomerFirstName
     * @return $this
     */
    public function setOrderCustomerFirstName($orderCustomerFirstName)
    {
      $this->_orderCustomerFirstName = $orderCustomerFirstName;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerFirstName()
    {
      return $this->_orderCustomerFirstName;
    }

    // ##########################################

    /**
     * @param $orderCustomerLastName
     * @return $this
     */
    public function setOrderCustomerLastName($orderCustomerLastName)
    {
      $this->_orderCustomerLastName = $orderCustomerLastName;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerLastName()
    {
      return $this->_orderCustomerLastName;
    }

    // ##########################################

    /**
     * @param $orderCustomerPhone
     * @return $this
     */
    public function setOrderCustomerPhone($orderCustomerPhone)
    {
      $this->_orderCustomerPhone = $orderCustomerPhone;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerPhone()
    {
      return $this->_orderCustomerPhone;
    }

    // ##########################################

    /**
     * @param $orderCustomerTitle
     * @return $this
     */
    public function setOrderCustomerTitle($orderCustomerTitle)
    {
      $this->_orderCustomerTitle = $orderCustomerTitle;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCustomerTitle()
    {
      return $this->_orderCustomerTitle;
    }

    // ##########################################

    /**
     * @param $label
     * @param $value
     * @return $this
     */
    public function addOrderProductDescriptions($label, $value)
    {
      if(count($this->_orderProductDescriptions) < 5)
      {
        $this->_orderProductDescriptions[] = [
          'label' => $label,
          'value' => $value,
        ];
      }

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getOrderProductDescriptions()
    {
      return $this->_orderProductDescriptions;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getOrderProductDescriptionsPrepared()
    {
      $_prepared = [];

      if(count($this->_orderProductDescriptions) > 0)
      {
        foreach($this->_orderProductDescriptions as $index => $descriptionArray)
        {
          $count = $index + 1;
          $_prepared['detail' . $count . '_description'] = $descriptionArray['label'];
          $_prepared['detail' . $count . '_text'] = $descriptionArray['value'];
        }
      }

      return $_prepared;
    }

    // ##########################################

    /**
     * @param $orderTransactionId
     * @return $this
     */
    public function setOrderTransactionId($orderTransactionId)
    {
      $this->_orderTransactionId = $orderTransactionId;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderTransactionId()
    {
      return $this->_orderTransactionId;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getLanguagesAvailable()
    {
      return $this->_languagesAvailable;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getCurrenciesAvailable()
    {
      return $this->_currencyAvailable;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getCountriesAvailable()
    {
      return $this->_countriesAvailable;
    }

    // ##########################################

    /**
     * @param $orderLanguage
     * @return $this
     */
    public function setOrderLanguage($orderLanguage)
    {
      $orderLanguage = strtolower($orderLanguage);

      if(in_array($orderLanguage, $this->_getLanguagesAvailable()))
      {
        $this->_orderLanguage = $orderLanguage;
      }

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderLanguage()
    {
      return $this->_orderLanguage;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getOrderLanguageDefault()
    {
      return $this->_orderLanguageDefault;
    }

    // ##########################################

    /**
     * @param $redirectSofortUeberweisung
     * @return $this
     */
    public function setRedirectSofortUeberweisung($redirectSofortUeberweisung)
    {
      $this->_redirectSofortUeberweisung = $redirectSofortUeberweisung !== FALSE ? 1 : 0;

      return $this;
    }

    // ##########################################

    /**
     * @return int
     */
    protected function _getRedirectSofortUeberweisung()
    {
      return $this->_redirectSofortUeberweisung;
    }

    // ##########################################

    /**
     * @param $urlCallback
     * @return $this
     */
    public function setUrlCallback($urlCallback)
    {
      $this->_urlCallback = $urlCallback;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getUrlCallback()
    {
      return $this->_urlCallback;
    }

    // ##########################################

    /**
     * @param $urlCallbackAlternative
     * @return $this
     */
    public function setUrlCallbackAlternative($urlCallbackAlternative)
    {
      $this->_urlCallbackAlternative = $urlCallbackAlternative;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getUrlCallbackAlternative()
    {
      return $this->_urlCallbackAlternative;
    }

    // ##########################################

    /**
     * @param $urlCancel
     * @return $this
     */
    public function setUrlCancel($urlCancel)
    {
      $this->_urlCancel = $urlCancel;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getUrlCancel()
    {
      return $this->_urlCancel;
    }

    // ##########################################

    /**
     * @param $urlCancelTarget
     * @return $this
     */
    public function setUrlCancelTarget($urlCancelTarget)
    {
      $this->_urlCancelTarget = $urlCancelTarget;

      return $this;
    }

    // ##########################################

    /**
     * @return int
     */
    protected function _getUrlCancelTarget()
    {
      return $this->_urlCancelTarget;
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
     * @param $urlLogo
     * @return $this
     */
    public function setUrlLogo($urlLogo)
    {
      $this->_urlLogo = $urlLogo;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getUrlLogo()
    {
      return $this->_urlLogo;
    }

    // ##########################################

    /**
     * @param $urlReturn
     * @return $this
     */
    public function setUrlReturn($urlReturn)
    {
      $this->_urlReturn = $urlReturn;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getUrlReturn()
    {
      return $this->_urlReturn;
    }

    // ##########################################

    /**
     * @param $urlReturnButtonText
     * @return $this
     */
    public function setUrlReturnButtonText($urlReturnButtonText)
    {
      $this->_urlReturnButtonText = $urlReturnButtonText;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getUrlReturnButtonText()
    {
      return $this->_urlReturnButtonText;
    }

    // ##########################################

    /**
     * @param $urlReturnTarget
     * @return $this
     */
    public function setUrlReturnTarget($urlReturnTarget)
    {
      $this->_urlReturnTarget = $urlReturnTarget;

      return $this;
    }

    // ##########################################

    /**
     * @return int
     */
    protected function _getUrlReturnTarget()
    {
      return $this->_urlReturnTarget;
    }

    // ##########################################

    /**
     * @param PaymentMethods\InterfaceSkrillPaymentMethods $abstractSkrillPaymentMethods
     * @return $this
     */
    public function setOrderEnabledPaymentMethods(InterfaceSkrillPaymentMethods $abstractSkrillPaymentMethods)
    {
      $this->_orderEnabledPaymentMethodsString = $abstractSkrillPaymentMethods->getEnabledMethodCodesAsString();

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getOrderEnabledPaymentMethods()
    {
      return $this->_orderEnabledPaymentMethodsString;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _builtCheckoutUrlParameters()
    {
      // set base data
      $data = [
        'prepare_only'          => $this->_isPreparedOrder(),
        'payment_methods'       => $this->_getOrderEnabledPaymentMethods(),
        'pay_to_email'          => $this->_getMerchantAccountEmail(),
        'recipient_description' => $this->_getMerchantName(),
        'transaction_id'        => $this->_getOrderTransactionId(),
        'return_url'            => $this->_getUrlReturn(),
        'return_url_text'       => $this->_getUrlReturnButtonText(),
        'return_url_target'     => $this->_getUrlReturnTarget(),
        'cancel_url'            => $this->_getUrlCancel(),
        'cancel_url_target'     => $this->_getUrlCancelTarget(),
        'status_url'            => $this->_getUrlCallback(),
        'status_url2'           => $this->_getUrlCallbackAlternative(),
        'new_window_redirect'   => $this->_getRedirectSofortUeberweisung(),
        'language'              => $this->_getOrderLanguage(),
        'hide_login'            => $this->_isHideLoginSection(),
        'confirmation_note'     => $this->_getOrderConfirmationNote(),
        'logo_url'              => $this->_getUrlLogo(),
        'rid'                   => $this->_getOrderAffiliateId(),
        'ext_ref_id'            => $this->_getOrderAffiliateName(),
        'pay_from_email'        => $this->_getOrderCustomerEmail(),
        'title'                 => $this->_getOrderCustomerTitle(),
        'firstname'             => $this->_getOrderCustomerFirstName(),
        'lastname'              => $this->_getOrderCustomerLastName(),
        'date_of_birth'         => $this->_getOrderCustomerBirthdate(),
        'address'               => $this->_getOrderCustomerAddressStreet(),
        'address2'              => $this->_getOrderCustomerAddressAdditional(),
        'phone_number'          => $this->_getOrderCustomerPhone(),
        'postal_code'           => $this->_getOrderCustomerAddressZip(),
        'city'                  => $this->_getOrderCustomerAddressCity(),
        'state'                 => $this->_getOrderCustomerAddressState(),
        'country'               => $this->_getOrderCustomerAddressCountry(),
        'amount'                => $this->_getOrderAmount(),
        'currency'              => $this->_getOrderCurrency(),
        'merchant_fields'       => $this->_getOrderMerchantFields(),
      ];

      // include cost descriptions
      $data = array_merge($data, $this->_getOrderCostDescriptionsPrepared());

      // include product descriptions
      $data = array_merge($data, $this->_getOrderProductDescriptions());

      // include callback data
      $data = array_merge($data, $this->_getOrderCallbackData());

      // return complete data
      return $data;
    }

    // ##########################################

    /**
     * @return $this
     * @throws \Exception
     */
    public function requestCheckoutToken()
    {
      $gatewayUrl = $this->_getUrlGatewayActive();
      $orderData = $this->_builtCheckoutUrlParameters();
      $orderDataQueryString = http_build_query($orderData);

      // request session sid (token)
      $checkoutToken = $this
        ->_getCurlClass()
        ->init($gatewayUrl)
        ->setPost(TRUE)
        ->setPostFields($orderDataQueryString)
        ->setReturnTransfer(TRUE)
        ->execute();

      // in case we cannot find any token
      if(empty($checkoutToken))
      {
        throw new \Exception('Failed to receive checkout token.', 500);
      }

      // cache token for runtime
      $this->_setOrderCheckoutToken($checkoutToken);

      return $this;
    }

    // ##########################################

    /**
     * @param $html
     * @return bool
     */
    protected function _parseCheckoutToken($html)
    {
      preg_match('/sid=([^\W]+)/', $html, $match);

      if(isset($match[1]))
      {
        return $match[1];
      }

      return FALSE;
    }

    // ##########################################

    /**
     * @param $token
     * @return $this
     */
    protected function _setOrderCheckoutToken($token)
    {
      $this->_orderCheckoutToken = $token;

      return $this;
    }

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getOrderCheckoutToken()
    {
      return $this->_orderCheckoutToken;
    }

    // ##########################################

    /**
     * @return string
     */
    public function getCheckoutUrl()
    {
      // get active gatway url (sandbox on/off)
      $gatewayUrl = $this->_getUrlGatewayActive();

      // checkout token
      $checkoutToken = $this->_getOrderCheckoutToken();

      // return combined url
      return $gatewayUrl . '?sid=' . $checkoutToken;
    }
  }

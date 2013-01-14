<?php

  namespace Simplon\Payment\Skrill\PaymentMethods;

  abstract class AbstractSkrillPaymentMethods implements InterfaceSkrillPaymentMethods
  {
    /** @var array */
    protected $_enabledMethodCodes = [];

    /**
     * Credit/Debit Cards
     */
    CONST CARD_ALL_CARD_TYPES = 'ACC';
    CONST CARD_VISA = 'VSA';
    CONST CARD_MASTERCARD = 'MSC';
    CONST CARD_VISA_DELTA_DEBIT = 'VSD';
    CONST CARD_VISA_ELECTRON = 'VSE';
    CONST CARD_MAESTRO = 'MAE';
    CONST CARD_AMERICAN_EXPRESS = 'AMX';
    CONST CARD_DINERS = 'DIN';
    CONST CARD_JCB = 'JCB';
    CONST CARD_LASER = 'LSR';
    CONST CARD_CARTE_BLEUE = 'GCB';
    CONST CARD_DANKORT = 'DNK';
    CONST CARD_POSTEPAY = 'PSP';
    CONST CARD_CARTASI = 'CSI';

    /**
     * Instant Banking Options
     */
    CONST BANK_ONLINE_BANK_TRANSFER = 'OBT';
    CONST BANK_GIROPAY = 'GIR';
    CONST BANK_DIRECT_DEBIT_ELV = 'DID';
    CONST BANK_SOFORTUEBERWEISUNG = 'SFT';
    CONST BANK_ENETS = 'ENT';
    CONST BANK_NORDEA_SOLO_SWEDEN = 'EBT';
    CONST BANK_NORDEA_SOLO_FINLAND = 'SO2';
    CONST BANK_IDEAL = 'IDL';
    CONST BANK_EPS_NETPAY = 'NPY';
    CONST BANK_POLI = 'PLI';
    CONST BANK_ALL_POLISH_BANKS = 'PWY';
    CONST BANK_ING_BANK_SLASKI = 'PWY5';
    CONST BANK_PKO_BP = 'PWY6';
    CONST BANK_MULTIBANK = 'PWY7';
    CONST BANK_LUKAS_BANK = 'PWY14';
    CONST BANK_BANK_BPH = 'PWY15';
    CONST BANK_INVESTBANK = 'PWY17';
    CONST BANK_PEKAO_SA = 'PWY18';
    CONST BANK_CITIBANK_HANDLOWY = 'PWY19';
    CONST BANK_BANK_ZACHODNI_WBK = 'PWY20';
    CONST BANK_BGZ = 'PWY21';
    CONST BANK_MILLENIUM = 'PWY22';
    CONST BANK_MBANK = 'PWY25';
    CONST BANK_PLACE_Z_INTELIGO = 'PWY26';
    CONST BANK_BANK_OCHRONY_SRODOWISKA = 'PWY28';
    CONST BANK_NORDEA_POLAND = 'PWY32';
    CONST BANK_FORTIS_BANK = 'PWY33';
    CONST BANK_DEUTSCHE_BANK_PBC = 'PWY36';
    CONST BANK_EPAY_BG = 'EPY';

    // ##########################################

    /**
     * @param $methodCode
     * @return $this
     */
    protected function _addEnabledMethodCode($methodCode)
    {
      $this->_enabledMethodCodes[] = $methodCode;

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    public function getEnabledMethodCodes()
    {
      return $this->_enabledMethodCodes;
    }

    // ##########################################

    /**
     * @return string
     */
    public function getEnabledMethodCodesAsString()
    {
      return join(',', $this->getEnabledMethodCodes());
    }
  }

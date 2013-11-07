<?php

    namespace Simplon\Payment\PayPal\Vo;

    class DoExpressCheckoutPaymentResponseVo extends AbstractVo
    {
        /**
         * @return bool|mixed
         */
        public function getToken()
        {
            return $this->_getByKey('token');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getCorrelationId()
        {
            return $this->_getByKey('correlationid');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getTransactionId()
        {
            return $this->_getByKey('paymentinfo_0_transactionid');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getTransactionType()
        {
            return $this->_getByKey('paymentinfo_0_transactiontype');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getPaymentType()
        {
            return $this->_getByKey('paymentinfo_0_paymenttype');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getOrderTime()
        {
            return $this->_getByKey('paymentinfo_0_ordertime');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getOrderAmount()
        {
            return $this->_getByKey('paymentinfo_0_amt');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getOrderTaxAmount()
        {
            return $this->_getByKey('paymentinfo_0_taxamt');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getOrderCurrencyCode()
        {
            return $this->_getByKey('paymentinfo_0_currencycode');
        }

        // ##########################################

        /**
         * The status of the payment. You can specify up to 10 payments, where n is a digit between 0 and 9, inclusive.
         * It is one of the following values:
         *
         * - none: No status.
         * - canceled-reversal: A reversal has been canceled; for example, when you win a dispute and the funds for the reversal have been returned to you.
         * - completed: The payment has been completed, and the funds have been added successfully to your account balance.
         * - denied: You denied the payment. This happens only if the payment was previously pending because of possible reasons described for the PendingReason element.
         * - expired: the authorization period for this payment has been reached.
         * - failed: The payment has failed. This happens only if the payment was made from your buyer’s bank account.
         * - in-progress: The transaction has not terminated, e.g. an authorization may be awaiting completion.
         * - partially-refunded: The payment has been partially refunded.
         * - pending: The payment is pending. See the PendingReason field for more information.
         * - refunded: You refunded the payment.
         * - reversed: A payment was reversed due to a chargeback or other type of reversal. The funds have been removed from your account balance and returned to the buyer. The reason for the reversal is specified in the ReasonCode element.
         * - processed: A payment has been accepted.
         * - voided: An authorization for this transaction has been voided.
         * - completed-funds-held: The payment has been completed, and the funds have been added successfully to your pending balance.
         *
         * See the PAYMENTINFO_n_HOLDDECISION field for more information.
         *
         * @return bool|string
         */
        public function getPaymentStatus()
        {
            $response = $this->_getByKey('paymentinfo_0_paymentstatus');

            if($response !== FALSE)
            {
                return strtolower($response);
            }

            return FALSE;
        }

        // ##########################################

        /**
         * @return bool
         */
        public function isPaymentCompleted()
        {
            if($this->getPaymentStatus() === 'completed')
            {
                return TRUE;
            }

            return FALSE;
        }

        // ##########################################

        /**
         * Reason the payment is pending. You can specify up to 10 payments, where n is a digit between 0 and 9, inclusive.
         * It is one of the following values:
         *
         * - none: No pending reason.
         * - address: The payment is pending because your buyer did not include a confirmed shipping address and your Payment Receiving Preferences is set such that you want to manually accept or deny each of these payments. To change your preference, go to the Preferences section of your Profile.
         * - authorization: The payment is pending because it has been authorized but not settled. You must capture the funds first.
         * - echeck: The payment is pending because it was made by an eCheck that has not yet cleared.
         * - intl: The payment is pending because you hold a non-U.S. account and do not have a withdrawal mechanism. You must manually accept or deny this payment from your Account Overview.
         * - multi-currency: You do not have a balance in the currency sent, and you do not have your Payment Receiving Preferences set to automatically convert and accept this payment. You must manually accept or deny this payment.
         * - order: The payment is pending because it is part of an order that has been authorized but not settled.
         * - paymentreview: The payment is pending while it is being reviewed by PayPal for risk.
         * - unilateral: The payment is pending because it was made to an email address that is not yet registered or confirmed.
         * - verify: The payment is pending because you are not yet verified. You must verify your account before you can accept this payment.
         * - other: The payment is pending for a reason other than those listed above. For more information, contact PayPal customer service.
         *
         * @return bool|string
         */
        public function getPendingReason()
        {
            $response = $this->_getByKey('paymentinfo_0_pendingreason');

            if($response !== FALSE)
            {
                return strtolower($response);
            }

            return FALSE;
        }

        // ##########################################

        /**
         * Reason for a reversal if TransactionType is reversal.
         * You can specify up to 10 payments, where n is a digit between 0 and 9, inclusive.
         * It is one of the following values:
         *
         * - chargeback: A reversal has occurred on this transaction due to a chargeback by your buyer.
         * - guarantee: A reversal has occurred on this transaction due to your buyer triggering a money-back guarantee.
         * - buyer-complaint: A reversal has occurred on this transaction due to a complaint about the transaction from your buyer.
         * - refund: A reversal has occurred on this transaction because you have given the buyer a refund.
         * - other: A reversal has occurred on this transaction due to a reason not listed above.
         *
         * @return bool|string
         */
        public function getPendingReasonCode()
        {
            $response = $this->_getByKey('paymentinfo_0_reasoncode');

            if($response !== FALSE)
            {
                return strtolower($response);
            }

            return FALSE;
        }
    }

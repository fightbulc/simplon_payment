<?php

    namespace Simplon\Payment;

    class ChargeStateConstants
    {
        CONST CREATED = 'created';
        CONST APPROVED = 'approved';
        CONST PENDING = 'pending';
        CONST COMPLETED = 'completed';
        CONST FAILED = 'failed';
        CONST INVALID = 'invalid';
        CONST REJECTED = 'rejected';
        CONST REFUNDED = 'refunded';
        CONST PROCESSING = 'processing';
        CONST UNKNOWN = 'unknown';
    }
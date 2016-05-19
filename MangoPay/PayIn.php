<?php
namespace MangoPay;

/**
 * Pay-in entity
 */
class PayIn extends Transaction
{
    /**
     * Credited wallet Id
     * @var int
     */
    public $CreditedWalletId;
    
    /**
     * PaymentType {CARD, BANK_WIRE, AUTOMATIC_DEBIT, DIRECT_DEBIT }
     * @var string
     */
    public $PaymentType;
    
    /**
     * One of PayInPaymentDetails implementations, depending on $PaymentType
     * @var object
     */
    public $PaymentDetails;
    
    /**
     * ExecutionType { WEB, TOKEN, DIRECT, PREAUTHORIZED, RECURRING_ORDER_EXECUTION }
     * @var string
     */
    public $ExecutionType;
    
    /**
     * One of PayInExecutionDetails implementations, depending on $ExecutionType
     * @var object
     */
    public $ExecutionDetails;

    /**
     * An optional description for the bank statement
     * @var string
     */
    public $StatementDescriptor;

    /**
     * Get array with mapping which property depends on other property
     * @return array
     */
    public function GetDependsObjects()
    {
        return array(
            'PaymentType' => array(
                '_property_name' => 'PaymentDetails',
                PayInPaymentType::Card => '\MangoPay\PayInPaymentDetailsCard',
                PayInPaymentType::Preauthorized => '\MangoPay\PayInPaymentDetailsPreAuthorized',
                PayInPaymentType::BankWire => '\MangoPay\PayInPaymentDetailsBankWire',
                PayInPaymentType::DirectDebit => '\MangoPay\PayInPaymentDetailsDirectDebit',
                // ...and more in future...
            ),
            'ExecutionType' => array(
                '_property_name' => 'ExecutionDetails',
                PayInExecutionType::Web => '\MangoPay\PayInExecutionDetailsWeb',
                PayInExecutionType::Direct => '\MangoPay\PayInExecutionDetailsDirect',
                // ...and more in future...
            )
        );
    }

    /**
     * Get array with read-only properties
     * @return array
     */
    public function GetReadOnlyProperties()
    {
        $properties = parent::GetReadOnlyProperties();
        array_push($properties, 'PaymentType');
        array_push($properties, 'ExecutionType');
        
        return $properties;
    }
}

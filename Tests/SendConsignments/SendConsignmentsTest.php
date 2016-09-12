<?php

/**
 * Test for split addresses from full street
 *
 * LICENSE: This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 *
 * If you want to add improvements, please create a fork in our GitHub:
 * https://github.com/myparcelnl
 *
 * @author      Reindert Vetter <reindert@myparcel.nl>
 * @copyright   2010-2016 MyParcel
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US  CC BY-NC-ND 3.0 NL
 * @link        https://github.com/myparcelnl/sdk
 * @since       File available since Release 0.1.0
 */
namespace myparcelnl\sdk\tests\SendConsignments\
SendOneConsignmentTest;

use myparcelnl\sdk\Helper\MyParcelAPI;
use myparcelnl\sdk\Model\Repository\MyParcelConsignmentRepository;


/**
 * Class SendOneConsignmentTest
 * @package myparcelnl\sdk\tests\SendConsignmentsTest
 */
class SendConsignmentsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test one shipment with createConcepts()
     */
    public function testSendOneConsignment()
    {
        $myParcelAPI = new MyParcelAPI();

        foreach ($this->additionProvider() as $consignmentTest) {

            $consignment = new MyParcelConsignmentRepository();
            $consignment
                ->setApiKey($consignmentTest['api_key'])
                ->setCountry($consignmentTest['cc'])
                ->setPerson($consignmentTest['person'])
                ->setCompany($consignmentTest['company'])
                ->setFullStreet($consignmentTest['full_street_test'])
                ->setPostalCode($consignmentTest['postal_code'])
                ->setPackageType(1)
                ->setCity($consignmentTest['city'])
                ->setEmail('reindert@myparcel.nl')

            ;
            $myParcelAPI->addConsignment($consignment);
        }

        $myParcelAPI
            ->setA4([2,4])
            ->createConcepts();
    }

    /**
     * Data for the test
     *
     * @return array
     */
    public function additionProvider()
    {
        return [
            [
                'api_key' => 'MYSNIzQWqNrYaDeFxJtVrujS9YEuF9kiykBxf8Sj',
                'cc' => 'NL',
                'person' => 'Reindert',
                'company' => 'Big Sale BV',
                'full_street_test' => 'Plein 1940-45 3b',
                'full_street' => 'Plein 1940-45 3-b',
                'street' => 'Plein 1940-45',
                'number' => 3,
                'number_suffix' => 'b',
                'postal_code' => '2231 JE',
                'city' => 'Rijnsburg',
            ],
            [
                'api_key' => 'a5cbbf2a81e3a7fe51752f51cedb157acffe6f1f',
                'cc' => 'NL',
                'person' => 'Piet',
                'company' => 'Mega Store',
                'full_street_test' => 'Koestraat 55',
                'full_street' => 'Koestraat 55',
                'street' => 'Koestraat',
                'number' => 55,
                'number_suffix' => '',
                'postal_code' => '2231 JE',
                'city' => 'Katwijk',
            ]
        ];
    }
}
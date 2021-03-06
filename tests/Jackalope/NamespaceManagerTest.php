<?php

namespace Jackalope;

class NamespaceManagerTest extends \PHPUnit_Framework_TestCase
{
    /*************************************************************************/
    /* Fixtures
    /*************************************************************************/

    /**
     * Create a list of namespaces defined by the \PHPCR\NamespaceRegistryInterface.
     *
     * @return array Set of namespaces.
     */
    public function getDefaultNamespacesFixture()
    {
        return array(
            "jcr" => "http://www.jcp.org/jcr/1.0",
            "nt"  => "http://www.jcp.org/jcr/nt/1.0",
            "mix" => "http://www.jcp.org/jcr/mix/1.0",
            "xml" => "http://www.w3.org/XML/1998/namespace",
            ""    => ""
        );
    }

    /*************************************************************************/
    /* Tests
    /*************************************************************************/

    /**
     * @covers \Jackalope\NamespaceManager::checkPrefix
     */
    public function testCheckPrefix()
    {
        $factory = new \Jackalope\Factory;
        $prefix = 'beastie';
        $ns = new NamespaceManagerProxy($factory, $this->getDefaultNamespacesFixture());

        $this->assertNull($ns->checkPrefix($prefix));
    }

    /**
     * @dataProvider checkPrefixDataprovider
     * @covers \Jackalope\NamespaceManager::checkPrefix
     * @expectedException \PHPCR\NamespaceException
     */
    public function testCheckPrefixExpexctingNamespaceException($prefix)
    {
        $factory = new \Jackalope\Factory;
        $ns = new NamespaceManagerProxy($factory, $this->getDefaultNamespacesFixture());
        $ns->checkPrefix($prefix);
    }


    /*************************************************************************/
    /* Dataprovider
    /*************************************************************************/

    public static function checkPrefixDataprovider()
    {
        return array(
            'XML as prefix' => array('xml'),
            'prefix in list of default namespaces' => array('jcr'),
            'empty prefix' => array(''),
        );
    }
}

class NamespaceManagerProxy extends \Jackalope\NamespaceManager
{
    public function checkPrefix($prefix)
    {
        return parent::checkPrefix($prefix);
    }
}
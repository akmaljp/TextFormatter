<?php

namespace s9e\TextFormatter\Tests\Configurator\Items;

use s9e\TextFormatter\Configurator\Helpers\TemplateForensics;
use s9e\TextFormatter\Configurator\Items\Template;
use s9e\TextFormatter\Tests\Test;

/**
* @covers s9e\TextFormatter\Configurator\Items\Template
*/
class TemplateTest extends Test
{
	/**
	* @testdox When cast as string, returns the template's content
	*/
	public function testToStringString()
	{
		$template = new Template('foo');

		$this->assertSame('foo', (string) $template);
	}

	/**
	* @testdox getParameters() returns the list of parameters used in this template
	*/
	public function testGetParameters()
	{
		$template = new Template('<div><xsl:value-of select="$L_FOO"/></div>');

		$this->assertSame(
			['L_FOO'],
			$template->getParameters()
		);
	}

	/**
	* @testdox asDOM() returns the template as a DOMDocument
	*/
	public function testAsDOM()
	{
		$xml      = '<div>foo</div>';
		$template = new Template($xml);

		$this->assertInstanceOf('DOMDocument', $template->asDOM());
		$this->assertContains($xml, $template->asDOM()->saveXML());
	}

	/**
	* @testdox getCSSNodes() returns all nodes that normally contain CSS
	*/
	public function testGetCSSNodes()
	{
		$template = new Template('<div style="color:red" onclick="alert(1)">foo</div>');
		$nodes    = $template->getCSSNodes();

		$this->assertSame(1, count($nodes));
		$this->assertSame('color:red', $nodes[0]->value);
	}

	/**
	* @testdox getJSNodes() returns all nodes that normally contain JS
	*/
	public function testGetJSNodes()
	{
		$template = new Template('<div style="color:red" onclick="alert(1)">foo</div>');
		$nodes    = $template->getJSNodes();

		$this->assertSame(1, count($nodes));
		$this->assertSame('alert(1)', $nodes[0]->value);
	}

	/**
	* @testdox getURLNodes() returns all nodes that normally contain a URL
	*/
	public function testGetURLNodes()
	{
		$template = new Template('<a href="{@foo}">...</a>');
		$nodes    = $template->getURLNodes();

		$this->assertSame(1, count($nodes));
		$this->assertSame('{@foo}', $nodes[0]->value);
	}

	/**
	* @testdox isNormalized() returns false by default
	*/
	public function testIsNormalizedDefault()
	{
		$template = new Template('<br/>');

		$this->assertFalse($template->isNormalized());
	}

	/**
	* @testdox isNormalized() returns true if normalize() was called
	*/
	public function testIsNormalizedCalled()
	{
		$mock = $this->getMockBuilder('s9e\\TextFormatter\\Configurator\\TemplateNormalizer')
		             ->disableOriginalConstructor()
		             ->getMock();

		$template = new Template('<br/>');
		$template->normalize($mock);

		$this->assertTrue($template->isNormalized());
	}

	/**
	* @testdox isNormalized(true) sets it to true
	*/
	public function testIsNormalizedTrue()
	{
		$template = new Template('<br/>');

		$template->isNormalized(true);
		$this->assertTrue($template->isNormalized());
	}

	/**
	* @testdox isNormalized(false) sets it to false
	*/
	public function testIsNormalizedFalse()
	{
		$template = new Template('<br/>');

		$template->isNormalized(true);
		$template->isNormalized(false);
		$this->assertFalse($template->isNormalized());
	}

	/**
	* @testdox getForensics() returns an instance of TemplateForensics based on this template's content
	*/
	public function testGetForensics()
	{
		$template = new Template('<br/>');

		$this->assertEquals(
			new TemplateForensics('<br/>'),
			$template->getForensics()
		);
	}

	/**
	* @testdox normalize() resets the cached instance of TemplateForensics
	*/
	public function testNormalizeResetsForensics()
	{
		$mock = $this->getMockBuilder('s9e\\TextFormatter\\Configurator\\TemplateNormalizer')
		             ->disableOriginalConstructor()
		             ->getMock();

		$template = new Template('<br/>');

		$instance = $template->getForensics();
		$this->assertSame($instance, $template->getForensics(), 'The instance was not cached');

		$template->normalize($mock);
		$this->assertNotSame($instance, $template->getForensics());
	}

	/**
	* @testdox replaceTokens() performs regexp-based replacements on the template's content
	*/
	public function testReplaceTokens()
	{
		$template = new Template('{FOO}');

		$template->replaceTokens(
			'/\\{.*\\}/',
			function ($m)
			{
				return ['literal', ucfirst(strtolower(trim($m[0], '{}')))];
			}
		);

		$this->assertSame('Foo', (string) $template);
	}

	/**
	* @testdox replaceTokens() resets the cached instance of TemplateForensics
	*/
	public function testReplaceTokensResetsForensics()
	{
		$template = new Template('<br/>');

		$instance = $template->getForensics();
		$this->assertSame($instance, $template->getForensics(), 'The instance was not cached');

		$template->replaceTokens('//', function () {});
		$this->assertNotSame($instance, $template->getForensics());
	}

	/**
	* @testdox replaceTokens() resets isNormalized
	*/
	public function testReplaceTokensResetsIsNormalized()
	{
		$mock = $this->getMockBuilder('s9e\\TextFormatter\\Configurator\\TemplateNormalizer')
		             ->disableOriginalConstructor()
		             ->getMock();

		$template = new Template('<br/>');
		$template->normalize($mock);

		$this->assertTrue($template->isNormalized());
		$template->replaceTokens('//', function () {});
		$this->assertFalse($template->isNormalized());
	}

	/**
	* @testdox Unknown methods such as isBlock() and isPassthrough() are forwarded to this template's TemplateForensics instance
	*/
	public function testForensicsMethods()
	{
		$template = new Template('<hr/>');

		$this->assertTrue($template->isBlock());
		$this->assertFalse($template->isPassthrough());
	}

	/**
	* @testdox setContent() updates the template's content
	*/
	public function testSetContent()
	{
		$template = new Template('<hr/>');
		$template->setContent('<br/>');

		$this->assertEquals('<br/>', $template);
	}
}
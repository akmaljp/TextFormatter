Quick rendering
===============

Quick rendering attempts to render a rich text using only string replacements. Because it does not load the XML representation in a DOM document it can be more performant than other renderers, but it is limited to operations that do not need the DOM. The main algorithm matches tags (the whole tag from `<` to `>`) in the XML representation and applies one of three methods depending on the template associated with them:

 * Static string replacement
 * Dynamic string replacement
 * Template rendering in PHP

Static string replacement
-------------------------
Limited to templates that contain one `xsl:apply-templates` element with no `select` expression, no other XSL elements and no [attribute value templates](http://www.w3.org/TR/xslt#attribute-value-templates). The template is split in half (using `xsl:apply-templates` as the cutting point) and either side can be replaced with a static string. For instance, consider a tag named `B` using the following template:
```xsl
<b><xsl:apply-templates/></b>
```
The template can be split into `<b>` and `</b>`. In order to render this tag, all we need is to replace `<B>` and `</B>` in the XML with `<b>` and `</b>`.

Now consider the following template from a `URL` tag:
```xsl
<a href="{@url}"><xsl:apply-templates/></a>
```
The first half of the template is dynamic, but the second half is static. That means we can replace `</URL>` tags in the XML with `</a>`.

Dynamic string replacement
--------------------------
Similar to static string replacement, it uses `preg_replace()` to replace the matched tag. It has the same limitations except that it supports attribute value templates and `xsl:copy-of` elements that copy a single attribute. Going back to the previous `URL` example, dynamic string replacement can be used to render the first half of the template. We only need to build a regular expression that matches the whole of the start tag and a replacement that generates the desired HTML. Attributes in the XML representation are kept in lexical order, they are always preceded with one single space and their value is always enclosed within double quotes.

```
  Input: <URL url="http://example.org">
  Match: (.*(?: url="([^"]+)")?.*)Us
Replace: <a href="$1">
```

Template rendering in PHP
-------------------------
Same as the normal PHP renderer but with attribute values captured via `preg_match()`. The source is modified with raw `str_replace()`/`preg_replace()` calls because all of the code that is modified uses the object operator `->`. That sequence of characters could not appear in a normal, therefore we don't inadvertently replace template content.

List of replacements:

```php
$node->getAttribute('foo')
$attributes['foo']
```
```php
$node->hasAttribute('foo')
isset($attributes['foo'])
```
```php
$this->out.=
$html.=
```
```php
// Only available to templates with no <xsl:apply-templates/> element
$node->textContent
$textContent
```

If there's any object operator `->` left after replacements (with the exception of the one in `$this->params`) it means that this template cannot be rendered by the Quick renderer.

How to deal with templates with no `xsl:apply-templates` element
----------------------------------------------------------------
First we need to identify them. Then we create the main regexp to match XML tags two ways:
  - for tags whose template does *not* contain an `xsl:apply-element` we either match tag pairs, e.g. `<X>...</X>` or empty elements, e.g. `<X/>`. If a child element has been captured between the tag, we need to abort. Otherwise, anything between `>` and `<` is stored unescaped in `$textContent`
  - for all other tags, we use a "catch-all" expression for the tag name and we match single tags: either `<X>` or `</X>`

How to render empty elements
----------------------------
If we match `<X foo=".."/>` we must respond with either of two actions:

  - for tags whose template does *not* contain an `xsl:apply-element` we re-execute the callback with the arguments that would correspond to `<X foo=".."></X>`
  - otherwise, we return the concatenation of two callback executions with arguments that correspond to `<X foo="..">` and `</X>` respectively

How to test whether a parsed text can be rendered with the Quick renderer
-------------------------------------------------------------------------
The Quick renderer has a static variable named `$quickRenderingTest` that contains a regular expression that determines whether the XML representation can be rendered quickly. This only applies to well-formed XML as generated by the parser. It does *not* test for XML validity.
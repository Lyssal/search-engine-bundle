# The Lyssal search engine bundle


The Lyssal SEO bundle permits you to use the Page entity for all your URLs and SEO informations (as title, description, author, etc ; see the Page and Website properties).

The slugs are automatically generated and you can use the Twig templates to autoamtically generate the meta tags.


## Available search engines

* AOL
* Ask
* Baidu
* Bing
* DuckDuckGo
* Ecosia
* Exalead
* Google
* Lilo
* Million Short
* MyWebSearch
* Qwant
* Startpage
* WOW
* Yahoo!

Loot at `Lyssal\SearchEngine\Engine\SearchEngine` for labels to use for each search engine.

## Installation

Read the [installation documentation](doc/Installation.md).


## How to use

Read the [How to use documentation](doc/HowToUse.md).


## The sitemap.xml

Read the [sitemap documentation](doc/Sitemap.md).


## About properties

Read the [properties documentation](doc/Properties.md).


## EasyAdmin

If you use EasyAdmin, please read the [EasyAdmin documentation](doc/EasyAdmin.md).


## PhpDoc

Execute :

```sh
phpdoc -c doc/phpdoc.tpl.xml
```
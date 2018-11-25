# The Lyssal search engine bundle

The Lyssal search engine bundle permits you to generate a form using external search engines (like Qwant or Google).

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

To generate the form:

```twig
{{- lyssal_searchengine_display() -}}
```


## Installation

Read the [installation documentation](doc/Installation.md).


## Specify a search engine

To specify the search engine to use, read the [Search engine documentation](doc/SearchEngine.md).


## The template

To know how to use the template, read the [Template documentation](doc/Template.md).


## The website

To specify the website in which we search, read the [Website documentation](doc/Website.md).

# The search engine

## Define the search engine by default

Change your configuration:

```yaml
lyssal_search_engine:
    search_engine:
        default: 'qwant'
```

## Specifify an other search engine in the template

Specify the `searchEngine` parameter:

```twig
{{- lyssal_searchengine_display({ 'searchEngine': 'google' }) -}}
```

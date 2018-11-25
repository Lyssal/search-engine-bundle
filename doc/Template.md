# The template

## The form template

### Call the form in the template

```twig
{{- render(controller('Lyssal\\SearchEngineBundle\\Controller\\SearchController:form')) -}}
```

### Specifify a specific template

In your config:

```yaml
lyssal_search_engine:
    templating:
        form_template: 'foundation_6'
```

Available templates are:
* `default` (by default)
* `bootstrap_4`
* `foundation_6`

If you want to use your own template, you can simply overload `@LyssalSearchEngineBundle/search/form/default.html.twig`.

Or you can specify the `template` parameter:

For example:
```twig
{{- render(controller('Lyssal\\SearchEngineBundle\\Controller\\SearchController:form', { 'template': 'foundation_6' })) -}}
```


## Define the submit button value

In your config:

```yaml
lyssal_search_engine:
    templating:
        submit_value: 'OK'
```

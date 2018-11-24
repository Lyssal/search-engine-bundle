# The website

By default, the search uses the current host.


## Search in an other website

You can define an other website specifying the `website` parameter:

```twig
{{- render(controller('Lyssal\\SearchEngineBundle\\Controller\\SearchController:form', { 'website': 'www.lyssal.net' })) -}}
```

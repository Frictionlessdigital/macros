# Upgrade Guide

## `Collection::oxford()`

The `oxford()` macro now formats the values already in the collection. Its
signature changed from `oxford($key, ?int $limit = null, string $locale = 'en')`
to `oxford(?int $limit = null, string $locale = 'en')`.

For collections of arrays or models where values must first be selected by a
key, use the new `oxfordByKey()` macro instead:

```php
// Before
collect($users)->oxford('name', 2);

// After
collect($users)->oxfordByKey('name', 2);
```

For a collection of values, pass the limit as the first argument:

```php
collect(['Anna', 'Poster', 'Cyrill'])->oxford(2);
```

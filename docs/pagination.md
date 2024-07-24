The grid automatically paginates your data. This is by done using a customized version of laravel's bootstrap 4 pagination 
templates. Pagination behavior can be configured in the published config file. (Under the `pagination` key).

# Default page size
This is the eloquent default of 15

# Pagination types supported
The grid supports both `simple` and the `default` pagination standards already existing in laravel.

# Pagination sizes per grid
Each grid can have a different page size. This is set in the grid attributes under the pagination['size'] key.
E.g. 
```php
return $grid->create(
  [
    'query' => $query, 
    'request' => $request, 
    'pagination' => [
      'size' => 100
    ]
   ]
);
```

# Previous
[Customization](customization.md)

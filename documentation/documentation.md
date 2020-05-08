FORMAT: 1A
HOST: IMDB
# IMDB

IMDB is really cool application developed using Larakicks.

## API URL
All requests should be sent to http://127.0.0.1:8000/api

## Filters
Filters are used as a suffix of a field name:
+ <code>eq</code>: Equals
+ <code>ne</code>: Not equals
+ <code>lt</code>: Lower than
+ <code>gt</code>: Greater than
+ <code>lte</code>: Lower than or equal to
+ <code>gte</code>: Greater than or equal to
+ <code>in</code>: Included in an array of values
+ <code>nin</code>: Isn't included in an array of values
+ <code>cnt</code>: Contains
+ <code>ncnt</code>: Doesn't contain
+ <code>nil</code>: Is null
+ <code>nnil</code>: Is not null
+ <code>btw</code>: Between
+ <code>nbtw</code>: Not between

#### Examples
<strong>Find records having cake as name and having price lower than 100.</strong>
+ <p><code>?name_eq=cake&price_lt=100</code></p>
<strong>Find records having weight between 50 and 60 and belongs to cereals or food products</strong>
+ <p><code>?weight_btw=50,60&type_in=cereals,food</code></p>

## Sort
Sort according to a specific field
+ <p><code>?_sort=email:asc,dateField:desc</code></p>
+ <p><code>?_sort=email:DESC,username:ASC</code></p>

## Pagination
+ <code>_limit=20</code> - Limit the size of the returned results.(Default = 100, Max = 100)
+ <code>page=2</code> - Skip a specific number of entries (Default = 0,
 if <code>page=2</code> and <code>_limit=20</code> result will skip first 40 records)

# Group Authentication

<!-- include(authentication.md) -->

# Group Forgot Password

<!-- include(forgot_password.md) -->

# Group Actor
Endpoints for Actor resource are listed below

<!-- include(actors.md) -->

# Group Comment
Endpoints for Comment resource are listed below

<!-- include(comments.md) -->

# Group Director
Endpoints for Director resource are listed below

<!-- include(directors.md) -->

# Group Movie
Endpoints for Movie resource are listed below

<!-- include(movies.md) -->

# Group User
Endpoints for User resource are listed below

<!-- include(users.md) -->



<!-- include(data_structures.md) -->
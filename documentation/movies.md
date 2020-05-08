## <code>/movies</code> [/movies]

### Search for items [GET]
##### Available includes: [actors, directors, favoritedUsers, wishlistedUsers]
##### Available parameters <a href="#header-filters">See more...</a>
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Movie, Movie])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [actors, directors, favoritedUsers, wishlistedUsers]
+ Request Rules:
    {
            "name": 'required',
            "genre": 'required|in:'.MovieGenres::stringify(),
            "release_date": 'nullable|date',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "name": et (string),
            "genre": enum1 (string),
            "release_date": 2020-03-06 (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Movie successfully created (string)
        + data: (Movie)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## <code>/movies/bulk</code> [/movies/bulk]
### Bulk create items [POST]
Available includes: [actors, directors, favoritedUsers, wishlistedUsers]
+ Request Rules:
    [
        {
            "name": 'required',
            "genre": 'required|in:'.MovieGenres::stringify(),
            "release_date": 'nullable|date',

        },
        {
            "name": 'required',
            "genre": 'required|in:'.MovieGenres::stringify(),
            "release_date": 'nullable|date',

        },
    ]
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    [
        {
            "name": vitae (string),
            "genre": enum1 (string),
            "release_date": 2020-01-30 (string),

        },
        {
            "name": vitae (string),
            "genre": enum1 (string),
            "release_date": 2020-01-30 (string),

        },
    ]
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Group of Movies successfully created (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Bulk delete items [DELETE]
+ Request (application/json)
    <!-- include(request/header.md) -->    
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Group of Movies successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## <code>/movies/{id}</code> [/movies/{id}]
### Update item [PUT]
Available includes: [actors, directors, favoritedUsers, wishlistedUsers]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
            "name": 'required',
            "genre": 'required|in:'.MovieGenres::stringify(),
            "release_date": 'nullable|date',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "name": alias (string),
            "genre": enum1 (string),
            "release_date": 2020-04-07 (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Movie successfully updated (string)
        + data: (Movie)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [actors, directors, favoritedUsers, wishlistedUsers]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Movie)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->
### Delete item [DELETE]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->    
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Movie successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->


## <code>/movies/{id}/favorited-users</code> [/movies/{id}/favorited-users]
### Search for favoritedUsers [GET]
##### Available includes: [userSessions, roles, socialNetworks, favoriteMovies, wishlistMovies, comments]
##### Available parameters <a href="#header-filters">See more...</a>
+ Parameters


    + id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

## <code>/movies/</code> [/movies/]

## <code>/movies/{id}/wishlisted-users</code> [/movies/{id}/wishlisted-users]
### Search for wishlistedUsers [GET]
##### Available includes: [userSessions, roles, socialNetworks, favoriteMovies, wishlistMovies, comments]
##### Available parameters <a href="#header-filters">See more...</a>
+ Parameters


    + id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

## <code>/movies/</code> [/movies/]

## <code>/movies/{id}/actors</code> [/movies/{id}/actors]
### Search for actors [GET]
##### Available includes: [movies]
##### Available parameters <a href="#header-filters">See more...</a>
+ Parameters


    + id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

## <code>/movies/{id}/actors/{actor_id}</code> [/movies/{id}/actors/{actor_id}]
### Add Actor to actors [POST]
+ Parameters


    + id: 1 (number)
    + actor_id: 1 (number)
+ Request Rules:
    {
            "role": 'required',
            "role_type": 'required|in:'.MoviesActorRoleTypes::stringify(),

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "role": provident (string),
            "role_type": enum1 (string),

    }


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

### Remove Actor from actors [DELETE]
+ Parameters


    + id: 1 (number)
    + actor_id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
## <code>/movies/{id}/directors</code> [/movies/{id}/directors]
### Search for directors [GET]
##### Available includes: [movies]
##### Available parameters <a href="#header-filters">See more...</a>
+ Parameters


    + id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

## <code>/movies/{id}/directors/{director_id}</code> [/movies/{id}/directors/{director_id}]
### Add Director to directors [POST]
+ Parameters


    + id: 1 (number)
    + director_id: 1 (number)
+ Request Rules:
    {

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {

    }


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

### Remove Director from directors [DELETE]
+ Parameters


    + id: 1 (number)
    + director_id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


## <code>/users/me</code> [/users/me]
### Update item [PUT]
Available includes: [userSessions, roles, socialNetworks, favoriteMovies, wishlistMovies, comments]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
            "name": 'required',
            "avatar": 'nullable|image',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "name": tenetur (string),
            "avatar": at (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: User successfully updated (string)
        + data: (User)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [user]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (User)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## <code>/users/favorite-movies</code> [/users/favorite-movies]
### Search for favoriteMovies [GET]
##### Available includes: [actors, directors, favoritedUsers, wishlistedUsers]
##### Available parameters <a href="#header-filters">See more...</a>
+ Parameters


+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

## <code>/users/favorite-movies/{movie_id}</code> [/users/favorite-movies/{movie_id}]
### Add Movie to favoriteMovies [POST]
+ Parameters


    + movie_id: 1 (number)
+ Request Rules:
    {
            "note": 'nullable',
            "rate": 'nullable|integer',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "note": reiciendis (string),
            "rate": 5 (number),

    }


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

### Remove Movie from favoriteMovies [DELETE]
+ Parameters


    + movie_id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
## <code>/users/wishlist-movies</code> [/users/wishlist-movies]
### Search for wishlistMovies [GET]
##### Available includes: [actors, directors, favoritedUsers, wishlistedUsers]
##### Available parameters <a href="#header-filters">See more...</a>
+ Parameters


+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

## <code>/users/wishlist-movies/{movie_id}</code> [/users/wishlist-movies/{movie_id}]
### Add Movie to wishlistMovies [POST]
+ Parameters


    + movie_id: 1 (number)
+ Request Rules:
    {
            "note": 'nullable',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "note": tenetur (string),

    }


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

### Remove Movie from wishlistMovies [DELETE]
+ Parameters


    + movie_id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
## <code>/users/comments</code> [/users/comments]
### Search for comments [GET]
##### Available includes: [creator]
##### Available parameters <a href="#header-filters">See more...</a>
+ Parameters


+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

## <code>/users/</code> [/users/]


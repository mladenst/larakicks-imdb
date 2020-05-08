## <code>/actors</code> [/actors]

### Search for items [GET]
##### Available includes: [movies]
##### Available parameters <a href="#header-filters">See more...</a>
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Actor, Actor])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [movies]
+ Request Rules:
    {
            "firstname": 'required',
            "lastname": 'required',
            "dob": 'nullable|date',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "firstname": quibusdam (string),
            "lastname": voluptate (string),
            "dob": 2020-02-23 (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Actor successfully created (string)
        + data: (Actor)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## <code>/actors/bulk</code> [/actors/bulk]
### Bulk create items [POST]
Available includes: [movies]
+ Request Rules:
    [
        {
            "firstname": 'required',
            "lastname": 'required',
            "dob": 'nullable|date',

        },
        {
            "firstname": 'required',
            "lastname": 'required',
            "dob": 'nullable|date',

        },
    ]
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    [
        {
            "firstname": velit (string),
            "lastname": aperiam (string),
            "dob": 2020-02-14 (string),

        },
        {
            "firstname": velit (string),
            "lastname": aperiam (string),
            "dob": 2020-02-14 (string),

        },
    ]
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Group of Actors successfully created (string)
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
        + message: Group of Actors successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## <code>/actors/{id}</code> [/actors/{id}]
### Update item [PUT]
Available includes: [movies]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
            "firstname": 'required',
            "lastname": 'required',
            "dob": 'nullable|date',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "firstname": fugiat (string),
            "lastname": facere (string),
            "dob": 2020-04-22 (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Actor successfully updated (string)
        + data: (Actor)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [movies]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Actor)

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
        + message: Actor successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->


## <code>/actors/{id}/movies</code> [/actors/{id}/movies]
### Search for movies [GET]
##### Available includes: [actors, directors, favoritedUsers, wishlistedUsers]
##### Available parameters <a href="#header-filters">See more...</a>
+ Parameters


    + id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

## <code>/actors/{id}/movies/{movie_id}</code> [/actors/{id}/movies/{movie_id}]
### Add Movie to movies [POST]
+ Parameters


    + id: 1 (number)
    + movie_id: 1 (number)
+ Request Rules:
    {
            "role": 'required',
            "role_type": 'required|in:'.MoviesActorRoleTypes::stringify(),

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "role": quisquam (string),
            "role_type": enum1 (string),

    }


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->

### Remove Movie from movies [DELETE]
+ Parameters


    + id: 1 (number)
    + movie_id: 1 (number)
+ Request (application/json)
    <!-- include(request/header.md) -->


<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


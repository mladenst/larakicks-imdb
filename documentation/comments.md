## <code>/comments</code> [/comments]

### Search for items [GET]
##### Available includes: [creator]
##### Available parameters <a href="#header-filters">See more...</a>
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Comment, Comment])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [creator]
+ Request Rules:
    {
            "text": 'required',
            "rate": 'nullable|integer',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "text": modi (string),
            "rate": 5 (number),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Comment successfully created (string)
        + data: (Comment)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## <code>/comments/bulk</code> [/comments/bulk]
### Bulk create items [POST]
Available includes: [creator]
+ Request Rules:
    [
        {
            "text": 'required',
            "rate": 'nullable|integer',

        },
        {
            "text": 'required',
            "rate": 'nullable|integer',

        },
    ]
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    [
        {
            "text": qui (string),
            "rate": 11 (number),

        },
        {
            "text": qui (string),
            "rate": 11 (number),

        },
    ]
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Group of Comments successfully created (string)
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
        + message: Group of Comments successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## <code>/comments/{id}</code> [/comments/{id}]
### Update item [PUT]
Available includes: [creator]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
            "text": 'required',
            "rate": 'nullable|integer',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "text": aut (string),
            "rate": 9 (number),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Comment successfully updated (string)
        + data: (Comment)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [creator]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Comment)

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
        + message: Comment successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->




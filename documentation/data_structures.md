# Data Structures

## Date (object)

+ date: `2017-09-02 19:03:58.000000` (string)   

+ timezone_type: 3 (number)

+ timezone: UTC (string)

## Token (object)
+ token: `eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly96aXBwZ28uZGV2L2FwaS9sb2dpbiIsImlhdCI6MTUxMTM1NzU4NywiZXhwIjoxNTExMzYxMTg3LCJuYmYiOjE1MTEzNTc1ODcsImp0aSI6InNQQ3RpcVN3bERBYUlmOGwifQ.CCU7Yf4cwNhzsyhOHed_WkBGRqsHCD_b-BgEQhAQsMY` (string)
   Unique jwt token for user   

## Pagination (object)

  + total: 1500 (number)

     total elements

  + count: 15 (number)

    count elements

  + per_page: 15 (number)

    total elements per page default 15

  + current_page: 2 (number)

    current page

  + total_pages: 100 (number)

    total pages

  + links
      + previous: http://127.0.0.1:8000/api/{resource}?page=1 (string)

        Link to previous page

      + next: http://127.0.0.1:8000/api/{resource}?page=3 (string)

        Link to next page

## Actor (object)

+ firstname: `qui` (string)

+ lastname: `non` (string)

+ dob: `2020-05-05` (string)



## Comment (object)

+ text: `ipsam` (string)

+ rate: `11` (number)



## Director (object)

+ firstname: `nemo` (string)

+ lastname: `voluptates` (string)

+ dob: `2020-03-31` (string)



## Movie (object)

+ name: `autem` (string)

+ genre: `enum1` (string)

+ release_date: `2020-03-18` (string)



## User (object)

+ email: `molestias` (string)

+ password_updated: `2020-02-08 09:02:57` (string)

+ last_login: `2020-04-04 09:02:57` (string)






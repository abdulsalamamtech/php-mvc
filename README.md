
**This is a dynamic mvc framework for api and full stack application**


**MVC PHP API**
>>>*Users*



Creating new user
class = store
method = POST
*https://app.com/users/*

{
    "data": {
        "name": "Munir Muhammad",
        "email": "munirmuhammad37@gmail.com",
        "password": 1234
    }
}

Response

{
    "status": "200",
    "success": "true",
    "message": "successful",
    "data": {
        "id": "21"
    }
}



Creating new user
data can also be pass using query parameters
class = store
method = POST
*https://app.com/users/?name=abdulsalam&email=abdulsalam@gmail.com&password=1234*
OR
*https://app.com/users/?_method=post&name=abdulsalam&email=abdulsalam@gmail.com&password=1234*

Response

{
    "status": "200",
    "success": "true",
    "message": "successful",
    "data": {
        "id": "22"
    }
}



Showing users
Get user by id
class = show
method = GET
*https://app.com/users/23/*
OR
*https://app.com/users/?id=23*
OR
*https://app.com/users/?_method=get&id=23*

{
    "status": "200",
    "success": "true",
    "message": "successful",
    "data": {
        "id": 23,
        "name": " Abdulrahman Abdulsalam",
        "email": "abdulsalamamtech@gmail.com",
        "status": 1
    }
}





Update user
class = update
method = UPDATE
*https://app.com/users/30/*
OR
*https://app.com/users/?id=30*
OR
*https://app.com/users/?_method=update&id=30*

{
   "status": "200",
    "success": "true",
    "message": "update successful",
    "data": {
        "id": 30
    }
}





Delete user
class = delete
method = DELETE
*https://app.com/users/23/*
OR
*https://app.com/users/?id=23*
OR
*https://app.com/users/?_method=delete&id=23*

Response

{
   "status": "200",
    "success": "true",
    "message": "delete successful",
    "data": {
        "id": 23
    }
}





Showing users
Get all users
class = index
method = GET
*https://app.com/users/*
OR
pagination of users
*https://app.com/users/page/2/*
OR
limiting users
*https://app.com/users/limit/2/*
OR
pagination and limit
*https://app.com/users/page/2/limit/2/*


Response

{
    "status": "200",
    "success": "true",
    "message": "sucessfull",
    "data": [
        {
            "id": 38,
            "name": "Munir Muhammad",
            "email": "munirmuhammad42@gmail.com",
            "password": "$2y$10$QRpd\/.f16Td4os1S0te6Ue5LYkBXGNT7ONXhVSDpgBivOk3\/MgmFu",
            "status": 1,
            "updated_at": "2023-11-13 19:54:29",
            "created_at": "2023-11-13 19:54:29"
        },
        {
            "id": 37,
            "name": "Munir Muhammad",
            "email": "munirmuhammad16@gmail.com",
            "password": "$2y$10$isDMFA6vf9TGZ5sQtYW\/..pAvgIloKZJh73ozNfWdPAU1ComTtbcq",
            "status": 1,
            "updated_at": "2023-11-13 19:53:24",
            "created_at": "2023-11-13 19:53:24"
        }
    ]
}

=========
>>>>>>>>> Temporary merge branch 2

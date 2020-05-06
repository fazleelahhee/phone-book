---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://phone-book.local/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_2be1f0e022faf424f18f30275e61416e -->
## User login

[User login ]

> Example request:

```bash
curl -X POST \
    "http://phone-book.local/api/v1/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"et","password":"autem"}'

```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "et",
    "password": "autem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLC...dfgsdfg",
        "token_type": "Bearer",
        "expires_at": "2020-09-28 16:00:00"
    }
}
```
> Example response (401):

```json
{
    "message": "Incorrect email or password"
}
```
> Example response (429):

```json
{
    "message": "Too many requests has been made. Application has been temporarily locked for # minutes"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ]
    }
}
```

### HTTP Request
`POST api/v1/auth/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | Email needed to login.
        `password` | string |  required  | Password needed to login.
    
<!-- END_2be1f0e022faf424f18f30275e61416e -->

<!-- START_3157fb6d77831463001829403e201c3e -->
## User registration
{Allow user to register with fatface reward app}

> Example request:

```bash
curl -X POST \
    "http://phone-book.local/api/v1/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"facilis","email":"et","password":"sit"}'

```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/auth/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "facilis",
    "email": "et",
    "password": "sit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLC...dfgsdfg",
        "token_type": "Bearer",
        "expires_at": "2020-09-28 16:00:00"
    }
}
```
> Example response (422):

```json
null
```

### HTTP Request
`POST api/v1/auth/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Name is required for the registration.
        `email` | string |  required  | Email is required for the registration and will be used a username & must be unique.
        `password` | string |  required  | Password min 8 chars.
    
<!-- END_3157fb6d77831463001829403e201c3e -->

<!-- START_715f1d73092629748c4397de566ea310 -->
## User Logout
{User logged out from app.}

> Example request:

```bash
curl -X GET \
    -G "http://phone-book.local/api/v1/auth/logout" \
    -H "Authorization: Bearer {your-token}" \
    -H "X-Property-Id: must include unique device id with the header." \
    -H "Accept: application/json" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/auth/logout"
);

let headers = {
    "Authorization": "Bearer {your-token}",
    "X-Property-Id": "must include unique device id with the header.",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "message": "Successfully logged out"
    }
}
```
> Example response (401):

```json
{
    "message": "Unauthorized"
}
```

### HTTP Request
`GET api/v1/auth/logout`


<!-- END_715f1d73092629748c4397de566ea310 -->

<!-- START_773f554f29afdcf9a3ddd2ed6fb3989a -->
## Display a listing of the phone books.

> Example request:

```bash
curl -X GET \
    -G "http://phone-book.local/api/v1/phone-books" \
    -H "Authorization: Bearer {your-token}" \
    -H "X-Property-Id: must include unique device id with the header." \
    -H "Accept: application/json" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/phone-books"
);

let headers = {
    "Authorization": "Bearer {your-token}",
    "X-Property-Id": "must include unique device id with the header.",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET api/v1/phone-books`


<!-- END_773f554f29afdcf9a3ddd2ed6fb3989a -->

<!-- START_926a7cf847da20f70a07c0315399c75e -->
## Show the fields for creating a new phone book item.

> Example request:

```bash
curl -X GET \
    -G "http://phone-book.local/api/v1/phone-books/create" \
    -H "Authorization: Bearer {your-token}" \
    -H "X-Property-Id: must include unique device id with the header." \
    -H "Accept: application/json" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/phone-books/create"
);

let headers = {
    "Authorization": "Bearer {your-token}",
    "X-Property-Id": "must include unique device id with the header.",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET api/v1/phone-books/create`


<!-- END_926a7cf847da20f70a07c0315399c75e -->

<!-- START_20a6ae71ce368464c919286a7377e251 -->
## Store a newly created phone book item in storage.

> Example request:

```bash
curl -X POST \
    "http://phone-book.local/api/v1/phone-books" \
    -H "Authorization: Bearer {your-token}" \
    -H "X-Property-Id: must include unique device id with the header." \
    -H "Accept: application/json" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/phone-books"
);

let headers = {
    "Authorization": "Bearer {your-token}",
    "X-Property-Id": "must include unique device id with the header.",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/phone-books`


<!-- END_20a6ae71ce368464c919286a7377e251 -->

<!-- START_0ba7dc912e48d2def8aac7f343629a09 -->
## Display the specified phone book item.

> Example request:

```bash
curl -X GET \
    -G "http://phone-book.local/api/v1/phone-books/1" \
    -H "Authorization: Bearer {your-token}" \
    -H "X-Property-Id: must include unique device id with the header." \
    -H "Accept: application/json" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/phone-books/1"
);

let headers = {
    "Authorization": "Bearer {your-token}",
    "X-Property-Id": "must include unique device id with the header.",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET api/v1/phone-books/{phone_book}`


<!-- END_0ba7dc912e48d2def8aac7f343629a09 -->

<!-- START_2ccd82ea10006e4d70eb6fef1755b6c3 -->
## Show the form for editing the specified phone book item.

> Example request:

```bash
curl -X GET \
    -G "http://phone-book.local/api/v1/phone-books/1/edit" \
    -H "Authorization: Bearer {your-token}" \
    -H "X-Property-Id: must include unique device id with the header." \
    -H "Accept: application/json" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/phone-books/1/edit"
);

let headers = {
    "Authorization": "Bearer {your-token}",
    "X-Property-Id": "must include unique device id with the header.",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET api/v1/phone-books/{phone_book}/edit`


<!-- END_2ccd82ea10006e4d70eb6fef1755b6c3 -->

<!-- START_904b14214b5b2ddb340ad5b339835e0a -->
## Update the specified phone book item in storage.

> Example request:

```bash
curl -X PUT \
    "http://phone-book.local/api/v1/phone-books/1" \
    -H "Authorization: Bearer {your-token}" \
    -H "X-Property-Id: must include unique device id with the header." \
    -H "Accept: application/json" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/phone-books/1"
);

let headers = {
    "Authorization": "Bearer {your-token}",
    "X-Property-Id": "must include unique device id with the header.",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/phone-books/{phone_book}`

`PATCH api/v1/phone-books/{phone_book}`


<!-- END_904b14214b5b2ddb340ad5b339835e0a -->

<!-- START_61bffa72de729f072754721e5a3e34c4 -->
## Remove the specified phone book item from storage.

> Example request:

```bash
curl -X DELETE \
    "http://phone-book.local/api/v1/phone-books/1" \
    -H "Authorization: Bearer {your-token}" \
    -H "X-Property-Id: must include unique device id with the header." \
    -H "Accept: application/json" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL(
    "http://phone-book.local/api/v1/phone-books/1"
);

let headers = {
    "Authorization": "Bearer {your-token}",
    "X-Property-Id": "must include unique device id with the header.",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/phone-books/{phone_book}`


<!-- END_61bffa72de729f072754721e5a3e34c4 -->



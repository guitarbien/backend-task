This assignment was built with :

- Laradock (Docker Engine: 18.06.0-ce, PHP 7.2, Laravel 5.6.33, MySQL 5.7)
- macOS 10.13.6
- PhpStorm 2018.2.1

## The API list & request example :

#### get a token

```http request
POST /api/token HTTP/1.1
Host: backend-task.test
Cache-Control: no-cache
Content-Type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW
```

#### get token status

```http request
GET /api/token HTTP/1.1
Host: backend-task.test
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NTU2NiwiZXhwIjoxNTM0NjEyNjYxfQ.5eht1EV9hsmR38tSeqs2NX3cUrkCgV63ZE5E6as6jjQ
Cache-Control: no-cache
```

#### refresh token

```http request
PUT /api/token HTTP/1.1
Host: backend-task.test
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NTU2NiwiZXhwIjoxNTM0NjEyNjAxfQ.3L-g3mv8VfCzntqPh6mcf6OvkP8K9-RVRi-AiJXfOLc
Cache-Control: no-cache
Content-Type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW
```

#### add a todo

```http request
POST /api/todos HTTP/1.1
Host: backend-task.test
Content-Type: application/json
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NTU2NiwiZXhwIjoxNTM0NjEyOTEzfQ.OGi9BDVQc0NX1L9j6aMm1m7HWsGCFNwfU821kxx6iiM
Cache-Control: no-cache

{"title": "title 03", "content": "content 03"}
```

#### get a todo

```http request
GET /api/todos/1 HTTP/1.1
Host: backend-task.test
Accept: application/json
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NTU2NiwiZXhwIjoxNTM0NjEyOTEzfQ.OGi9BDVQc0NX1L9j6aMm1m7HWsGCFNwfU821kxx6iiM
Cache-Control: no-cache
```

#### get all todos

```http request
GET /api/todos HTTP/1.1
Host: backend-task.test
Accept: application/json
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NTU2NiwiZXhwIjoxNTM0NjEzNDIzfQ.CdOXb0xbfGKe_AdE-_l6FnmM0SUr4NS5C03iLT6GgCY
Cache-Control: no-cache
```

#### update a todo

```http request
PUT /api/todos/1 HTTP/1.1
Host: backend-task.test
Content-Type: application/json
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NTU2NiwiZXhwIjoxNTM0NjEyOTEzfQ.OGi9BDVQc0NX1L9j6aMm1m7HWsGCFNwfU821kxx6iiM
Cache-Control: no-cache

{"title": "title 111", "content": "content 111"}
```

#### delete a todo

```http request
DELETE /api/todos/1 HTTP/1.1
Host: backend-task.test
Accept: application/json
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NTU2NiwiZXhwIjoxNTM0NjEyOTEzfQ.OGi9BDVQc0NX1L9j6aMm1m7HWsGCFNwfU821kxx6iiM
Cache-Control: no-cache
Content-Type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW
```

#### batch delete todos

```http request
DELETE /api/todos HTTP/1.1
Host: backend-task.test
Accept: application/json
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NTU2NiwiZXhwIjoxNTM0NjEzNDIzfQ.CdOXb0xbfGKe_AdE-_l6FnmM0SUr4NS5C03iLT6GgCY
Content-Type: application/json
Cache-Control: no-cache

{"todos":[{"id":2},{"id":3}]}
```
 
## API Reference
### Signup User

#### URL
```http
POST /api/signup/
```

#### Request
```json
{
    "email":"test001@gmail.com",
    "username":"username_001",
    "password":"User001$"
}
```
#### Response
```json
{
    "code": 2000,
    "message": "user is created , verify with otp code",
    "data": {
        "token": "e4e98a42399835ea7a9c73ec8f7e16c0e8146b4e5b3e7c79c435456c587217a0"
    }
}
```

<br />

### Verify email with OTP
#### URL
```http
POST /api/otp/verify/
```

#### Request
```json
{
    "otp":"1879",
    "token":"e4e98a42399835ea7a9c73ec8f7e16c0e8146b4e5b3e7c79c435456c587217a0"
}
```
#### Response
```json
{
    "code": 2001,
    "message": "email is successfully verified"
}
```

<br />


### Resend OTP for email verification
#### URL
```http
POST /api/otp/resend
```

#### Request
```json
{
    "token":"8e0541b09c2de02d98d4aab9bc8832c05af8274f02fa828c30e710732b1eb210"
}
```
#### Response
```json
{
    "code": 2002,
    "message": "otp is sent , verify your email",
    "data": {
        "token": "4416ba3eafc52e75741bfacea669dcb26e87612409cc49a740d77876fc9b812a"
    }
}
```

<br />


### Login
#### URL
```http
POST /api/login/
```

#### Request
```json
{
    "email":"test001@gmail.com",
    "password":"User001$"
}
```
#### Response
```json
{
    "code": 2003,
    "message": "login is successful",
    "data": {
        "token": "fd7ba1b2c60c76424661346430c57aa30219942bd2b7c7ba9f45ed610c422677"
    }
}
```

<br />


### If user forget password
#### URL
```http
POST /api/password/forget
```

#### Request
```json
{
    "email":"pcic095@gmail.com"
}
```
#### Response
```json
{
    "code": 2004,
    "message": "otp for password reset is sent",
    "data": {
        "token": "ce0d6b703fae787aa587e0988f5b97f7242c134856f0d19a3ccac5b70ca436f7"
    }
}
```

<br />


### Verify OTP for password reset without login
#### URL
```http
POST /api/password/otp/verify
```

#### Request
```json
{
    "token":"ce0d6b703fae787aa587e0988f5b97f7242c134856f0d19a3ccac5b70ca436f7",
    "otp":"4055",
    "password":"Aftrtdfgdrt5656765$54632w556"
}
```
#### Response
```json
{
    "code": 2005,
    "message": "password is changed"
}
```

<br />



#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />



#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />


#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />



#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />


#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />



#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />



#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />



#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />


#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />


#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />


#### URL
```http
POST /api/
```

#### Request
```json
```
#### Response
```json
```

<br />

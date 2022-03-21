# Auth And Fetch API

This is a example API using two different programming language. This Auth API use PHP Programming Language and for the Fetch API use Python Programming. The API using POST in request data.

## Auth API

Auth API has three endpoints, namely register, login and claim. 
From each endpoint will provide output in the form of JSON with different responses.

The basic programming language in Auth API is PHP

### Register 

At the first endpoint, the register, you can assign values to the nik and role parameters with the POST method. If the API calling process is successful, the nick and role that you input will be automatically processed by this API and will automatically be entered into the MySQL database. Besides the nik and role, this endpoint return the password which is automatically generated as many as 6 char.

Link of Register endpoint : https://firmanakbarm-api.000webhostapp.com/register/

#### Example to use Register (Python)

	import requests
	from flask import request
		
	body = {'nik':request.form['nik'], 'role':request.form['role']}
	response_API = requests.post('https://firmanakbarm-api.000webhostapp.com/register.php', data=body)
	print(response_API.text)
	
#### Output

	{
    "status": "success",
    "message": "'1745174517451745', 'admin' and 'epAKCZ' inserted to database!"
	}

### Login

At the second endpoint, the login, you can assign values to the nik and password parameters with the POST method. If the API calling process is successful, the id, nik, role and JSON Web Token (JWT) output in format JSON. Besides that, the JWT is saved in the Cookies.

Link of Login endpoint : https://firmanakbarm-api.000webhostapp.com/login/

#### Example to use Register (Python)

	import requests
	from flask import request
		
	body = {'nik':request.form['nik'], 'role':request.form['password']}
	response_API = requests.post('https://firmanakbarm-api.000webhostapp.com/login.php', data=body)
	print(response_API.text)
	
#### Output

	{
    "status": "success",
    "message": "login success!",
    "data": {
        "id": "9",
        "nik": "1745174517451745",
        "role": "admin",
        "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjkiLCJuaWsiOiIxNzQ1MTc0NTE3NDUxNzQ1Iiwicm9sZSI6ImFkbWluIn0.RWt2E6ADUjSXHNU2KJ_jClVqb3TesVK7NeBeDe0BDc0"
    }
	}
	
### Claim

The last endpoint is claim, you can access this endpoint if you success login to https://firmanakbarm-api.000webhostapp.com/login/, this endpoint have a function to validate the JWT valid. If the JWT not valid claim will give return the "jwt not valid!" or "user not login!". 

Link of Claim endpoint : https://firmanakbarm-api.000webhostapp.com/claim/

#### Example to use Register (Python)

	import requests
	from flask import request
		
	s = request.cookies.get('X-SESSION')
	if s is None:
		return {
  		"status": "failed",
  		"message": "user not login!"
  	}
	response_API = requests.post('https://firmanakbarm-api.000webhostapp.com/claim.php', headers={"Cookie": "X-SESSION="+s})
	return(response_API.text)
	
#### Output

	{
    "status": "success",
    "message": "login success!",
    "data": {
        "id": "9",
        "nik": "1745174517451745",
        "role": "admin",
        "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjkiLCJuaWsiOiIxNzQ1MTc0NTE3NDUxNzQ1Iiwicm9sZSI6ImFkbWluIn0.RWt2E6ADUjSXHNU2KJ_jClVqb3TesVK7NeBeDe0BDc0"
    }
	}
	
## Fetch API

In this Fetch API you will be able to do 3 stages, namely fetch, aggregation and claim which are useful for getting data on the API (https://60c18de74f7e880017dbfd51.mockapi.io/api/v1/jabar-digital-services/product) which is then followed by will be processed by the three endpoints mentioned earlier. The condition for using all of these endpoints is that we have logged in and our JWT is valid.

The basic programming language in Auth API is Python

### Login & Claim

same as use in Auth, before you will to access Fetch and Aggregation you must be Login and claim the JWT is Valid. 

Link of Login endpoint : https://firmanakbarmln-fetch-app.herokuapp.com/api/login

Link of Claim endpoint : https://firmanakbarmln-fetch-app.herokuapp.com/api/claim

Warning : If you see the output is Method Not Allowed, please access The Endpoint API using POST in request data.

### Fetch

The function of this endpoint is to show the data in https://60c18de74f7e880017dbfd51.mockapi.io/api/v1/jabar-digital-services/product

Link of Fetch endpoint : https://firmanakbarmln-fetch-app.herokuapp.com/api/fetch

Warning : If you see the output is Method Not Allowed, please access The Endpoint API using POST in request data.

### Aggregation

The function of this endpoint is to show the data in https://60c18de74f7e880017dbfd51.mockapi.io/api/v1/jabar-digital-services/product and modify the data outputed is only department, product and price_in_idr which converted from USD using https://v6.exchangerate-api.com/. 

Link of Aggregation endpoint : https://firmanakbarmln-fetch-app.herokuapp.com/api/aggregation

Warning : If you see the output is Method Not Allowed, please access The Endpoint API using POST in request data.
	
## Author Info

- Instagram - [@firmanakbarm](https://www.instagram.com/firmanakbarm/)

[Back To The Top](#Auth-And-Fetch-API)

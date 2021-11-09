Get oauth/token 

1) Run the php artisan passport:keys command. This command generates the encryption keys Passport needs in order to generate access tokens.
2) In vagrant run php artisan passport:client --client
3) Postman route http://localhost:8080/oauth/token
4) Pass data:
   grant_type => client_credentials
   client_id => client id you get from vagrant php artisan passport:client --client
   client_secret => client secret you get from vagrant php artisan passport:client --client
   send these in BODY
   
Once you get token you have to include in route:
    -authorization chose type Bearer Token
    -paste your token in input for token

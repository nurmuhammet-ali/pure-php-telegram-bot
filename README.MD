# PURE PHP TELEGRAM BOT

## Installation
```bash
cp .env.example .env
```

## Add configurations
```bash
telegram_token=telegram_bot_token
MYSQL_DATABASE=bot_database
MYSQL_USER=username
MYSQL_PASSWORD=password
```

## Available methods
`getUpdates()` #  updates db with latest chats & users


**METHOD**: `POST`

**URI**: `/`

**FORM-DATA**:
    `action`: `getUpdates`
    
**RESPONSE**: 
```json
{
    "message": "Successefully updated"
}
```

`sendMessageToAll()` #  sends message to all users of bot


**METHOD**: `POST`

**URI**: `/`

**FORM-DATA**:
    `action`: `sendMessageToAll`
    `message`: `Message to be sent`
    
**RESPONSE**: 
```json
{
    "message": "Successefully sent"
}
```

`sendMessageToUsername()` #  sends message by username


**METHOD**: `POST` <br />
**URI**: `/`
**FORM-DATA**:
    `action`: `sendMessageToUsername`
    `username`: `username`
    `message`: `Message to be sent`
    
**RESPONSE**: 
```json
{
    "message": "sucess"
}
```

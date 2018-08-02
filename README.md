adsearch.tokyo
===========================================

Welcome to adsearch.tokyo web application.

## What is adsearch.tokyo?

http://adsearch.tokyo is the web site to introduce the event of art and design etc to be held in Tokyo.

## Dependency

- PHP7.1~
- MySQL5.7~

## Setup

...

### Additional files required

**.gitignore**

```
# File contents

.gitignore
/vendor/
/web/uploads
/app/config/
```

**app/config/config.yml**

```
# File contents

# Database Configuration
database:
    dsn: PDO Data Source Name (ex. mysql:host=localhost;dbname=adsearch.tokyo;charset=utf8)
    user: user
    password: password
```

## Licence

This software is released under the MIT License, see LICENSE.

## Authors

[@kame_greenergy](https://twitter.com/kame_greenergy)
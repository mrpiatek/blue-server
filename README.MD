# Server side package for the Blue application.

## Installation

### Set up a new Laravel 5.6 project

### Add GitHub repository to the composer.json file

```
"repositories": [
    {
        "type":"package",
        "package": {
          "name": "mrpiatek/blue-server",
          "version":"master",
          "source": {
              "url": "https://github.com/mrpiatek/blue-server.git",
              "type": "git",
              "reference":"master"
            }
        }
    }
]
```

### Run `composer require mrpiatek/blue-server`
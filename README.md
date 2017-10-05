# Kaputt App Backend
A clothes forecast application.

## API Documentation
Currently we offer two API endpoints, with support for autocomplete and clothes forecast.

### Autocomplete
The Autocomplete api API endpoint accepts a query string and outputs an array of locations that match this string. The string can be URL encoded in hex as normal. The point of this endpoint is to help users get the correct location name when asking for a forecast.

Request Example:

`[GET] http://kaputt.homullus.com/api/autocomplete.php?city=Stari%20Grad,%20Serbia`

Response Example:
```
[
  {
    "id": 2830624,
    "name": "Stari Grad, Central Serbia, Serbia",
    "region": "Central Serbia",
    "country": "Serbia",
    "lat": 44.82,
    "lon": 20.46,
    "url": "stari-grad-central-serbia-serbia"
  },
  {
    "id": 2823552,
    "name": "Dorcol (Historical), Serbia (general), Serbia",
    "region": "Serbia (general)",
    "country": "Serbia",
    "lat": 44.82,
    "lon": 20.47,
    "url": "dorcol-historical-serbia-general-serbia"
  },
  {
    "id": 2830682,
    "name": "Belgrade, Central Serbia, Serbia",
    "region": "Central Serbia",
    "country": "Serbia",
    "lat": 44.8,
    "lon": 20.47,
    "url": "belgrade-central-serbia-serbia"
  }
]
```

### Clothes Forecast
The Forecast API endpoint asks for city string, arrival and departure dates in ISO8601 shorthand format. It outputs all the information the app needs to pretty print this. The dates send must follow double digits policy: 2017-03-09.


Request Example:

`[GET] http://kaputt.homullus.com/api/forecast.php?city=Valetta,%20Malta&start_date=2017-10-07&end_date=2017-10-10`

Response Example:
```
{
  "location": {
    "name": "Valetta",
    "country": "Malta",
    "latitude": 35.9,
    "longtitude": 14.51,
    "current_condition": 0
  },
  "weather": [
    {
      "date": "2017-10-07",
      "day": "07 Oct",
      "temperature": "21.8°C",
      "condition": "Sunny",
      "icon": "https://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "date": "2017-10-08",
      "day": "08 Oct",
      "temperature": "21.4°C",
      "condition": "Partly cloudy",
      "icon": "https://cdn.apixu.com/weather/64x64/day/116.png"
    },
    {
      "date": "2017-10-09",
      "day": "09 Oct",
      "temperature": "22.1°C",
      "condition": "Sunny",
      "icon": "https://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "date": "2017-10-10",
      "day": "10 Oct",
      "temperature": "22.1°C",
      "condition": "Sunny",
      "icon": "https://cdn.apixu.com/weather/64x64/day/113.png"
    }
  ],
  "clothes": [
    {
      "name": "T-Shirt",
      "description": "Good to have for any occasion.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Sleeved Shirt",
      "description": "Temperature will fall below 20c.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Hoodie",
      "description": "Colder climate expected.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Light Pants",
      "description": "Temperature around 20c.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Jeans",
      "description": "Good to have for any occasion.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Light Sneakers",
      "description": "A general purpose for moderate weather.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Sneakers",
      "description": "Tougher and warmer general purpose sneakers.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Windbreaker",
      "description": "Warm but really windy weather.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Shorts",
      "description": "Temperature will stay above 22c.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    },
    {
      "name": "Sandals",
      "description": "Or flippers. Temperature above 25c expected.",
      "icon": "http://cdn.apixu.com/weather/64x64/day/113.png"
    }
  ]
}
```

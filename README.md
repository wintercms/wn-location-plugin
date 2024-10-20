# Location Plugin

[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/wintercms/wn-location-plugin/blob/main/LICENSE)

This plugin adds location based features to [Winter CMS](https://wintercms.com).

Supports:
- Easily add Country and State to any model
- Form widget for address lookups (Google API)

## Installation

This plugin is available for installation via [Composer](http://getcomposer.org/).

```bash
composer require winter/wn-location-plugin
```

After installing the plugin you will need to run the migrations and (if you are using a [public folder](https://wintercms.com/docs/develop/docs/setup/configuration#using-a-public-folder)) [republish your public directory](https://wintercms.com/docs/develop/docs/console/setup-maintenance#mirror-public-files).

```bash
php artisan migrate
```

### Google API key requirement

As of June 22, 2016 the Google Maps service requires an API key. You may generate a key from the following link:

- [Get a Google API key](https://developers.google.com/maps/documentation/javascript/get-api-key)

Copy the key and enter it in the **Settings > Location settings** area. If you find the address finder is not working, you may need to enable the [Places API](https://console.developers.google.com/apis/api/places_backend/overview?project=_) and the [Maps JavaScript API](https://console.developers.google.com/apis/api/maps_backend/overview?project=_).

### Add Country and State to any model

This plugin provides an easy way to add location fields, country and state, to any model. Simply add these columns to the database table:

```php
$table->integer('country_id')->unsigned()->nullable()->index();
$table->integer('state_id')->unsigned()->nullable()->index();
```

Then implement the **Winter.Location.Behaviors.LocationModel** behavior in the model class:

```php
public $implement = ['Winter.Location.Behaviors.LocationModel'];
```

This will automatically create two "belongs to" relationships:

1. **state** - relation for Winter\Location\Models\State
1. **country** - relation for Winter\Location\Models\Country

### Back-end usage

#### Forms

You are free to add the following form field definitions:

```yaml
country:
    label: winter.location::lang.country.label
    type: dropdown
    span: left
    placeholder: winter.location::lang.country.select

state:
    label: winter.location::lang.state.label
    type: dropdown
    span: right
    dependsOn: country
    placeholder: winter.location::lang.state.select
```

#### Lists

For the list column definitions, you can use the following snippet:

```yaml
country:
    label: winter.location::lang.country.label
    searchable: true
    relation: country
    select: name
    sortable: false

state:
    label: winter.location::lang.state.label
    searchable: true
    relation: state
    select: name
    sortable: false
```
### Front-end usage

The front-end can also use the relationships by creating a partial called **country-state** with the content:

```twig
{% set countryId = countryId|default(form_value('country_id')) %}
{% set stateId = stateId|default(form_value('state_id')) %}

<div class="form-group">
    <label for="accountCountry">Country</label>
    {{ form_select_country('country_id', countryId, {
        id: 'accountCountry',
        class: 'form-control',
        emptyOption: '',
        'data-request': 'onInit',
        'data-request-update': {
            'country-state': '#partialCountryState'
        }
    }) }}
</div>

<div class="form-group">
    <label for="accountState">State</label>
    {{ form_select_state('state_id', countryId, stateId, {
        id: 'accountState',
        class: 'form-control',
        emptyOption: ''
    }) }}
</div>
```

This partial can be rendered in a form with the following:

```twig
<div id="partialCountryState">
    {% partial 'country-state' countryId=user.country_id stateId=user.state_id %}
</div>
```

### Short code accessors

The behavior will also add a special short code accessor and setter to the model that converts `country_code` and `state_code` to their respective identifiers.

```php
// Softly looks up and sets the country_id and state_id
// for these Country and State relations.

$model->country_code = "US";
$model->state_code = "FL";
$model->save();
```
### ISO 3166-1 accessors

The behavior will also add the ISO-3166-1 values as accessors to the model (data sourced from the [league/iso3166](https://github.com/thephpleague/iso3166) package).  
Availables accessors are `iso_name` (country name), `iso_alpha3` (three-letter code), `iso_numeric` (three-digit code), `iso_currencies` (three-digit currencies code) and `iso` (array of all iso attributes).

```php
$usCountry = \Winter\Location\Models\Country::whereCode('US')->first();

$usCountry->iso_name;
// (string) "United States of America"

$usCountry->iso_alpha3;
// (string) "USA"

$usCountry->iso_numeric;
// (string) "840"

$usCountry->iso_currencies;
// (array) [ 0 => "USD" ]

$usCountry->iso;
// (array) [
//     "name" => "United States of America"
//     "alpha2" => "US"
//     "alpha3" => "USA"
//     "numeric" => "840"
//     "currency" => [
//         0 => "USD"
//     ]
// ]

```

### Address Finder Form Widget

This plugin introduces an address lookup form field called `addressfinder`. The form widget renders a Google Maps autocomplete address field that automatically populates mapped fields based on the value entered and selected in the address.

Available mappings:

- street
- city
- zip
- state
- country
- country-long
- latitude
- longitude
- vicinity

Available options:

You can restrict the address lookup to certain countries by defining the `countryRestriction` option. The option accepts a comma separated list of ISO 3166-1 ALPHA-2 compatible country codes (see: https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2).

Usage:

```yaml
# ===================================
#  Form Field Definitions
# ===================================

fields:
    address:
        label: Address
        type: addressfinder
        countryRestriction: 'us,ch'
        fieldMap:
            latitude: latitude
            longitude: longitude
            city: city
            zip: zip
            country: country_code
            state: state_code
            vicinity: vicinity

    city:
        label: City
    zip:
        label: Zip
    country_code:
        label: Country
    state_code:
        label: State
    latitude:
        label: Latitude
    longitude:
        label: Longitude
    vicinity:
        label: Vicinity
```

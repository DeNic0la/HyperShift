# API

Die API von HyperShift ist nicht eine Öffentliche API, sie wird nur für die Kommunikation zwischen Front-End und Back-End verwendet. Alle [Routes](https://laravel.com/docs/8.x/routing) sind im [Web.php](https://github.com/DeNic0la/HyperShift/blob/master/routes/web.php) file. Es werden hier jedoch nur die Routes beschrieben welche keine Web-Page zurückgeben sondern für die Server-Client Kommunikation wichtig sind.

{% api-method method="post" host="" path="/createSurvey" %}
{% api-method-summary %}
Create Basic Survey
{% endapi-method-summary %}

{% api-method-description %}
Erstellt eine Umfrage und speichert diese in der Datenbank.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-form-data-parameters %}
{% api-method-parameter name="name" type="string" required=true %}
Name der Umfrage
{% endapi-method-parameter %}

{% api-method-parameter name="questions" type="object" required=true %}
Fragen für die Umfrage
{% endapi-method-parameter %}
{% endapi-method-form-data-parameters %}
{% endapi-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=201 %}
{% api-method-response-example-description %}
Die Umfrage wurde erfolgreich erstellt.
{% endapi-method-response-example-description %}

```javascript
{
    "owner_id":null,
    "survey_name":"NameDerUmfrage",
    "url_string":"LifI6c6ZgtIFC8O",
    "updated_at":"2021-04-20T13:46:15.000000Z",
    "created_at":"2021-04-20T13:46:15.000000Z",
    "id":4
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}

{% api-method method="post" host="" path="/createBlueprint" %}
{% api-method-summary %}
Create Blue Print
{% endapi-method-summary %}

{% api-method-description %}
Erstellt einen BluePrint und speichert diesen in der Datenbank, sehr ähnlich zu Create Survey.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-form-data-parameters %}
{% api-method-parameter name="name" type="string" required=false %}
Name des BluePrint
{% endapi-method-parameter %}

{% api-method-parameter name="questions" type="object" required=false %}
Fragen für den BluePrint
{% endapi-method-parameter %}
{% endapi-method-form-data-parameters %}
{% endapi-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=201 %}
{% api-method-response-example-description %}
Der BluePrint wurde erfolgreich erstellt.
{% endapi-method-response-example-description %}

```javascript
{
    "owner_id":null,
    "survey_name":"NameDerUmfrage",
    "url_string":"wMvUJYA2xrBQjU5",
    "updated_at":"2021-04-20T13:52:35.000000Z",
    "created_at":"2021-04-20T13:52:35.000000Z",
    "id":9
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}




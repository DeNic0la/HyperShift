# BasicSurvey

## Allgemeines

BasicSurvey ist das Grund Model für eine Zeitlose Umfrage, in BasicSurvey wird der Name der Umfrage und der Ersteller der Umfrage \(sofern dieser Angemeldet war\) gespeichert.

### Migration:

| Name | Zweck |
| :--- | :--- |
| survey\_name | Name der Umfrage |
| url\_string | Dieser String wird an den Benutzer weitergegeben um auf die Umfrage zuzugreifen bzw. für das Beantworten der Umfrage. |
| owner\_id | [user\(\)](basicsurvey.md#user) |

### Relations

#### [user\(\)](../user.md)

BasicSurvey gehört einem User, dieser User ist der ersteller der Umfrage.

#### [questions\(\)](question.md)

BasicSurvey hat 0-n Question. Das sind die Fragen welche in der Umfrage erstellt wurden.

#### basicanswers\(\)

BasicSurvey hat 0-n BasicAnswer. Die Antworten zu den Umfragen werden über dieses Model gespeichert.


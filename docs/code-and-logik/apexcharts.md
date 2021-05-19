# Apexcharts

## Allgemeines

Apexcharts ist eine moderne Chart-Bibliothek mit welcher man verschiedene Arten von Charts darstellen kann z.B. Bar-Charts, Line-Charts usw.

### ConfidenceVote Resultate:

Um die ConfidenceVote-Resultate darzustellen haben wir ein [Area-Chart](https://apexcharts.com/vue-chart-demos/area-charts/basic/) verwendet. Dabei sieht man auf der Y-Achse wieviel mal ein Wert gewählt worden ist und auf der X-Achse sieht man alle Werte welche dem Beantworter zur Verfügung stehen also 1 bis maxValue.

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

<!--stackedit_data:
eyJoaXN0b3J5IjpbLTE0MzM5MTAxNTUsLTE4NTU3MzExNjUsMz
YyMzA3M119
-->
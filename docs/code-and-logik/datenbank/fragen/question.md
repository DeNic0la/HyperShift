# Question

## Allgemeines

Dieses Model ist ein Frage. Question dient als eine art Zwischentabelle zwischen der Umfrage oder dem BluePrint und der Typisierten Frage. Question muss immer mit genau einem Fragetypen verlinkt sein. Alle ausser eine der Relationen zwischen Frage-Typen geben null zurück.

### Migration:

| Name | Zweck |
| :--- | :--- |
| questionable\_id | [questionable\(\)](question.md#questionable) |
| questionable\_type | [questionable\(\)](question.md#questionable) |

### Relations

#### [terminquestion\(\)](frage-typen/terminquestion.md)

Question hat 0 oder 1 terminquestion.

#### [confidencevote\(\)](frage-typen/terminquestion.md)

Question hat 0 oder 1 terminquestion.

#### [questionable\(\)](question.md)

Question hat eine [Polymorphic Relation](https://laravel.com/docs/8.x/eloquent-relationships#polymorphic-relationships) zu [BasicSurvey](basicsurvey.md) oder BluePrint.

<!--stackedit_data:
eyJoaXN0b3J5IjpbMTU5ODUzNjcwN119
-->
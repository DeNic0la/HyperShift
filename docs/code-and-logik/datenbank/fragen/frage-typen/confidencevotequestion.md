# ConfidenceVoteQuestion

## Allgemeines

Der FrageTyp TerminQuestion ist eine spezielle form von Checkbox-Fragen. Die Frage hat Termine zur Auswahl und der beantwortende User kann jeden Termin anklicken der für ihn passt.
Der FrageTyp ConfidenceVoteQuestion ist eine Frage, bei welcher der User als Antwort einen Wert von 1 bis n

### Migration:

| Name | Zweck |
| :--- | :--- |
| questionId | [question\(\)](terminquestion.md#question) |
| name | Name der Frage |

### Relations

#### question\(\)

Gehört zu einer Frage.

#### termins\(\)

Hat 0-n Termin, sollte jedoch nicht 0 Termin haben.

<!--stackedit_data:
eyJoaXN0b3J5IjpbLTcwNDcxNzY1Ml19
-->
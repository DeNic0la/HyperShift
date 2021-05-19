# ConfidenceVoteQuestion

## Allgemeines

Der FrageTyp ConfidenceVoteQuestion ist eine Frage, bei welcher der User als Antwort einen Wert von 1 bis n wählen kann. Dabei kann der Ersteller der Umfrage den Maximalwert festlegen.

### Migration:

| Name | Zweck |
| :--- | :--- |
| questionId | [question\(\)](terminquestion.md#question) |
| name | Name der Frage |
| maxValue| Maximalwert der Antwort|

### Relations

#### question\(\)

Gehört zu einer Frage.

#### termins\(\)

Hat 0-n Termin, sollte jedoch nicht 0 Termin haben.

<!--stackedit_data:
eyJoaXN0b3J5IjpbLTE3OTc1OTM0MzYsMTQ0NTcxMDk5OF19
-->
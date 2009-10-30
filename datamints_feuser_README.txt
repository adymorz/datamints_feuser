datamints_feuser
================

Prim�r:
-------
- Template wie bei ALOE-FeUser
- evtl. "templateble" via cObj:FORM
- Registrieren eines Users (alle Felder von FE-Users k�nnen editiert werden)
- Editieren eines Users (alle Felder von FE-Users k�nnen editiert werden)
- encryption via salted MD5
- Nach dem registrieren wird der User einer per TS angegebenen Gruppe zugewiesen
- Feldtyp aus TCA holen und die versch. Eingabefelder f�r das Template rendern
- E-Mail-Benachrichtigung an (kommaseparierte) Admin(s) bei Registrierung
- double-opt-in (Best�tigungs-E-Mail an Registrar mit Best�tigungs-Link)
- locallang.xml (und demnach _LOCAL_LANG) verwenden
- Image-Feld ber�cksichtigen (timestamp an Name?)


Sekund�r:
---------
- JS-Pr�fung von Feldinhalten w�hrend der Eingabe
- (Userdaten aus OpenID in Standardfelder importieren ... geht das?)



TypoScript:
===========
- templateFile
- storagePID
- Anzeigefelder (kommasepariert)
- Pflichtfelder (kommasepariert)
- Admin-E-Mail-Adressen (kommasepariert)
- Admin-Name (f�r E-Mail-Adresse)
- Verzeichnis-Pfad f�r Bilddateien
- Max Gr��e f�r Bilder


Flexform:
=========
- templateFile
- storagePID
- Anzeigetyp (edit/register)
- Anzeigefelder (Auswahlfeld)
- Pflichtfelder (Auswahlfeld)



Locallang:
==========
- Admin-E-Mail-Text
- User-E-Mail-Text




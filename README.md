# Dev Vita Bundle for Contao 5.5+

Vita für Developer, ganz einfach von GitHub über die composer.json. Das **Dev Vita Bundle** ist eine Erweiterung für Contao 5.5+, die Informationen aus der `composer.json` von GitHub-Repositories abruft und im Frontend-Modul aufbereitet darstellt.
Die Repositories können von verschiedenen GitHub-Projekten sein.

## Features

- Verwaltung von GitHub-Repositories (public/private) im Backend (`tl_dev_vita`)
- Abruf der `composer.json` via GitHub API (inkl. PAT-Support)
- Anzeige im Frontend-Modul als Liste mit Twig-Template
- Unterstützt Token für private Repos
- Backend-Modul mit Datum, Sorting und dynamischem Feld für Token

## + zukünftiges Feature

- Lazy Load für das Frontend-Modul

## GitHub verlangt auch für public Repos einen Token

Hier kann man einen zeitlich unbegrenzten Token für alle seine Repos generieren (Token classic)
https://github.com/settings/tokens

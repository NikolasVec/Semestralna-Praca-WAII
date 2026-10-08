# Webová stránka pre podujatie Beh po pivo

Nikolas Večerek

5ZYI33

## Stručný opis projektu
Beh po pivo je každoročné športovo-zábavné podujatie v Martine, ktoré spája beh a konzumáciu piva z miestneho pivovaru Martins.

Cieľom práce je vytvoriť webovú stránku, ktorá zjednoduší organizáciu a prezentáciu podujatia. Stránka bude slúžiť ako centrálne miesto pre informácie o akcii, registráciu účastníkov a prezentáciu sponzorov. Zároveň nahradí doterajší neprehľadný spôsob registrácie a zdieľania informácií prostredníctvom sociálnych sietí.

## Role v projekte
Návštevník: Môže sa registrovať/odhlásiť na beh, prezerať informácie o akcii, galériu fotiek, mapu trate, sponzorov a reklamu.

Administrátor: Má prístup k administrátorskému rozhraniu, kde môže spravovať registrácie účastníkov, pridávať a upravovať informácie o podujatí, galériu fotiek, mapu trate a sponzorov.

## Prípady použitia podľa rolí
Návštevník:
- Prezerať informácie o podujatí (dátum, miesto, program, pravidlá)
- Prezerať galériu fotiek z predchádzajúcich ročníkov
- Prezerať mapu trate a sponzorov
- Registrovať sa na beh a odhlásiť sa z neho
  
Administrátor:
- Spravovať registrácie účastníkov (pridať, upraviť, odstrániť)
- Pridávať a upravovať informácie o podujatí (dátum, miesto, program, pravidlá)
- Spravovať galériu fotiek (pridať, upraviť, odstrániť)
- Spravovať mapu trate a sponzorov (pridať, upraviť, odstrániť)

## Plánované entity
- Bežec: Reprezentuje účastníka podujatia. Atribúty: ID, meno, priezvisko, dátum narodenia, pohlavie, email, ID_roka, čas.
- RokKonania: Reprezentuje rok konania podujatia. Atribúty: ID_roka, dátum konania, počet učastníkov.
- Stanovisko: Reprezentuje jednotlivé stanovištia na trati. Atribúty: ID_stanoviska, názov, popis, suradnice, ID_roka.
- Fotka: Reprezentuje fotky z podujatia. Atribúty: ID_fotky, popis, ID_roka, URL.
- Admin: Reprezentuje administrátora stránky. Atribúty: ID_admina, meno, priezvisko, email, heslo.

## Vzťahy medzi entitami
RokKonania – Bezec (1:N) → Každý ročník má viac bežcov.

RokKonania – Stanovisko (1:N) → Každý ročník má vlastné stanovištia.

RokKonania – Fotka (1:N) → Každý ročník má vlastnú galériu fotiek.

## Hlavné stránky aplikácie
- Domov: úvodná stránka s opisom akcie a jej pravidlami. Taktiež bude obsahovať reklamy a kontaktne údaje.
- Mapa: mapa trate s popisom stanovíšť.
- Registrácia: formulár pre účastníkov.
- Galéria: fotky z minulých ročníkov.
- Výsledky: zoznamy výsledkov s daných rokov.
- Admin: administrátorské rozhranie do ktorého sa musite prihlásiť pre správu registrácií, fotiek, stanovíšť a informácií o podujatí.

## Rozdelenie funkcionality
Rozdeľte plánované funkcie na základné a rozširujúce. Základné funkcie predstavujú minimum potrebné na úspešné dokončenie projektu, zatiaľ čo rozširujúce funkcie môžu byť implementované navyše podľa Vašich časových možností.

Základné funkcie:
- Registrácia účastníkov na beh.
- Možnosť pridávať a upravovať informácie o podujatí, galériu fotiek, mapu trate a sponzorov (pre administrátora).
- Zobrazenie informácií o podujatí.
- Zobrazenie mapy trate a stanovíšť.
- Zobrazenie galérie fotiek z minulých ročníkov.
- Zobrazenie výsledkov z minulých ročníkov.

Rozširujúce funkcie:
- Možnosť filtrovať výsledky.
- Posielanie emailov účastníkom (napr. potvrdenie registrácie, informácie o podujatí).

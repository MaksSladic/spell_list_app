# spell_list_app

| Pot                                      | Metoda | Medijski tip | Vsebina zahtevka               | Opis                                 | Referenca |
| ---------------------------------------- | ------ | ------------ | ------------------------------ | ------------------------------------ | --------- |
| /users                                   | GET    | JSON         | /                              | Pridobi imena vseh uporabnikov       | 1         |
| /users/{ime}                             | GET    | JSON         | /                              | Pridobi vse characterje uporabnika   | 2         |
| /users/{ime}                             | PUT    | JSON         | {“ime“:“___“,“geslo“:“___“}    | Posodobi uporabnika v zbirki         | 3         |
| /users                                   | POST   | JSON         | {“ime“:“___“,“geslo“:“___“}    | Dodaj novega uporabnika              | 4         |
| /users/{ime}                             | DELETE | JSON         | /                              | Izbriši uporabnika                   | 5         |
| /spells                                  | GET    | JSON         | /                              | Pridobi vse spelle                   | 6         |
| /spells/{level}                          | GET    | JSON         | /                              | Pridobi vse spelle določenega levela | 7         |
| /spells/{spell name}                     | GET    | JSON         | /                              | Pridobi vse podatke o spellu         | 8         |
| /spells                                  | POST   | JSON         | {…vsi podatki o spellu...}     | Ustvari nov spell                    | 9         |
| /characters/{character name}/{user name} | GET    | JSON         | /                              | Pridobi vse spelle characterja       | 10        |
| /characters/{character name}             | POST   | JSON         | {“ime“:“___“}                  | Ustvari novega characterja           | 11        |
| /character/{character name}/{spell name} | POST   | JSON         | {“ime“:“___“}                  | Dodaj spell characterju              | 12        |
| /character/{character ID}                | PUT    | JSON         | {“novo ime characterja“:“___“} | Posodobi ime characterja             | 13        |
| /character/{character ID}/{spell name}   | DELETE | JSON         | /                              | Izbriši spell iz characterja         | 14        |
| /character/{character ID}                | DELETE | JSON         | /                              | Izbriši characterja                  | 15        |
| /login                                   | POST   | JSON         | {“ime“:“___“,“geslo“:“___“}    | Vpiši uporabnika                     | 16        |
| /cookies/{JWT}                           | POST   | JSON         | /                              | Preveri veljavnost JWT               | 17        |

1.\
Vrne nam vse uporabnike v naši bazi podatkov. To poda s statusom 200. Ta opcija ni na voljo uporabnikom, in zato ni implementirana v spletno stran ali aplikacijo.

2.\
Ko podamo ime uporabnik, katerega characterje želimo videti, preverimo ali obstaja kar vrne status 200 in imena characterjev vezanih na tega uporabnika, če pa uporabnik ne obstaja pa vrne status 404.

3.\
Če v telo ne podamo pravilne parametre (username in password) nam koda vrne status 400, enako kot v primeru, da uporabnik s tem imenom že obstaja. Če pride do napake pri urejanju dobimo status 500, ob uspešni spremembi pa 204.

4.\
Ker zahtevamo telo (username in password), ob pomanjkanju tega dobimo odgovor status 400, če uporabnik s tem imenom že obstaja 409, ob napaki pri ustvarjanju 500, uspešnem dodajanju pa 201.

5.\
Ob brisanju uporabnika, moramo izbrisati tudi vse characterje ki so nanj vezani. V telo dodamo tudi ID uporabnika, za dodatno stopnjo prepričanja da ga želimo izbrisati.

6.\
Tukaj zahtevamo prikaz vseh spellov, in ob uspešni izvedbi dobimo status 200, s seznamom imen vseh spellov, in njihovim levelom.

7.\
Ko specificiramo kater level spellov iščemo, nam koda poda sledeče informacije o spellih:\
SpellName, SpellSchool, SpellCastingTime, SpellRange, SpellDuration, SpellComponents, SpellRitual, SpellConcentration

8.\
Ko specificiramo ime spella za katerega podatke nas zanimajo, nam koda vrne vse (*) podatke ki se tega spella tičejo, in status 200.

9.\
Za vnos novega spella potrebujemo vnesti v telo vse podatke, drugače dobimo status 400. Če že imamo spell z istim imenom dobimo status 409, ob napaki pri ustvarjanju status 500, in ob uspešnem ustvarjanju 201.\
zahtevani podatki:\
SpellName, SpellSchool, SpellLevel, SpellCastingTime, SpellRange, SpellComponents, SpellDuration, SpellConcentration, SpellRitual, SpellDescription

10.\
Najprej se pozanimamo ali character s tem imenom sploh obstaja, in če ne vrnemo status 404, nato pa vrnemo seznam vseh imen spellov vezanih na tega characterja, oziroma sporočilo da nima nobenih spellov.

11.\
Preverimo ali character s tem imenom že obstaja (status 409 če ja) in če ne dodamo uporabniku, katerega ime smo posredovali v telesu, dodamo characterja z novim imenom. Status 201

12.\
Ponovno preverimo ali ima uporabnik, katerega ime smo podali v telesu, characterja z imenom podanim v naslovu, nato preverimo ali spell s podanim imenom obstaja, in če vse to drži ustvarimo novo povezavo v povezovalni tabeli med characterji in spelli.

13.\
V naslovi podamo ID characterja katerega ime želimo spremeniti. Novo ime podamo v telesu in nato posodobimo tabelo s characterji z novim imenom.

14.\
Za izbris povezave med spellom in characterjem, preverimo ali spell obstaja (400 če ne), in nato glede na ID characterja brišemo povezavo v tabeli spelllist, kjer se ujemata vnesena id characterja in id spella. Uspešen izbris nam vrne status 204.

15.\
Za izbris characterja vnesemo njegov ID v naslov, izbrišemo vse povezave v spelllist tabeli ki vsebujejo ta ID characterja in nato še izbrišemo characterja iz tabele characters. Uspešen izbris nam vrne status 204.

16.\
V telesu zahtevamo username in password (status 400 če ni), nato preverimo ali se ujemata z našo bazo podatkov (status 409 če se ne) in če se ustvarimo Json web token (jwt), ki se shrani v piškotkih na uporabnikovi strani.

17.\
Preverimo veljavnost jwt. Če je veljaven dobimo status 200, če pa ni pa status 409. To uporabljamo ko želimo dostopati do strani ki so zasebne. Skratka vse za kar bi se morali prijaviti v sistem.

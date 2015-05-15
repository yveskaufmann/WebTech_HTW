# -*- coding: utf-8 -*-

import os
import math
import json

def split_into_chunks(str, chunk_size=80):
    chunks = []
    offset = 0
    str_len = len(str)
    for index in range(str_len):
        if offset >= chunk_size and str[index].isspace():
            chunks.append(str[index - offset : index ])
            offset = 0
        else:
            offset += 1
    return chunks

def create_json(obj):
    return json.dumps(obj)


if __name__ == '__main__':
    chunks = split_into_chunks(""" Die Entstehungsgeschichte von Captain America wurde erstmals in Captain America Comics #1 aus dem Jahr 1941, dem ersten Auftritt der Figur, geschildert: Der ursprüngliche Träger des Namens und Kostüms von Captain America ist ein Amerikaner namens Steven Rogers (von anderen Figuren zumeist „Steve“ genannt). Obwohl er zu Beginn des Zweiten Weltkriegs ausgemustert wird, will er seinem Land dennoch dienen. Daher meldet er sich als Freiwilliger für ein Experiment der Regierung. Ein geheimes „Supersoldatenserum“ (namens Infinity-Formula-Serum) soll gewöhnlichen Menschen zu körperlicher Höchstleistung verhelfen. Zwar ist das Experiment ein Erfolg, doch wird der verantwortliche Wissenschaftler von einem Spion der Nazis getötet, weshalb Steve am Ende der einzige Supersoldat bleibt. Mit einem Kostüm in den Farben der amerikanischen Nationalflagge ausgestattet, wird er zu Captain America und kämpft als solcher für sein Land gegen die Kriegsgegner sowie deren Spione und Saboteure. Neben seinem Kostüm trägt Captain America auch einen Schild, der sowohl zur Verteidigung als auch als Wurfwaffe eingesetzt werden kann. Der bekannteste davon, der erstmals in Heft 2 von Captain America Comics zum Einsatz kam, besteht aus einer Legierung mit dem fiktiven Metall Vibranium (einige Autoren nennen auch das nahezu unzerstörbare, gleichfalls fiktive Metall Adamantium als Bestandteil). Ihm zur Seite steht ein junger Mann namens James Buchanan Barnes, der unter dem Namen „Bucky“ zu Steves Partner wird. Nach Kriegsende hatte Captain America zwar weitere Auftritte, doch erklärte Marvel später rückwirkend, in diesen Geschichten hätten jeweils andere Personen das Kostüm getragen. Steve Rogers kehrte offiziell in Heft 4 der Comicserie The Avengers (dt. Name Die Rächer) aus dem Jahr 1964 zurück. Es stellt sich heraus, dass Steve seit einem Kampf kurz vor Kriegsende im Eis der Arktis eingeschlossen war. Das Serum in seinem Blut hat ihn dabei in Kälteschlaf versetzt, weshalb es den Rächern möglich ist, Steve wieder zum Leben zu erwecken. Daraufhin tritt Steve den Rächern bei und übernimmt viele Jahrzehnte lang die Rolle des Anführers des Teams. Zugleich muss er sich jedoch daran gewöhnen, aufgrund seiner längeren Abwesenheit nunmehr in einer ihm fremden Zeit zu leben. Im Laufe der Jahre hat Marvel die älteren Geschichten aus dem „Silver Age“ jedoch immer wieder zeitlich verlegt, so dass Steves Fund durch die Rächer immer etwa ein Jahrzehnt vor der jeweils aktuellen „Gegenwart“ einzuordnen ist. In Heft 25 der nunmehr fünften Comicserie mit dem Titel Captain America, veröffentlicht im Jahr 2007, wird Steve Rogers augenscheinlich von einem Attentäter erschossen,[1] woraufhin sein ehemaliger Partner Bucky zum neuen Captain America wird. Dies war weder das erste Mal, dass eine andere Figur das Kostüm trug, noch das erste Mal, dass der „Tod“ von Steve Rogers im Mittelpunkt der Handlung stand. Auch nachdem ab Heft 600 enthüllt wurde, dass Rogers nicht getötet wurde, sondern durch die Zeit reiste, und seiner Rückkehr in die Gegenwart, behielt Bucky die Rolle des Captain Americas.[2] Rogers erhielt als "Agent Steve Rogers" eine eigene Serie und trat den Secret Avengers bei. Nachdem allerdings Bucky gezwungen war, undercover zu gehen und wieder seine frühere Identität als Winter Soldier angenommen hatte, wurde Rogers 2011 erneut zu Captain America. Ab Herbst 2014 wird Sam Wilson aka Falcon in das Kostüm von Captain America schlüpfen, da Rogers im Sterben liegt. """.decode(encoding='utf8').encode('utf8'))
    print(create_json(chunks))
